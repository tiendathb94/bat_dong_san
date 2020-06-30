@extends('default.layouts.personal')

@section('page_title')
    Cập nhật thông tin chủ đầu tư
@endsection

@section('main_content')
    <div id="investor-form-container" class="mb-5"></div>
@endsection

@push('scripts')
    <script>
        window.investor = @json($investor);
    </script>
    <script src="{{ asset('js/pages/investor/form.js') . '?m=' . filemtime('js/pages/investor/form.js') }}"></script>
@endpush

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/investor/form.css') . '?m=' . filemtime('css/pages/investor/form.css') }}">
@endpush
