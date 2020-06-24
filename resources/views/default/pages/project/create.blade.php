@extends('default.layouts.default')

@section('page_title')
    Đăng dự án
@endsection

@section('content')
    <div id="project-create-form-container" class="mt-5 mb-5"></div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/project/create.css') . '?m=' . filemtime('css/pages/project/create.css') }}">
@endpush

@push('scripts')
    <script src="/js/pages/project/create.js"></script>
@endpush
