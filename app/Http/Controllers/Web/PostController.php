<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Post;
use App\Entities\Category;

class PostController extends Controller
{
    public function createSell()
    {
        return view($this->_config['view']);
    }

    public function listSell(Request $request)
    {
        $categorySellHouse = Category::whereSlug(Post::SELL_HOUSE)->first();
        $categoryLeaseHouse = Category::whereSlug(Post::LEASE_HOUSE)->first();
        $posts = Post::whereIn('form', [$categorySellHouse->id, $categoryLeaseHouse->id])->orderByDesc('created_at');
        if($request->title) {
            $posts->where('title', 'like', "%$request->title%");
        }
        return view($this->_config['view'], ['posts' => $posts->paginate(20)]);
    }

    public function createBuy()
    {
        return view($this->_config['view']);
    }
}
