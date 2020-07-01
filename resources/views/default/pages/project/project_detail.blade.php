@extends('default.layouts.default')

@section('page_title')
    {{$project->category->name}} | {{$project->long_name}}
@endsection

@section('content')
    <h1>{{$project->long_name}}</h1>
    @if($project->short_name)
        <h2>({{$project->short_name}})</h2>
    @endif

    <div>
        <h3>Thông tin chung</h3>
        <div class="container">
            <div class="row">
                <div class="col">Tên dự án</div>
                <div class="col">{{$project->long_name}}</div>
            </div>

            @if($project->address)
                <div class="row">
                    <div class="col">Địa chỉ</div>
                    <div class="col">{{$project->address->show()}}</div>
                </div>
            @endif

            @if($project->category)
                <div class="row">
                    <div class="col">Loại hình phát triển</div>
                    <div class="col">{{$project->category->name}}</div>
                </div>
            @endif

            @if($project->project_scale)
                <div class="row">
                    <div class="col">Quy mô dự án</div>
                    <div class="col">{{$project->project_scale}}</div>
                </div>
            @endif

            @if($project->total_area)
                <div class="row">
                    <div class="col">Tổng diện tích</div>
                    <div class="col">{{$project->total_area}}m²</div>
                </div>
            @endif

            @if($project->price)
                <div class="row">
                    <div class="col">Giá bán</div>
                    <div class="col">{{$project->getPriceFormatted()}}</div>
                </div>
            @endif
        </div>
    </div>
@endsection
