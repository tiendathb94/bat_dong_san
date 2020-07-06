@extends('default.layouts.default')

@section('page_title')
    {{ $news->title }}
@endsection

@section('content')
    @php($partials = 'default.partials.')
    @include($partials . 'news_search', [
        'title' => $news->title, 
        'time' => $news->created_at, 
        'subTitle' => '', 
        'actionSearch' => route('news.show', [ $news->category->slug, $news->slug])
        ])
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                @include($partials . 'news_related', ['category' => $news->category, 'relatedNews' => $relatedNews])
                {!! $news->content !!}
                <p class="text-right font-weight-bold">
                    {{ $news->user->fullname }}
                </p>
            </div>

            <div class="col-12 col-md-4 news-many-read mb-3 category-many-care">
                @include($partials . 'news_many_read')
                @include($partials . 'category_many_care')
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link
    rel="stylesheet"
    href="{{ asset('css/pages/news/show.css') . '?m=' . filemtime('css/pages/news/show.css') }}">
@endpush
