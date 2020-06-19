<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('head')

    <link rel="stylesheet" href="{{ asset('css/app.css') . '?m=' . filemtime('css/app.css') }}">
    <style>
        nav{
            background: linear-gradient(to right, #3fa148 0%, #abd6af 100%);
        }
        .top{
            box-shadow: 0 4px 4px 0 rgba(0,0,0,0.25);
        }
        .main{
            margin-top: 50px
        }
        .content{
            margin-top: 50px
        }
        form{
            font-size: 18px
        }
    </style>
</head>

<body>

<div class="grid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light top">
        <a class="navbar-brand" href="#">
            <img src="https://file4.batdongsan.com.vn/images/newhome/logobds04.svg" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            
          </ul>
          <form class="my-2 my-lg-0">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">0842.467.996</a>
                  </li>
              </ul>
          </form>
        </div>
      </nav>

      <div class="container">

        <div class="row main">
            <div class="col-sm-7">
                <img class="img-fluid" src="http://static.tapchitaichinh.vn/800x450/images/upload/tranhuyentrang/04242020/13_ylgk.jpg" alt="">
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </div>
            <div class="col-sm-5">
                <form action="{{ route('loginStore') }}" method="POST">
                    @csrf
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                
                    @endif

                    <div class="form-group">
                        <label >Địa chỉ email</label>
                        <input type="email" class="form-control" name="email"  placeholder="Địa chỉ email">
                    </div>
                    
                    <div class="form-group">
                        <label >Địa chỉ email</label>
                        <input type="password" class="form-control" name="password"  placeholder="*******">
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập ngay</button>
                    
                </form>
                <div>
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
                <img style="padding: 8em 3em;" src="https://www.devwork.vn/public/images/OBJECTS.png" >
                </div>
            </div>
            </div>
        </div>
    </div>


</div>

<script src="{{ asset('js/app.js') . '?m=' . filemtime('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
