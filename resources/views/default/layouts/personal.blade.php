@extends('default.layouts.default')

@section('content')
    @php($user = auth()->user())

    <div class="container">
        <div class="row my-5">
            <!-- Sidebar -->
            <div class="col-lg-3 col-12 order-2 order-lg-1">
                <div class="box-header">
                    <h3>Trang cá nhân</h3>
                </div>

                <div class="box-arround">
                    <div class="useravatar mb-3">
                        <a href="{{ route('pages.user.index') }}" title="" class="text-center">
                            <img alt="" class="avatar" src="/images/default-user-avatar-blue.jpg">
                        </a>
                        <a href="{{ route('pages.user.index') }}" title="" class="userfullname">{{ $user->fullname }}</a>
                        <span class="fs-12 px-3 line-height-24"><span class="font-weight-bold">Email</span>: {{ $user->email }}</span>
                        <span class="fs-12 px-3 line-height-24"><span class="font-weight-bold">Giới tính</span>: {{ $user->gender_name }}</span>
                        <span class="fs-12 px-3 line-height-24"><span class="font-weight-bold">CMND/Mã số thuế</span>: {{ $user->tax }}</span>
                    </div>
                </div>

                @include('default.partials.personal-sidebar-menu')
            </div>

            <!-- Main content -->
            <div class="col-lg-9 col-12 p-lg-0 order-1 order-lg-2">
                @yield('main_content')
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/layouts/personal.css') . '?m=' . filemtime('css/layouts/personal.css') }}">
@endpush
