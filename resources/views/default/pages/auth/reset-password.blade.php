@extends('default.layouts.auth')

@section('page_title')
Tạo lại mật khẩu
@endsection

@section('content')
    <div class="reset_password pt-5">
        <div class="container pt-5">
            <div class="auth__wrapper">
                <form class="form" action="{{ route('default.pages.auth.reset-password') }}" method="POST">
                    <div class="auth__content">
                        <a href="/" class="auth__logo">
                            <img src="/images/logobds04.svg" alt="logo">
                        </a>

                        <h3 class="auth__heading">
                            Tạo lại mật khẩu
                        </h3>

                        {{ csrf_field() }}
                        <div class="form-group">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list_notification">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success">
                                    <ul class="list_notification">
                                        <li>{!! session('success_message') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('error_message'))
                                <div class="alert alert-danger">
                                    <ul class="list_notification">
                                        <li>{!! session('error_message') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập Email của bạn!">
                        </div>
                        <button type="submit" name="resetpassword" class="btn btn-primary w-100 btn_resetpassword">Gửi liên kết tạo lại mật khẩu</button>
                        <p class="auth__change">
                            Nếu bạn chưa có tài khoản?
                        </p>
                        <a href="/dang-ky-tai-khoan" class="auth__change-status">
                            Đăng ký ngay
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/auth/reset-password.css') . '?m=' . filemtime('css/pages/auth/reset-password.css') }}">
@endpush

