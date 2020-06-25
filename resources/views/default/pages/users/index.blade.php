@extends('default.layouts.default')

@section('page-title')
    Trang cá nhân
@endsection

@section('content')
@php($user = auth()->user())
@php($block = 'default.pages.users.blocks.')
    <div class="mt-5 mb-5 container pt-4">
        <div class="row">
            <div class="col-3">
                @include($block . 'sidebar')
            </div>
            <div class="col-9 p-0">
                @include($block . 'title', ['title' => 'QUẢN LÝ TIN RAO BÁN, CHO THUÊ'])
                @include($block . 'search')
                <table class="table table-bordered fs-12 text-center">
                    <thead>
                        <tr class="bg-thead">
                            <th>STT</th>
                            <th>Mã tin</th>
                            <th>Tiêu đề</th>
                            <th>Xem</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày hết hạn</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <span class="font-weight-bold mt-5 mb-3 fs-12">Note</span>
                <div class="fs-12">
                Trong trường hợp Quý khách muốn đăng và quản lý tin rao tiếng Anh, xin vui lòng click vào đây 
                <img src="/images/no-photo.jpg" width="24px">&nbsp;
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

@push('scripts')
    <script src="/js/pages/users/index.js"></script>
@endpush