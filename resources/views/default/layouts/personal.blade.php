@extends('default.layouts.default')

@section('content')
    @php($user = auth()->user())

    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3">
                <div class="box-header">
                    <h3>Trang cá nhân</h3>
                </div>

                <div class="box-arround">
                    <div class="useravatar">
                        <img class="avatar" src="/images/default-user-avatar-blue.jpg">
                        <span class="userfullname">{{ $user->fullname }}</span>
                    </div>
                </div>

                @include('default.partials.personal-sidebar-menu')
            </div>

            <!-- Main content -->
            <div class="col-9 p-0">
                @yield('main_content')
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/layouts/personal.css') . '?m=' . filemtime('css/layouts/personal.css') }}">
@endpush
