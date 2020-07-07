@extends('default.layouts.default')

@section('page_title')
    {{$category->name}} | dự án bất động sản
@endsection

@section('content')
    <div class="project-category-container container mt-5 mb-5">
        <div class="row">
            <div class="category-tab-content tab-content cols-12 col-md-8">

                <div class="mb-4">
                    <div class="block-title">
                        <h4>{{$category->name}}</h4>
                    </div>

                    <div class="text-muted small">
                        {{$projects->total()}} dự án được tìm thấy
                    </div>
                </div>

                @include('default.partials.project.project-items-row', ['projects'=> $projects])

                <div class="mt-3 pagination justify-content-center">
                    {{$projects}}
                </div>
            </div>
            <div class="cols-12 col-md-4">
                @include('default.partials.project.show-categories-with-province',['activeCategoryId'=>$category->id])
                @include('default.partials.project.news_review')
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/partials/project/project-items-row.css') . '?m=' . filemtime('css/partials/project/project-items-row.css') }}">
    <link
        rel="stylesheet"
        href="{{ asset('css/partials/project/block-show-categories-with-province.css') . '?m=' . filemtime('css/partials/project/block-show-categories-with-province.css') }}">
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/project-category.css') . '?m=' . filemtime('css/pages/project/project-category.css') }}">
@endpush
