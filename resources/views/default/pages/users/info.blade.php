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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
@endpush

@push('scripts')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        window.user = @json($user)
    </script>
    <script src="{{ asset('js/pages/users/info.js') . '?m=' . filemtime('js/pages/users/info.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/i18n/jquery-ui-i18n.min.js"></script> -->
    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
        })
    </script>
@endpush

