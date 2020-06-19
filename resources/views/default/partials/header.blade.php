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
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light bds_main_menu">
  <a class="navbar-brand" href="#">
      <img src="https://file4.batdongsan.com.vn/images/newhome/logobds04.svg" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Nhà đất bán
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Bán căn hộ trung cư</a>
              <a class="dropdown-item" href="#">Bán nhà  riêng</a>
              <a class="dropdown-item" href="#">Bán nhà mặt phố</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Nhà đất cho thuê
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Cho thuê nhà riêng</a>
              <a class="dropdown-item" href="#">Cho thuê văn phòng</a>
              <a class="dropdown-item" href="#">Cho thuê cửa hàng</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dự án
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Khu đô thị mới</a>
              <a class="dropdown-item" href="#">Khu phức hợp</a>
              <a class="dropdown-item" href="#">Nhà ở xã hội</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dự án
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Khu đô thị mới</a>
              <a class="dropdown-item" href="#">Khu phức hợp</a>
              <a class="dropdown-item" href="#">Nhà ở xã hội</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dự án
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Khu đô thị mới</a>
              <a class="dropdown-item" href="#">Khu phức hợp</a>
              <a class="dropdown-item" href="#">Nhà ở xã hội</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dự án
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Khu đô thị mới</a>
              <a class="dropdown-item" href="#">Khu phức hợp</a>
              <a class="dropdown-item" href="#">Nhà ở xã hội</a>
            </div>
        </li>
    </ul>
    <form class="my-2 my-lg-0">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          @if(!Auth::user())
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('loginForm') }}">Đăng nhập <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('registerForm') }}">Đăng ký</a>
            </li>
          @endif
            <li class="nav-item">
                <a class="nav-link bds-button" href="#">
                    <span> Tạo tin rao vặt </span>    
                </a>
            </li>
        </ul>
    </form>
  </div>
</nav>