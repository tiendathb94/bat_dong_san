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
    public function listSell()
    {
        $categorySellHouse = Category::whereSlug(Post::SELL_HOUSE)->first();
        $categoryLeaseHouse = Category::whereSlug(Post::LEASE_HOUSE)->first();
        $posts = Post::whereIn('form', [$categorySellHouse->id, $categoryLeaseHouse->id])->orderByDesc('created_at');
        return view($this->_config['view'], ['posts' => $posts->take(4)->get()]);
    }

    public function listBuy()
    {
        $categoryBuyHouse = Category::whereSlug(Post::HOUSE_BUY)->first();
        $categoryRentHouse = Category::whereSlug(Post::HOUSE_RENT)->first();
        $posts = Post::whereIn('form', [$categoryBuyHouse->id, $categoryRentHouse->id])->orderByDesc('created_at');
        return view($this->_config['view'], ['posts' => $posts->take(4)->get()]);
    }
}
