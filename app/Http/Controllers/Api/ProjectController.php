<?php

namespace App\Http\Controllers\Api;

use App\Entities\Category;
use App\Entities\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function createProject(Request $request)
    {
        $project = new Project([]);
    }
}
