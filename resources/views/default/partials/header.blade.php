<style>
    .bds_main_menu ul li a{
        font-weight: bold;
        color: #2D373F !important;
        line-height: 55px;
        font-size: 16px;
    }
    .bds_main_menu{
        box-shadow: 0 4px 4px 0 rgba(0,0,0,0.25);
    }
    .bds-button span{
        background: #3fa148;
        padding: 4px 8px;
        box-shadow: 0 4px 4px rgba(0,0,0,0.25);
        border-radius: 5px;
        color: #fff;
        font-weight: 500;
    }

    .bds_main_menu ul li .info-user a {
      color: #4F4F4F !important;
      font-weight: normal;
      font-size: 14px;
    }

    .bds_main_menu ul li .info-user a img {
      margin-left: 6px;
    }
</style>
<div class="d-none d-md-flex d-xl-none bds_main_menu">
  <a class="navbar-brand" href="{{ route('home') }}">
      <img src="/images/logobds04.svg" alt="">
  </a>
  <nav class="navbar navbar-light bg-light d-flex w-100">
    @include('default.partials.navbar_menu_tablet')
    <form class="my-2 my-lg-0">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0 flex-row">
        @if(!Auth::user())
          <li class="nav-item active mx-4">
            <a class="nav-link" href="{{ route('login') }}">Đăng nhập <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('registerForm') }}">Đăng ký</a>
          </li>
        @else
          <li class="nav-item mx-4">
            <div class="d-flex info-user align-items-center">
              <img src="/images/ic_user.png" width="16" height="16">
              <a class="nav-link" href="{{ route('pages.user.index') }}">
                  {{ auth()->user()->fullname }}
              </a>
              <a class="nav-link" href="{{ route('logout') }}">
                <img src="/images/ic_log_out.png" width="16">
              </a>
            </div>
          </li>
        @endif
          <li class="nav-item ml-2">
              <a class="nav-link bds-button" href="#">
                  <span> Tạo tin rao vặt </span>
              </a>
          </li>
      </ul>
    </form>
  </nav>
</div>

<div class="d-block d-md-none d-xl-block">
  <nav class="navbar navbar-expand-md navbar-light bg-light bds_main_menu">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="/images/logobds04.svg" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      @include('default.partials.navbar_menu')
      <form class="my-2 my-lg-0">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @if(!Auth::user())
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('login') }}">Đăng nhập <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('registerForm') }}">Đăng ký</a>
              </li>
            @else
              <li class="nav-item">
                <div class="d-flex info-user align-items-center">
                  <img src="/images/ic_user.png" width="16" height="16">
                  <a class="nav-link" href="{{ route('pages.user.index') }}">
                      {{ auth()->user()->fullname }}
                  </a>
                  <a class="nav-link" href="{{ route('logout') }}">
                    <img src="/images/ic_log_out.png" width="16">
                  </a>
                </div>
              </li>
            @endif
              <li class="nav-item">
                  <a class="nav-link bds-button" href="{{ route('posts.create_sell') }}">
                      <span> Tạo tin rao vặt </span>
                  </a>
              </li>
          </ul>
      </form>
    </div>
  </nav>
</div>
