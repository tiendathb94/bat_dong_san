@extends('default.layouts.default')

@section('page-title')
    Trang cá nhân
@endsection

@section('content')
@php($user = auth()->user())
@php($block = 'default.pages.users.blocks.')
{{ request('message') ?: '' }}
    <div class="mt-5 mb-5 container pt-4">
        <div class="row">
            <div class="col-lg-3 col-12 mb-3">
                @include($block . 'sidebar')
            </div>
            <div class="col-lg-9 col-12 p-lg-0">
                @include($block . 'title', ['title' => 'QUẢN LÝ TIN RAO BÁN, CHO THUÊ'])
                @include($block . 'search')
                @include($block . 'table_news', ['news' => $news])
                @include($block . 'modal_confirm')
                <span class="font-weight-bold mt-5 mb-3 fs-12">Note</span>
                <div class="fs-12">
                Trong trường hợp Quý khách muốn đăng và quản lý tin rao tiếng Anh, xin vui lòng click vào đây 
                <img src="/images/no-photo.jpg" width="24px" alt="" title="">&nbsp;
                    <a title="" href="#" class="text-dark"><strong>English</strong></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
@endpush

