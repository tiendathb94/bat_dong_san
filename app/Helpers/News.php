<?php 
use App\Entities\News;
use App\Entities\Category;

function getNewsReviewProject()
{
    $news = [];
    $category = Category::where('destination_entity', News::class)
    ->whereSlug('danh-gia-du-an')
    ->first();
    if($category) {
        $news = $category->news()
        ->with('project.imageLibraries', 'category')
        ->whereHas('project')
        ->where('status', News::APPROVED)
        ->orderByDesc('created_at')
        ->take(config('app.news.review_project'))->get();
    }
    
    return $news;
}