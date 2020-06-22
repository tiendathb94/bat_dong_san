<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function create()
    {
        return view($this->_config['view']);
    }
}
