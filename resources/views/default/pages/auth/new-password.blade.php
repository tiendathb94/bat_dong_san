@extends('default.layouts.auth')

@section('page_title')
    Đổi lại mật khẩu
@endsection

@section('content')
<div class="reset_password pt-5">
    <div class="container mt-5" style="font-size: 20px">
        <div class="auth__wrapper">
            <form class="form" action="{{ request()->fullUrl() }}" method="POST">
                <div class="auth__content">
                    <a href="/" class="auth__logo">
                        <img src="/images/logobds04.svg" alt="logo">
                    </a>

                    <h3 class="auth__heading">
                        Đổi lại mật khẩu
                    </h3>
                    {{ csrf_field() }}

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list_notification">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="exampleInputPassword1" class="label_password">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="label_password">Nhập lại mật khẩu</label>
                        <input type="password" name="verify_password" class="form-control" id="exampleInputPassword1" placeholder="Nhập lại mật khẩu">
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/auth/reset-password.css') . '?m=' . filemtime('css/pages/auth/reset-password.css') }}">
@endpush