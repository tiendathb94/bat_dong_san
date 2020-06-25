@extends('default.layouts.default')

@section('page-title')
    Trang cá nhân
@endsection

@section('content')
@php($user = auth()->user())
    <div class="mt-5 mb-5 container pt-4">
        <div class="row">
            <div class="col-3">
                <div class="box-header">
                    <h3>TRANG CÁ NHÂN</h3>
                </div>
                <div class="box-arround">
                    <div class="useravatar">
                        <img class="avatar" src="/images/default-user-avatar-blue.jpg">
                        <span class="userfullname">{{ $user->fullname }}</span>
                        <!-- <div class="userpoint-menu">
                            <div class="userpoint-menu-level">
                                <label>Mã chuyển khoản: BDS14108898</label>
                            </div>
                        </div> -->
                        <div class="userpoint-menu">
                            <div class="userpoint-menu-level">
                                <label style="background-image:url(/images/rate-1.0.png);">Tài khoản: Thường</label>
                            </div>
                            <!-- <div class="userpoint-menu-point">
                                <label>0</label>
                                <span>&nbsp;điểm&nbsp;</span>
                                <a class="ti-info-alt" href="#">
                                    <div>
                                        <ul>
                                            <li>
                                                <span>Điểm đổi thưởng <b>0</b> điểm</span>
                                            </li>
                                            <li>
                                                <span>Đã tích lũy 0 VNĐ. Cần thêm 12.000.000 VNĐ để lên hạng Đồng</span>
                                            </li>
                                            <li>
                                                <span>Kỳ xét hạng tiếp theo vào 24/06/2021</span>
                                            </li>
                                        </ul>
                                    </div>
                                </a>
                            </div> -->
                        </div>
                        <!-- <div class="userbalance">
                            Tài khoản tin rao:
                            <span>0</span><br>
                            Tài khoản ngoài tin rao:
                            <span>0</span><br>
                            Tài khoản KM1:
                            <span>0</span><br>
                            Tài khoản KM2:
                            <span>40.000</span><br>
                        </div>
                        <a class="bluebotton" href="#">Nạp tiền</a> -->
                    </div>
                </div>
            </div>

            <div class="col-9 p-0">
            @php($block = 'default.pages.users.blocks.')
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