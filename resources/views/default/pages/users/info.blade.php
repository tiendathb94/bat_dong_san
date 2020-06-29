@extends('default.layouts.personal')

@section('page-title')
    Thay đổi thông tin cá nhân
@endsection

@section('main_content')
    @php($user = auth()->user())
    @php($block = 'default.pages.users.blocks.')

    @include($block . 'title', ['title' => 'Thay đổi thông tin cá nhân'])
    <div id="user-info-form-container" class="mb-5"></div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
@endpush

@push('scripts')
    <script>
        window.user = @json($user)
    </script>
    <script src="{{ asset('js/pages/users/info.js') . '?m=' . filemtime('js/pages/users/info.js') }}"></script>
@endpush

