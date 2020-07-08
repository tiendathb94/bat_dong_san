@php($imageProgressProjects = getImageProjectProgress())
@if($imageProgressProjects)
    <div class="w-100 mt-3">
        <h4 class="font-weight-bold title-block"><span>Tiến độ dự án</span></h4>
    </div>
    <div class="w-100 border">
        <div id="slideProgressProjects" class="carousel slide p-3" data-ride="carousel">
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @foreach($imageProgressProjects->take(5) as $imageProgressProject)
                    <div class="row mb-2">
                        <div class="col-4">
                            <div class="bg-default-image w-100 h-65 d-flex align-items-center overflow-hidden">
                                <img src="{{ $imageProgressProject->gallery_image }}" alt="{{ $imageProgressProject->project->long_name }}" class="w-100">
                            </div>
                        </div>
                        <div class="col-8 pl-0">
                            <a title="{{ $imageProgressProject->project->long_name }}"
                                href="{{ route('pages.project.project_detail', [$imageProgressProject->project->category->slug, $imageProgressProject->project->slug]) }}" 
                                class="font-weight-bold">{{ $imageProgressProject->project->short_name }}</a>
                            <p>Tiến độ dự án cập nhật ngày: {{ $imageProgressProject->date_upload_file }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="carousel-item">
                    @foreach($imageProgressProjects->skip(5) as $imageProgressProject)
                        <div class="row mb-2">
                            <div class="col-4">
                                <div class="bg-default-image w-100 h-65 d-flex align-items-center overflow-hidden">
                                    <img src="{{ $imageProgressProject->gallery_image }}" alt="{{ $imageProgressProject->project->long_name }}" class="w-100">
                                </div>
                            </div>
                            <div class="col-8 pl-0">
                                <a title="{{ $imageProgressProject->project->long_name }}" 
                                    href="{{ route('pages.project.project_detail', [$imageProgressProject->project->category->slug, $imageProgressProject->project->slug]) }}" 
                                    class="font-weight-bold">{{ $imageProgressProject->project->short_name }}</a>
                                <p>Tiến độ dự án cập nhật ngày: {{ $imageProgressProject->date_upload_file }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-100 text-right">
                <a class="ti-angle-left border p-1" href="#slideProgressProjects" data-slide="prev"></a>
                <a class="ti-angle-right border p-1" href="#slideProgressProjects" data-slide="next"></a>
            </div>
        </div>
    </div>

@endif