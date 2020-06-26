@extends('default.layouts.personal')

@section('page-title')
    Thay đổi mật khẩu
@endsection

@section('main_content')
    @php($block = 'default.pages.users.blocks.')

    @include($block . 'title', ['title' => 'Thay đổi mật khẩu'])
    <form action="{{ route('default.pages.auth.change_password') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row fs-12 mt-3">
            <div class="col-12 col-lg-2 align-items-center d-flex">
                <span class="pl-3 font-weight-bold">Mật khẩu cũ</span>
            </div>
            <div class="col-12 col-lg-4">
                <input required type="password" name="password_old" id="" class="form-control fs-12">
            </div>
        </div>
        <div class="row fs-12 mt-3">
            <div class="col-12 col-lg-4 offset-lg-2">
                {!! $errors->first('password_old', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>

        <div class="row fs-12 mt-3">
            <div class="col-12 col-lg-2 align-items-center d-flex">
                <span class="pl-3 font-weight-bold">Mật khẩu mới</span>
            </div>
            <div class="col-12 col-lg-4">
                <input required type="password" name="password" id="" class="form-control fs-12">
            </div>
        </div>

        <div class="row fs-12 mt-3">
            <div class="col-12 col-lg-4 offset-lg-2">
                {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>

        <div class="row fs-12 mt-3">
            <div class="col-12 col-lg-2 align-items-center d-flex">
                <span class="pl-3 font-weight-bold">Gõ lại mật khẩu</span>
            </div>
            <div class="col-12 col-lg-4">
                <input required type="password" name="password_confirmation" id="" class="form-control fs-12">
            </div>
        </div>
        <div class="row fs-12 mt-3">
            <div class="col-12">
                <span class="pl-3 font-weight-bold">Lưu ý</span>: Vui lòng đăng nhập lại sau khi thay đổi mật khẩu để tiếp tục sử dụng.
            </div>
        </div>
        <div class="row fs-12 mt-3">
            <div class="col-12 col-lg-4 offset-lg-2">
                <button type="submit" class="btn btn-primary bg-default fs-12">Cập nhật</button>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
@endpush

