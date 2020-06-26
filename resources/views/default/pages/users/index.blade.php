@extends('default.layouts.personal')

@section('page-title')
    Trang cá nhân
@endsection

@section('main_content')
    @php($user = auth()->user())
    @php($block = 'default.pages.users.blocks.')

    @include($block . 'title', ['title' => 'Quản lý tin rao bán, cho thuê'])
    @include($block . 'search')
    @include('default.partials.flash-message')
    @include($block . 'table_news', ['news' => $news])
    @include($block . 'modal_confirm')
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
@endpush

