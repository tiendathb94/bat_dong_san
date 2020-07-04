<div class="project-items-row">
    @foreach($projects as $project)
        <div class="row mt-3 ml-0 mr-0">
            <div class="col col-4 col-md-2 image-wrapper">
                <a href="{{route('pages.project.project_detail',['categorySlug'=>$project->category->slug,'slug'=>$project->slug])}}">
                    <img src="{{$project->getThumbnail()}}" class="card-img-top">
                </a>
            </div>
            <div class="col col-8 col-md-10 pl-0 pt-3 pb-3">
                <h2>
                    <a href="{{route('pages.project.project_detail',['categorySlug'=>$project->category->slug,'slug'=>$project->slug])}}">
                        {{$project->long_name}}
                    </a>
                </h2>
                <div>
                    @if($project->address)
                        <div>
                            Địa{{$project->address->show()}}
                        </div>
                    @endif
                </div>
                <div>
                    Giá từ: {{$project->price ? $project->getPriceFormatted() : 'Đang cập nhật'}}
                </div>
            </div>
        </div>
    @endforeach
</div>
