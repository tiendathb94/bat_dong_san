@extends('default.layouts.auth')
@section('title', 'Đăng nhập')
@section('content')
<div class="container">
    <div class="row main">
        <div class="col-sm-7">
            <img class="img-fluid bds-img-bn" src="http://static.tapchitaichinh.vn/800x450/images/upload/tranhuyentrang/04242020/13_ylgk.jpg" alt="">
        </div>
        <div class="col-sm-5">
            <form action="{{ route('loginStore') }}" method="POST">
                @csrf
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                
                @if ($error = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $error }}</p>
                    </div>
                @endif
                
                @if ($success = session('success_message'))
                    <div class="alert alert-success">
                        <ul class="list_notification">
                            <li>{{ $success }}</li>
                        </ul>
                    </div>
                @endif

                @if ($error = session('error_message'))
                    <div class="alert alert-danger">
                        <ul class="list_notification">
                            <li>{{ $error }}</li>
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label class="label">Địa chỉ email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Địa chỉ email">
                </div>
                
                <div class="form-group">
                    <label class="label">Địa chỉ email</label>
                    <input type="password" class="form-control" name="password"  placeholder="*******">
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập ngay</button>
                <a style="text-decoration: underline;color:#3490dc;cursor:pointer" href="/new-password">Quên mật khẩu</a>
                <div style="margin-top: 20px;">
                    <div style=" display: flex">
                        <a style="width: 49%; height: 34px; font-size: 16px" href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                        &nbsp;&nbsp;
                        <a style="width: 49%; height: 34px; font-size: 16px" href="{{ url('/auth/redirect/google') }}" class="btn btn-danger"><i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                
            </form>
            <div class="term">
                <br>
                <span style="color: #3fa148 ">Chú ý:</span> Thông tin Tên đăng nhập, email, số điện thoại di động không thể thay đổi sau khi đăng ký.
                <br>
                <span>
                    Để được trợ giúp vui lòng liên hệ tổng đài CSKH 1900 1881 hoặc email hotro@batdongsan.com.vn
                </span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-7">
            <h1 style="line-height: 1.4;">BDS tặng ngay 1000 Bài đăng miễn phí.</h1>
            <p style="font-size: 24px; line-height: 1.4;">Đăng ký ngay! hành triệu khách hành trong nước và quốc tế.</p>
            <p style="font-size: 18px; line-height: 1.4;"><i class="fa fa-check-circle"></i> Xác thực tài khoản nhanh chóng</p>
            <p style="font-size: 18px; line-height: 1.4;"><i class="fa fa-check-circle"></i> Nhận khách hàng liên tục</p>
            <p style="font-size: 18px; line-height: 1.4;"><i class="fa fa-check-circle"></i> Không cắt phí với mọi hình thức</p>
            </div>
            <div class="col-md-5">
            <img class="img-fluid mr-top-20" src="https://www.devwork.vn/public/images/OBJECTS.png" >
            </div>
        </div>
        </div>
    </div>
</div>

@endsection