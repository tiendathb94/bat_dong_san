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
            <li class="tab-btn-item {{$activeTab['template']=='overview'?'active':''}}">
                <a href="{{route('pages.project.project_detail',['categorySlug'=>$project->category->slug, 'slug'=>$project->slug])}}">
                    Tổng quan
                </a>
            </li>
            @if(count($project->tabs)>0)
                @foreach($project->tabs as $tab)
                    <li class="tab-btn-item {{$activeTab['id']==$tab->id?'active':''}}">
                        <a href="{{route('pages.project.project_detail_tab',['categorySlug'=>$project->category->slug, 'slug'=>$project->slug,'tabId' => $tab->id])}}">
                            {{$tab->name}}
                        </a>
                    </li>
                @endforeach
            @endif

            @if($project->investor)
                <li class="tab-btn-item {{$activeTab['template']=='investor'?'active':''}}">
                    <a href="{{route('pages.project.project_detail_tab',['categorySlug'=>$project->category->slug, 'slug'=>$project->slug,'tabId'=>'investor'])}}">
                        {{$project->investor_type === \App\Entities\Project::InvestorTypeInvest ? 'Chủ đầu tư' : 'Nhà phân phối'}}
                    </a>
                </li>
            @endif
        </ul>

        <div class="tab-content">
            @switch($activeTab['template'])
                @case('overview')
                @include('default.pages.project.project_detail_tabs.overview')
                @break
                @case('location_infrastructure')
                @include('default.pages.project.project_detail_tabs.location_infrastructure')
                @break
                @case('custom')
                @include('default.pages.project.project_detail_tabs.custom')
                @break
                @case('investor')
                <div class="content-with-border row p-3">
                    @include('default.partials.company-detail',['company'=> $project->investor])
                </div>
                @break
            @endswitch
        </div>
    </div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/project-detail.css') . '?m=' . filemtime('css/pages/project/project-detail.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/partials/company-detail.css') . '?m=' . filemtime('css/partials/company-detail.css') }}">
@endpush
