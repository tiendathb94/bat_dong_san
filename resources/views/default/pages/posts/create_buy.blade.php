@extends('default.layouts.personal')

@section('page_title')
    Đăng tin rao bán, cho thuê nhà đất
@endsection

@section('main_content')
    <div id="js-form-create-buy-posts"></div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/posts/create_sell.css') . '?m=' . filemtime('css/pages/posts/create_sell.css') }}">
@endpush
@push('scripts')
	<script src="{{ asset('vendor/js/gijgo.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/posts/create_buy.js') . '?m=' . filemtime('js/pages/posts/create_buy.js') }}"></script>
    <script>
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        if (today.getMonth() == 11) {
            var current = new Date(today.getFullYear() + 1, 0, 1);
        } else {
            var current = new Date(today.getFullYear(), today.getMonth() + 1, 1);
        }
        console.log(today);
        console.log(current);

        today = yyyy + '-' + mm + '-' + dd ;

        $('input[name="from_date"]').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            value: today
        });
        $('input[name="to_date"]').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd/mm/yyyy',
            value: '2020-09-14'
        });
    </script>
@endpush
