@extends('default.layouts.default')

@section('page_title')
    {{$project->category->name}} | {{$project->long_name}}
@endsection

@section('content')
    <div class="container page-project-detail-container mt-5 mb-5">
        <div class="row text-center mb-5">
            <div class="col">
                <h1>{{$project->long_name}}</h1>
                @if($project->short_name)
                    <h2 class="project-short-name">({{$project->short_name}})</h2>
                @endif
            </div>
        </div>

        <ul class="tab-btn-wrapper row">
            <li class="tab-btn-item">Tổng quan</li>
            @if(count($project->tabs)>0)
                @foreach($project->tabs as $tab)
                    <li class="tab-btn-item">{{$tab->name}}</li>
                @endforeach
            @endif
        </ul>
        @switch($tab['template'])
            @case('overview')
            @include('default.pages.project.project_detail_tabs.overview')
            @break
        @endswitch
    </div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/project-detail.css') . '?m=' . filemtime('css/pages/project/project-detail.css') }}">
@endpush
