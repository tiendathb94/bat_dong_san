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

    public function managePostedProject(Request $request)
    {
        $user = auth()->user();

        $qb = Project::query()->where('user_id', $user->id);

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
}
