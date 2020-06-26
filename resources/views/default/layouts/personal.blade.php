@extends('default.layouts.default')

@section('content')
    @php($user = auth()->user())

    <div class="container">
        <div class="row my-5">
            <!-- Sidebar -->
            <div class="col-lg-3 col-12">
                <div class="box-header">
                    <h3>Trang cá nhân</h3>
                </div>

                <div class="box-arround">
                    <div class="useravatar">
                        <img class="avatar" src="/images/default-user-avatar-blue.jpg">
                        <span class="userfullname">{{ $user->fullname }}</span>
                        <span class="fs-12 px-3"><span class="font-weight-bold">Email</span>: {{ $user->email }}</span>
                        <span class="fs-12 px-3"><span class="font-weight-bold">Giới tính</span>: {{ $user->gender_name }}</span>
                        <span class="fs-12 px-3"><span class="font-weight-bold">CMND/Mã số thuế</span>: {{ $user->tax }}</span>
                    </div>
                </div>

                @include('default.partials.personal-sidebar-menu')
            </div>

            <!-- Main content -->
            <div class="col-lg-9 col-12 p-lg-0">
                @yield('main_content')
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/layouts/personal.css') . '?m=' . filemtime('css/layouts/personal.css') }}">
@endpush
