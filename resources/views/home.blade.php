@extends('default.layouts.default')

@section('page_title')
    Trang chủ
@endsection
    
@section('content')
    <div class="banner-home-slide" style="height: 300px;background: gray">
    </div>
    <div class="home-center">
        <div class="home-product">
            <h2 class="fl">Bất động sản dành cho bạn</h2>
            <div class="home-more-link">
                <a href="/nha-dat-ban">Tin nhà đất bán mới nhất</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="/nha-dat-cho-thue">Tin nhà đất cho thuê mới nhất</a>
            </div>
            <div class="clear"></div>
            <ul>
            @foreach($posts as $post)
                <li>
                    <div class="product-thumb">
                    <a title="{{$post->title}}" href="/ban-nha-mat-pho-pho-xa-dan-phuong-phuong-lien/ban-87m2-tien-hon-4-1m-y-6-tang-gia-28-5-ty-lh-phu-tran-098-9585039-pr28433325">
                        <img src="https://file4.batdongsan.com.vn/crop/257x147/2021/01/06/20210106090910-9caa_wm.jpg" alt="{{$post->title}}">
                    </a>
                    </div>
                    <div class="home-product-bound">
                        <div class="p-title textTitle">
                            <a href="/ban-nha-mat-pho-pho-xa-dan-phuong-phuong-lien/ban-87m2-tien-hon-4-1m-y-6-tang-gia-28-5-ty-lh-phu-tran-098-9585039-pr28433325" title="{{$post->title}}">{{$post->title}}<span class="hidden-mobile box" style="font-size: inherit;"></span></a>
                        </div>
                        <div class="product-price">{{$post->price}} tỷ</div>
                            <span class="ic_dot">·</span>
                            <div class="pro-m2">{{$post->total_area}} m²</div>
                        <div class="product-address">
                        @php($address = $post->address)
                        @if($address)
                            <a href="/ban-nha-mat-pho-dong-da-hn" title="Đống Đa">{{ $address->address }}</a>,
                            <a href="/ban-nha-mat-pho-ha-noi" title="Hà Nội">{{ $address->province->name }}</a>
                        @endif
                        </div>
                        <div class="product-date">
                            {{getDifferentTime($post->created_at)}}
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') . '?m=' . filemtime('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/home/index.css') . '?m=' . filemtime('css/pages/home/index.css') }}">
@endpush


