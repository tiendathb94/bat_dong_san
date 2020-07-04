@php($firstNews = $news->first())
@if($firstNews)
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                @include('default.partials.title_category', ['title' => 'Tin nổi bật'])
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="w-100 overflow-hidden mb-3 h-300 d-flex align-items-center bg-image-title">
                            <a title="{{ $firstNews->title }}" href="{{ route('news.show', [$firstNews->category->slug, $firstNews->slug]) }}">
                                <img src="{{ $firstNews->thumbnail_path }}" alt="" class="w-100">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <h4>
                            <a class="text-default font-weight-bold" title="{{ $firstNews->title }}" href="{{ route('news.show', [$firstNews->category->slug, $firstNews->slug]) }}">
                                {{ $firstNews->title }}
                            </a>
                        </h4>
                        <p class="news-time">{{ getDifferentTime($firstNews->created_at) }}</span>
                        <p>{{ $firstNews->meta_content }}... <a class="news-more" href="{{ route('news.show', [$firstNews->category->slug, $firstNews->slug]) }}" title="">đọc thêm</a></p>
                    </div>
                    @foreach($news->except($firstNews->id) as $childNews)
                        <div class="col-md-4 col-6 mb-3">
                            <div class="w-100 overflow-hidden mb-3 h-150 d-flex align-items-center bg-image-title">
                                <a title="{{ $childNews->title }}" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                                    <img src="{{ $childNews->thumbnail_path }}" alt="" class="w-100">
                                </a>
                            </div>
                            <a class="text-default" title="{{ $childNews->title }}" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                                {{ $childNews->title }}
                            </a>
                            <p class="news-time">{{ getDifferentTime($childNews->created_at) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif