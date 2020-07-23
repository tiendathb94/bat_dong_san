<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;

class PostController extends Controller
{
    public function getPriceUnit(Request $request)
    {
        return Post::CATEGORIES[$request->slug];
    }

    public function getDirection()
    {
        return Post::DIRECTIONS;
    }
}
