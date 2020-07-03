@extends('default.layouts.default')

@section('page_title')
    Tin tức bất động sản
@endsection

@section('content')
    @php($partials = 'default.partials.')
    @include($partials . 'news_search', [
        'title' => '', 
        'time' => '', 
        'subTitle' => '', 
        'actionSearch' => route('news.index')
        ])
    @if(count($news))
        @include($partials . 'new_news', ['news' => $news])
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p><span class="font-weight-bold">Tin tức bất động sản </span>theo chuyên mục:</p>
                </div>
            </div>
        </div>
        @foreach($categories as $category)
            @include($partials . 'category_news', ['category' => $category])
        @endforeach
    @else
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-center">Chưa có tin tức hiển thị, vui lòng quay lại sau.</p>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/news/index.css') . '?m=' . filemtime('css/pages/news/index.css') }}">
@endpush
