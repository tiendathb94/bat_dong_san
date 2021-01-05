<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Category;
use App\Entities\News;

class UserController extends Controller
{
    public function news(Request $request)
    {
        $news = News::where('user_id', auth()->id());
        if(isset($request->title)) {
            $news->where('title', 'LIKE', "%$request->title%");
        }
        if($request->category_id) {
            $news->where('category_id', $request->category_id);
        }
        $categories = Category::select('id', 'name')->get();
        $data = [
            'news' => $news->orderByDesc('created_at')->paginate(config('app.paginate')),
            'categories' => $categories,
            'statuses' => News::STATUSES
        ];
        return view($this->_config['view'], $data);
    }

    public function index(Request $request)
    {
        return redirect("user/information");
    }

    public function approveNews(Request $request)
    {
        $news = News::where('status', News::AWAITING_REVIEW);
        if(isset($request->title)) {
            $news->where('title', 'LIKE', "%$request->title%");
        }
        if($request->category_id) {
            $news->where('category_id', $request->category_id);
        }
        $categories = Category::select('id', 'name')->get();
        $data = [
            'news' => $news->paginate(config('app.paginate')),
            'categories' => $categories,
        ];
        return view($this->_config['view'], $data);
    }

    public function changePassword()
    {
        return view($this->_config['view']);
    }

    public function information()
    {
        return view($this->_config['view']);
    }
}