@php($newsReviewProject = getNewsReviewProject())
@php($firstNews = $newsReviewProject ? $newsReviewProject->first() : [])
@if($firstNews)
    <div class="w-100">
        <h4 class="font-weight-bold title-block"><span>Đánh giá dự án</span></h4>
    </div>
    <div class="w-100 border">
        <a title="{{ $firstNews->title }}" href="{{ route('news.show', [$firstNews->category->slug, $firstNews->slug]) }}">
            <img src="{{ '/storage' . $firstNews->project->imageLibraries->first()->file_path }}" alt="{{ $firstNews->title }}" class="w-100 mb-3">
        </a>
        <div class="p-2">
            <a title="{{ $firstNews->title }}"
                class="font-weight-bold"
                href="{{ route('news.show', [$firstNews->category->slug, $firstNews->slug]) }}">
                Đánh giá dự án {{ $firstNews->project->short_name }}: {{ $firstNews->title }}
            </a>
            <ul class="pl-5">
                @foreach($newsReviewProject->except($firstNews->id) as $childNews)
                    <li>
                        <a class="" title="{{ $childNews->title }}" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                            Đánh giá dự án {{ $childNews->project->short_name }}: {{ $childNews->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif