@extends('default.layouts.personal')

@section('page-title')
    Quản lý tin rao bán/cho thuê
@endsection

@section('main_content')
    @php($user = auth()->user())
    @php($block = 'default.pages.users.blocks.')

    @include($block . 'title', ['title' => 'Quản lý tin rao bán/cho thuê'])
    @include($block . 'search_posts', ['action' => route('posts.list_sell')])
    @include('default.partials.flash-message')
    @include($block . 'table', ['posts' => $posts])
    @include($block . 'modal_confirm')
@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/pages/users/index.css') . '?m=' . filemtime('css/pages/users/index.css') }}">
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.js-change-status').change(function () {
                let url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'get'
                })
            })
        })
    </script>
@endpush