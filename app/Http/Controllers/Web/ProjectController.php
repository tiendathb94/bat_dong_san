<?php

namespace App\Http\Controllers\Web;

use App\Entities\Category;
use App\Entities\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create()
    {
        return view($this->_config['view']);
    }

    public function update($projectId)
    {
        $user = auth()->user();

        $project = Project::query()
            ->with('investor')
            ->where('id', '=', $projectId)
            ->where('user_id', '=', $user->id)
            ->first();

        if (!$project) {
            return abort(404);
        }

        $project->galleryImages = $project->imageLibraries()->where('library_type', 'gallery')->get();

        return view($this->_config['view'], ['project' => $project]);
    }

    public function managePostedProject(Request $request)
    {
        $user = auth()->user();

        $qb = Project::query()->where('user_id', '=', $user->id);

        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $qb->where('long_name', 'like', "%$keyword%");
        }

        $categoryId = $request->get('category_id');
        if ($categoryId) {
            $qb->where('category_id', '=', $categoryId);
        }

        $paginate = $qb->paginate(15);

        return view($this->_config['view'], [
            'projects' => $paginate,
            'categories' => Category::query()->where('destination_entity', Project::class)->get(),
            'keyword' => $keyword,
            'categoryId' => $categoryId,
        ]);
    }

    public function manageAwaitingReviewProject(Request $request)
    {
        $qb = Project::query()->where('status', '=', Project::StatusPending);

        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $qb->where('long_name', 'like', "%$keyword%");
        }

        $categoryId = $request->get('category_id');
        if ($categoryId) {
            $qb->where('category_id', '=', $categoryId);
        }

        return view($this->_config['view'], [
            'projects' => $qb->paginate(15),
            'categories' => Category::query()->where('destination_entity', Project::class)->get(),
            'keyword' => $keyword,
            'categoryId' => $categoryId,
        ]);
    }

    public function showProjectDetail(Request $request)
    {
        $slug = $request->route()->parameter('slug');
        $tabId = $request->route()->parameter('tabId');

        /** @var Project $project */
        $project = Project::query()
            ->with('category', 'investor')
            ->where('status', '=', Project::StatusApproved)
            ->where('slug', '=', $slug)
            ->first();

        if (!$project) {
            return abort(404);
        }

        if ($tabId === 'investor') {
            $activeTab = [
                'template' => 'investor',
                'id' => 0
            ];
        } else if ($tabId && $project->tabs) {
            $tabs = $project->tabs->keyBy('id');
            if (isset($tabs[$tabId])) {
                $tab = $tabs[$tabId];
                $activeTab = [
                    'template' => $tab->template,
                    'id' => $tab->id,
                    'contents' => $tab->contents ? $tab->contents : []
                ];
            } else {
                return response()->redirectTo(route('pages.project.project_detail', ['slug' => $slug, 'categorySlug' => $project->category->slug]));
            }
        } else {
            $activeTab = [
                'template' => 'overview',
                'id' => 0
            ];
        }

        return view($this->_config['view'], [
            'project' => $project,
            'galleries' => $project->imageLibraries()->where('library_type', '=', Project::ImageLibraryTypeGallery)->get(),
            'activeTab' => $activeTab
        ]);
    }
}
