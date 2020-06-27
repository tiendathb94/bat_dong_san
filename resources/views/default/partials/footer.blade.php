<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <div class="row mb-3">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="footer__logo">   
                    <a href="/">
                        <img src="/images/logo-footer-no1-1.svg" alt="logo">
                    </a>
                </div>
                <div class="footer__company">
                    <p class="footer__company-name">Công ty Cổ phần PropertyGuru Việt Nam</p> 
                    <a href="/">Một thành viên của tập đoàn PropertyGuru</a>
                </div>
                <div class="footer__add">
                    <span>
                        <img src="/images/placeholder-line.png" alt="png">
                    </span>
                    Tầng 31, Keangnam Hanoi Landmark, Phạm Hùng, Nam Từ Liêm, Hà Nội
                </div>
                <div class="footer__add">
                    <span>
                        <img src="/images/phone-call.png" alt="png">
                    </span>
                    (024) 3562 5939 - (024) 3562 5940
                </div>
                <div class="footer__social">
                    <div class="footer__social-logo">
                        <img src="/images/da-dang-ki-bct.png" alt="">
                    </div>
                    <!-- <ul class=footer__social-list>
                        <li class="footer__social-item">
                            <a href="">
                                <img src="/images/fb.png" class="bct">
                            </a>
                        </li>
                        <li class="footer__social-item">
                            <a href="">
                                <img src="/images/youtube.png" class="bct">
                            </a>
                        </li>
                        <li class="footer__social-item">
                            <a href="">
                                <img src="/images/zalo2.png" class="bct">
                            </a>
                        </li>
                    </ul> -->
                </div>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 mt-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__header">
                            HƯỚNG DẪN
                        </div>

                        <div class="footer__contentLeft">
                            <ul class="footer__content-listLeft">
                                @for($i = 0; $i < 5; $i++)
                                    <li class="footer__content-itemLeft">
                                        <a href="">Báo giá & hỗ trợ</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__header">
                            QUY ĐỊNH
                        </div>

                        <div class="footer__contentLeft">
                            <ul class="footer__content-listLeft">
                                @for($i = 0; $i < 5; $i++)
                                    <li class="footer__content-itemLeft">
                                        <a href="">Báo giá & hỗ trợ</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="footer__header">
                            TỔNG ĐÀI HỖ TRỢ
                        </div>

                        <div class="footer__contentRight">
                            <ul class="footer__content-listRight">
                                @for($i = 0; $i < 3; $i++)
                                    <li class="footer__content-itemRight">
                                        <span>
                                            <img src="/images/hotline.png" width="16">
                                        </span>
                                        Tổng đài CSKH: 1900 1881
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div id="accordion">
                <div class="card border-0">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0 ">
                            <button class="btn btn-link text-white shadow-none footer__contentRight-accordion" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Xem tất cả chi nhánh của Batdongsan.com.vn  
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                @for($i = 0; $i < 3; $i++)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                        <div class="footer_branch">
                                            <div class="footer_branch-name">Chi nhánh TP. Hồ Chí Minh</div>
                                            <div class="branch-add">
                                                Tầng 8, Tòa nhà Xổ số Kiến thiết (Lottery Tower), Số 77 Trần Nhân Tôn, Phường 9, Quận 5, TP. Hồ Chí Minh<br>
                                                Điện thoại: 
                                                <a href="tel:0904 893 279">0904 893 279</a>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="footer_content_info">
                    Giấy ĐKKD số 0104630479 do Sở KHĐT TP Hà Nội cấp lần đầu ngày 02/06/2010<br>
                    Giấy phép ICP số 2399/GP-STTTT do Sở TTTT Hà Nội cấp ngày 04/09/2014<br>
                    Giấy phép GH ICP số 3832/GP-TTĐT do Sở TTTT Hà Nội cấp ngày 08/08/2019
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="footer_content_info">
                    Chịu trách nhiệm nội dung GP ICP: Bà Đặng Thị Hường<br>
                    Chịu trách nhiệm sàn GDTMĐT: Ông Nguyễn Đức Thắng<br>
                    Quy chế, quy định giao dịch có hiệu lực từ 23/02/2020
                </div>   
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="footer_content_info">
                    Copyright © 2007 - 2020 Batdongsan.com.vn<br>
                    Ghi rõ nguồn "Batdongsan.com.vn" khi phát hành lại thông tin từ website này.
                </div>
            </div>
        </div>
    </div>
</footer>