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
                <div class="moduletitle">
                    QUẢN LÝ TIN RAO BÁN, CHO THUÊ
                </div>
                <table class="w-100 my-3">
                    <tbody>
                        <tr>
                            <td class="colorblue w-25">Từ ngày</td>
                            <td class="colorblue w-25">Đến ngày</td>
                            <td class="colorblue w-25">Loại tin</td>
                            <td class="colorblue w-25">Trạng thái</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="pr-3">
                                    <input name="" type="date" value="" class="form-control fs-12">
                                </div>
                            </td>
                            <td>
                                <div class="pr-3">
                                    <input name="" type="date" value="" class="form-control fs-12">
                                </div>
                            </td>
                            <td>
                                <div class="pr-3">
                                    <select name="" class="form-control fs-12">
                                        <option value="7">Chọn loại tin</option>
                                        <option value="0">Tin VIP đặc biệt</option>
                                        <option selected="selected" value="1">Tin VIP 1</option>
                                        <option value="2">Tin VIP 2</option>
                                        <option value="3">Tin VIP 3</option>
                                        <option value="4">Tin Ưu Đãi</option>
                                        <option value="5">Tin Thường</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="pr-3">
                                    <select name="" class="form-control fs-12">
                                        <option value="0">Tất cả</option>
                                        <option value="1">Còn hạn</option>
                                        <option selected="selected" value="2">Hết hạn</option>

                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="colorblue">Mã tin/ tiêu đề</td>
                        </tr>
                        <tr>
                            <td class="pr-3">
                                <input name="" type="text" class="form-control fs-12">
                            </td>
                            <td colspan="3">
                                <input type="button" name="" value="Tìm kiếm" class="btn-search" autopostback="true">
                                <span class="colorblue">(Lưu ý khi nhập mã tin/ tiêu đề thì các bộ lọc khác không có tác dụng)</span>
                                <div class="btn-download-excel">
                                    <span class="ti-download"></span>Excel
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
                <img src="https://file4.batdongsan.com.vn/images/no-photo.jpg" width="24px">&nbsp;
                    <a title="" href="/user-page" class="text-dark"><strong>English</strong></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
    <link rel="stylesheet"
    href="{{ asset('themify-icons/themify-icons.css') }}">
@endpush

@push('scripts')
    <script src="/js/pages/users/index.js"></script>
@endpush