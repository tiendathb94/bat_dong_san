<?php

namespace App\Http\Controllers\Web;

use App\Entities\News;
use App\Entities\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show($slug)
    {   
        $category = Category::whereSlug($slug)->firstOrFail();
        $news = $category->news()->whereStatus(News::APPROVED)
            ->paginate(config('app.category.news.paginate'));
        $data = [
            'news' => $news,
            'category' => $category
        ];
        return view('default.pages.category.show', $data);
    }
}