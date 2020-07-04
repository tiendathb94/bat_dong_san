<div class="project-items-card row row-cols-sm-2 row-cols-md-3">
    @foreach($projects as $project)
        <div class="project-item-wrapper col-md-4 col-6 align-items-stretch d-flex">
            <div class="card">
                <div class="card-img">
                    <a href="{{route('pages.project.project_detail',['categorySlug'=>$project->category->slug,'slug'=>$project->slug])}}">
                        <img src="{{$project->getThumbnail()}}" class="card-img-top">
                    </a>
                </div>
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="{{route('pages.project.project_detail',['categorySlug'=>$project->category->slug,'slug'=>$project->slug])}}">
                            {{$project->long_name}}
                        </a>
                    </h3>
                    <div class="card-text">
                        @if($project->address)
                            <div>
                                {{$project->address->show()}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    Giá từ: {{$project->price ? $project->getPriceFormatted() : 'Đang cập nhật'}}
                </div>
            </div>
        </div>
    @endforeach
</div>

