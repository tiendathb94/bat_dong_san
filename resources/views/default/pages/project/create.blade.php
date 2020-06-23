@extends('default.layouts.default')

@section('page_title')
    Đăng dự án
@endsection

@section('content')
    <div id="project-create-form-container"></div>
@endsection

@push('scripts')
    <script src="/js/pages/project/create.js"></script>
@endpush
