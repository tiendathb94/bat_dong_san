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
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                @if(count($news))
                    @include($partials . 'new_news', ['news' => $news])
                    <div class="row">
                        <div class="col-12">
                            <p><span class="font-weight-bold">Tin tức bất động sản </span>theo chuyên mục:</p>
                        </div>
                    </div>
                    @foreach($categories as $category)
                        @include($partials . 'category_news', ['category' => $category])
                    @endforeach
                @else
                <div class="row">
                    <div class="col-12">
                        <p class="text-center">Chưa có tin tức hiển thị, vui lòng quay lại sau.</p>
                    </div>  
                </div>
                @endif
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
        href="{{ asset('css/pages/news/index.css') . '?m=' . filemtime('css/pages/news/index.css') }}">
@endpush
