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

        <div class="row">
            <div class="col-md-7 col-sm-12 mb-5 mb-md-0">
                <div id="project-image-gallery" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i =0;$i<count($galleries);$i++)
                            <li data-target="#project-image-gallery" data-slide-to="{{$i}}"></li>
                        @endfor
                    </ol>

                    <div class="carousel-inner">
                        @foreach($galleries as $index => $gallery)
                            <div class="carousel-item {{$index === 0 ? 'active':''}}">
                                <img
                                    src="/storage/{{$gallery->file_path}}"
                                    class="d-block w-100 slide-image"
                                    alt="Hình ảnh dự án">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-sm-12 general-info-wrapper">
                <div class="row">
                    <div class="col"><h3>Thông tin chung</h3></div>
                </div>

                <div class="row">
                    <div class="col col-4 font-weight-bold">Tên dự án</div>
                    <div class="col">{{$project->long_name}}</div>
                </div>

                @if($project->address)
                    <div class="row">
                        <div class="col col-4 font-weight-bold">Địa chỉ</div>
                        <div class="col">{{$project->address->show()}}</div>
                    </div>
                @endif

                @if($project->category)
                    <div class="row">
                        <div class="col col-4 font-weight-bold">Loại hình phát triển</div>
                        <div class="col">{{$project->category->name}}</div>
                    </div>
                @endif

                @if($project->project_scale)
                    <div class="row">
                        <div class="col col-4 font-weight-bold">Quy mô dự án</div>
                        <div class="col">{{$project->project_scale}}</div>
                    </div>
                @endif

                @if($project->total_area)
                    <div class="row">
                        <div class="col col-4 font-weight-bold">Tổng diện tích</div>
                        <div class="col">{{$project->total_area}}m²</div>
                    </div>
                @endif

                @if($project->price)
                    <div class="row">
                        <div class="col col-4 font-weight-bold">Giá bán</div>
                        <div class="col">{{$project->getPriceFormatted()}}</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <h3>GIỚI THIỆU DỰ ÁN</h3>
                <div>
                    {!! $project->project_overview !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/project-detail.css') . '?m=' . filemtime('css/pages/project/project-detail.css') }}">
@endpush
