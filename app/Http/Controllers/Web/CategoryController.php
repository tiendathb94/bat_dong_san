<?php

namespace App\Http\Controllers\Web;

use App\Entities\News;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $news = News::with('category')->whereHas('category', function ($query) use ($slug) {
            $query->whereSlug($slug);
        })->paginate(20);
        $data = [
            'news' => $news
        ];
        return view('default.pages.category.show', $data);
    }
}