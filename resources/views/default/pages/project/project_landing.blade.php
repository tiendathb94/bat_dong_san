@extends('default.layouts.default')

@section('page_title')
    Tin tức dự án bất động sản mất nhất cập nhật liên tục
@endsection

@section('content')
    <div class="container mt-5">
        <div id="js-form-search"></div>
        @if(count($projectsInSlider)>0)
            <div class="row">
                <div class="col">
                    <div id="project-slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for($i=0;$i<count($projectsInSlider);$i++)
                                <li
                                    data-target="#project-slider"
                                    data-slide-to="{{$i}}"
                                    class="{{$i===0?'active':''}}">
                                </li>
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                            @foreach($projectsInSlider as $i => $projectInSlider)
                                <div class="carousel-item {{$i===0?'active':''}}">
                                    <div class="slide-image-wrapper">
                                        <a href="{{route('pages.project.project_detail',['categorySlug'=>$projectInSlider->category->slug,'slug'=>$projectInSlider->slug])}}">
                                            <img src="/storage/{{$projectInSlider->imageLibraries->first()->file_path}}"
                                                 class="d-block w-100">
                                        </a>
                                    </div>
                                    <div class="carousel-caption d-md-block">
                                        <h5>
                                            <a href="{{route('pages.project.project_detail',['categorySlug'=>$projectInSlider->category->slug,'slug'=>$projectInSlider->slug])}}">
                                                {{$projectInSlider->long_name}}
                                            </a>
                                        </h5>
                                        <p class="content">
                                            @php($projectOverview = trim(strip_tags($projectInSlider->project_overview),' '))
                                            {{str_limit($projectOverview,150,'...')}}
                                        </p>
                                        <a href="{{route('pages.project.project_detail',['categorySlug'=>$projectInSlider->category->slug,'slug'=>$projectInSlider->slug])}}"
                                           class="view-detail-link">
                                            Chi tiết <span>→</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col">
                <div class="block-title">
                    <h4>Dự án mới cập nhật</h4>
                </div>
                @include('default.partials.project.project-items-card',['projects'=>$newestProjects])
            </div>
        </div>

        <div class="mb-5">
            <div class="row">
                <div class="category-tab-content tab-content cols-12 col-md-8">
                    <div class="col category-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($projectsMapByCategory as $index => $projectMapByCategory)
                                <li class="nav-item category-item"
                                    role="presentation" {{$index===0?'aria-selected="true"':''}}>
                                    <a data-toggle="tab" href="#project-in-category-{{$projectMapByCategory['id']}}"
                                       class="nav-link {{$index===0?'active':''}}" role="tab"
                                       aria-controls="project-in-category-{{$projectMapByCategory['id']}}">
                                        {{$projectMapByCategory['name']}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <hr/>
                    </div>

                    @foreach($projectsMapByCategory as $index => $projectMapByCategory)
                        <div
                            class="tab-pane fade {{$index===0?'show active':''}}"
                            id="project-in-category-{{$projectMapByCategory['id']}}"
                            role="tabpanel">
                            <div class="col">
                                @if (count($projectMapByCategory['projects'])>0)
                                    @include('default.partials.project.project-items-row',['projects'=>$projectMapByCategory['projects']])
                                @else
                                    <p class="pt-5">Chưa có dự án nào phát triển theo mô hình này.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="cols-12 col-md-4 mt-4">
                    @include('default.partials.project.show-categories-with-province')
                    @include('default.partials.project.news_review')
                    @include('default.partials.project.project_progress')
                </div>
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
        href="{{ asset('css/partials/project/block-show-categories-with-province.css') . '?m=' . filemtime('css/partials/project/block-show-categories-with-province.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/partials/project/project-items-row.css') . '?m=' . filemtime('css/partials/project/project-items-row.css') }}">

    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/project-landing.css') . '?m=' . filemtime('css/pages/project/project-landing.css') }}">
    <link
        rel="stylesheet"
        href="{{ asset('css/partials/project/block-search.css') . '?m=' . filemtime('css/partials/project/block-search.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/pages/project/search.js') . '?m=' . filemtime('js/pages/project/search.js') }}"></script>
@endpush