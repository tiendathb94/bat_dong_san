<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $news = auth()->user()->news()->paginate(config('app.paginate'));
        $data = [
            'news' => $news
        ];
        return view($this->_config['view'], $data);
    }
}