@extends('default.layouts.default')
@php($category = $news->first()->category )

@section('page_title')
    {{ $category->name }}
@endsection

@section('content')
    @php($partials = 'default.partials.')
    @include($partials . 'news_search', [
        'title' => $category->name, 
        'time' => '', 
        'subTitle' => '', 
        'actionSearch' => route('category.show', $category->slug)
    ])
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
            @include($partials . 'list_news', [
                'news' => $news, 
            ])
            </div>
        </div>
    </div>
@endsection

@push('styles')
<link
    rel="stylesheet"
    href="{{ asset('css/pages/news/show.css') . '?m=' . filemtime('css/pages/news/show.css') }}">
@endpush
