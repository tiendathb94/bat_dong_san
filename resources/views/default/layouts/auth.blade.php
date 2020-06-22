<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
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
        .form-group{
            margin-bottom: 16px;
        }
        label{
            margin-bottom: 4px;
        }
        .label{
            font-weight: 600

        }
        form, input, button{
            font-size: 16px !important
        }
        .form-check{
            display: inline-block ;
        }
        .form-check label{
           margin-left: 4px;
           margin-right: 20px
        }
        .form-check input{
            vertical-align: bottom
        }
        .form-check-input{
            margin-top: 5px !important
        }
        
        h2{
            font-weight: 800;
        }
        @media only screen and (max-width: 414px){
            button{
                width: 100%;
                margin-top: 16px
            }
            
            .bds-img-bn{
                display: none;
            }
            .main{
                margin-top: 25px;
            }
            .navbar-toggler{
                display: none;
            }
            .mr-top-20{
                margin-top: 20px
            }

        }
        
        .term{
            font-size: 14px
        }
        .alert{
            font-size: 16px;
        }
    </style>
</head>

<body>

<div class="grid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light top">
        <a class="navbar-brand" href="{{ route('home') }}">
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

    {{-- <div class="container"> --}}
        @yield('content')
    {{-- </div> --}}


</div>

<script src="{{ asset('js/app.js') . '?m=' . filemtime('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
