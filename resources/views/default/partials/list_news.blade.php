@foreach($news as $key => $childNews)
    @if(!$key)
        <div class="row border-solid-default py-3">
            <div class="col-12 col-md-4">
                <div class="border border-dark p-1">
                    <div class="bg-default-image w-100 h-150 d-flex align-items-center overflow-hidden">
                        <img src="{{ $childNews->thumbnail_path }}" alt="" class="w-100">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 content-first-news pl-md-0 pt-md-2">
                <h4 class="font-weight-bold">
                    <a class="text-default" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                        {{ $childNews->title }}
                    </a>
                </h4>
                <p class="text-subtitle">{{ getDifferentTime($childNews->created_at) }}</p>
                <p class="text-justify">{{ $childNews->meta_content }}</p>
            </div>
        </div>
    @else
        <div class="row border-dotted-default py-3">
            <div class="col-12 col-md-3">
                <div class="border border-dark p-1">
                    <div class="bg-default-image w-100 h-120 d-flex align-items-center overflow-hidden">
                        <img src="{{ $childNews->thumbnail_path }}" alt="" class="w-100">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9 content-news pl-md-0 pt-md-2">
                <h4 class="font-weight-bold">
                    <a class="text-default" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                        {{ $childNews->title }}
                    </a>
                </h4>
                <p class="text-subtitle">{{ getDifferentTime($childNews->created_at) }}</p>
                <p class="text-justify">{{ $childNews->meta_content }}</p>
            </div>
        </div>
    @endif
@endforeach
<div class="row pagination-news my-3">
    <div class="col-12">
        {{ $news->links() }}
    </div>
</div>