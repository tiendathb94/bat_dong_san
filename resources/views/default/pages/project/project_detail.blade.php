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
                @case('project_progress')
                    @include('default.pages.project.project_detail_tabs.project_progress', ['project' => $project])
                @break
                @case('investor')
                <div class="content-with-border row p-3">
                    @include('default.partials.company-detail',['company'=> $project->investor])
                </div>
                @break
            @endswitch
        </div>

        @if($project->address)
            @php($projectsSameLocation = getProjectsInLocation([
                'ward_id'=>$project->address->ward_id,
                'district_id'=>$project->address->district_id,
                'province_id'=>$project->address->province_id,
            ], 3, [$project->id]))

            @if($projectsSameLocation->count() > 0)
                <div class="projects-in-same-location">
                    <div class="row mt-4 mb-2">
                        <div class="col p-0">
                            <h4>Dự án cùng khu vực</h4>
                        </div>
                    </div>

                    <div class="row">
                        @include('default.partials.project.project-items-card',['projects'=>$projectsSameLocation])
                    </div>
                </div>
            @endif
        @endif
        <div class="row mt-3">
            <div class="col-12 col-md-8">

            </div>
            <div class="cols-12 col-md-4">
                @include('default.partials.project.news_review')
                @include('default.partials.project.project_progress')
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/partials/project/project-items-card.css') . '?m=' . filemtime('css/partials/project/project-items-card.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/project-detail.css') . '?m=' . filemtime('css/pages/project/project-detail.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/partials/company-detail.css') . '?m=' . filemtime('css/partials/company-detail.css') }}">
@endpush

@push('scripts')
    <script src="/vendor/js/jquery.waterwheelCarousel.min.js"></script>
    <script>
        $(document).ready(function() {
            if($(window).width() > 768) {
                $(".carousel-progress-project").waterwheelCarousel({
                    separation: 150
                });
            } else {
                $(".carousel-progress-project").waterwheelCarousel({
                    separation: 80
                });
            }

            let translateX = 0; 
            $('.next').click(function () {
                translateX -= 30;
                $('.events-wrapper ol').css('transform', `translateX(${translateX}px)`)
            })

            $('.prev').click(function () {
                if(translateX <= -30) {
                    translateX += 30;
                    $('.events-wrapper ol').css('transform', `translateX(${translateX}px)`)
                }
            })
        });
    </script>
@endpush
