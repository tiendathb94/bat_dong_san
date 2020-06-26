<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Category;
use App\Entities\News;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $news = auth()->user()->news();
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
            'statuses' => News::STATUSES
        ];
        return view($this->_config['view'], $data);
    }
}