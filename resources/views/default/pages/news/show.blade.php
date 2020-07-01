@extends('default.layouts.default')

@section('page_title')
    {{ $news->title }}
@endsection

@section('content')
    @php($partials = 'default.partials.')
    @include($partials . 'news_search', ['title' => $news->title, 'time' => $news->created_at, 'subTitle' => ''])
@endsection

@push('styles')
<link
    rel="stylesheet"
    href="{{ asset('css/pages/news/show.css') . '?m=' . filemtime('css/pages/news/show.css') }}">
@endpush
