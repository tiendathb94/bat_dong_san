<?php

namespace App\Http\Controllers\Web;

use App\Entities\Category;
use App\Entities\Project;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function create()
    {
        return view($this->_config['view']);
    }

    public function managePostedProject()
    {
        $user = auth()->user();

        $qb = Project::query()->where('user_id', $user->id);
        $paginate = $qb->paginate(15);

        return view($this->_config['view'], [
            'projects' => $paginate->items(),
            'categories' => Category::query()->where('destination_entity', Project::class)->get()
        ]);
    }
}
