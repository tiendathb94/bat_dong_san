<?php

namespace App\Http\Controllers\Web;

use App\Entities\Category;
use App\Entities\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::whereStatus(1)->orderBy('created_at','DESC')->take(4)->get();
        
        return view($this->_config['view'], ["posts" => $posts]);
    }
}
