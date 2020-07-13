@php($images = $project->imageLibraries->where('library_type', 'progress')->sortBy('date_sort')->groupBy('date_upload_file'))
@php($date = request()->d ?: $images->last()[0]->date_upload_file)
<div class="row">
    <div class="col-12">
        <h4 class="text-uppercase">HÌNH ẢNH DỰ ÁN CẬP NHẬT NGÀY {{ convertDateFormat($date) }}</h4>
    </div>
    <div class="col-12">
        <div class="border show-image">
            @foreach($images as $key => $value)
                @if($date == $key)
                <div class="carousel-progress-project">
                    @foreach($value as $image)
                        <img src="{{ '/storage' . $image->file_path }}" alt="" class=""/>
                    @endforeach
                </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-12">
        <div class="border bg-timeline">
            <h4 class="text-uppercase mt-3">TIẾN ĐỘ DỰ ÁN {{ $project->long_name }}</h4>
            <div class="d-flex justify-content-center">
                <div class="w-75 timeline position-relative">
                    <div class="events-wrapper w-100 position-relative h-100">
                        <div class="line"></div>
                        <ol>
                            @foreach($images as $key => $value)
                                <li>
                                    <a href="{{  url()->current() . '?d=' . $key }}" class="{{ $date == $key ? 'active' : '' }}">{{ convertDateFormat($key) }}</a>
                                </li>
                            @endforeach
                        </ol>
                    </div> 
                    <i class="ti-angle-left prev border p-2 rounded-circle cursor-pointer border-dark"></i>
                    <i class="ti-angle-right next border p-2 rounded-circle cursor-pointer border-dark"></i>
                </div>
            </div>
        </div>
    </div>
</div>