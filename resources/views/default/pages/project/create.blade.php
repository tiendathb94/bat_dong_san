@extends('default.layouts.personal')

@section('page_title')
    Đăng dự án
@endsection

@section('main_content')
    <div id="project-form-container" class="mb-5"></div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/form.css') . '?m=' . filemtime('css/pages/project/form.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/pages/project/form.js') . '?m=' . filemtime('js/pages/project/form.js') }}"></script>
@endpush
