<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create(Request $request)
    {
        return view('default.pages.news.create');
    }

    public function store(Request $request)
    {
        # code...
    }


}
