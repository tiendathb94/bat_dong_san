@extends('default.layouts.personal')

@section('page_title')
    Cập nhật dự án
@endsection

@section('main_content')
    <div id="project-form-container" class="mb-5"></div>
@endsection

@push('styles')
    <link href="{{ asset('vendor/css/gijgo.min.css') }}" rel="stylesheet" type="text/css" />
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/form.css') . '?m=' . filemtime('css/pages/project/form.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/js/gijgo.min.js') }}" type="text/javascript"></script>
    <script>
        window.project = @json($project)
    </script>

    <script src="{{ asset('js/pages/project/form.js') . '?m=' . filemtime('js/pages/project/form.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
        })
    </script>
@endpush
