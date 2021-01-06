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

        $project->galleryImages = $project->imageLibraries()->where('library_type', 'gallery')->orderByDesc('created_at')->get();
        $project->progressImages = $project->imageLibraries()->where('library_type', 'progress')->get()->sortByDesc('date_sort')->values()->all();

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
            ->with('category', 'investor', 'imageLibraries')
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

    public function projectLanding()
    {
        // Show the random project as slider
        $projectsInSlider = Project::query()
            ->with(['imageLibraries', 'category'])
            ->where('status', '=', Project::StatusApproved)
            ->whereHas('imageLibraries')
            ->limit(4)
            ->inRandomOrder()
            ->get();


        // Show the newest project
        $newestProjects = Project::query()
            ->with(['imageLibraries', 'category'])
            ->where('status', '=', Project::StatusApproved)
            ->limit(6)
            ->orderByDesc('created_at')
            ->get();

        // Project by categories
        $projectsMapByCategory = [];
        $envCategoryIds = env('PROJECT_CATEGORIES_SHOW_IN_PROJECT_LANDING');
        if ($envCategoryIds) {
            $categoryIds = explode(',', $envCategoryIds);
            if ($categoryIds) {
                $categories = Category::query()->whereIn('id', $categoryIds)->get();
                foreach ($categories as $category) {
                    $projectsByCategory = Project::query()
                        ->where('category_id', '=', $category->id)->limit(7)
                        ->where('status', '=', Project::StatusApproved)
                        ->get();
                    $projectsMapByCategory[] = [
                        'name' => $category->name,
                        'id' => $category->id,
                        'projects' => $projectsByCategory,
                    ];
                }
            }
        }

        return view($this->_config['view'], [
            'projectsInSlider' => $projectsInSlider,
            'newestProjects' => $newestProjects,
            'projectsMapByCategory' => $projectsMapByCategory,
        ]);
    }

    public function showProjectsInCategory($categorySlug, Request $request)
    {
        $category = Category::query()
            ->where('destination_entity', '=', Project::class)
            ->where('slug', '=', $categorySlug)
            ->first();
        if (!$category) {
            return abort(404);
        }

        $projects = Project::query()
            ->where('status', '=', Project::StatusApproved)
            ->where('category_id', '=', $category->id)
            ->whereHas('address', function ($query) use($request) {
                if($request->province_id) {
                    $query->where('province_id', $request->province_id);
                }
                if($request->district_id) {
                    $query->where('district_id', $request->district_id);
                }
            });
        if($request->priceFrom) {
            if ($request->priceFrom >= 1000) {
                $projects->where('price', '>=', $request->priceFrom / 1000)->where('price_unit', Project::PriceUnitBillion);
            } else {
                $projects->where('price', '>=', $request->priceFrom)->where('price_unit', Project::PriceUnitMillion);
            }
        }
        if($request->priceTo) {
            if ($request->priceTo >= 1000) {
                $projects->where('price', '<=', $request->pricpriceToeFrom / 1000)->where('price_unit', Project::PriceUnitBillion);
            } else {
                $projects->where('price', '<=', $request->priceTo)->where('price_unit', Project::PriceUnitMillion);
            }
        }

        return view($this->_config['view'], [
            'category' => $category,
            'projects' => $projects->paginate(15),
        ]);
    }

    public function search(Request $request)
    {
        $projects = Project::whereStatus(Project::StatusApproved)->where('long_name', 'like', "%$request->keyword%")->paginate(config('app.project.search'));
        $data = [
            'projects' => $projects
        ];
        return view($this->_config['view'], $data);
    }
}
