@php($firstNews = $category->news->first())
@if($firstNews)
    <div class="container">
        <div class="row">
            <div class="col-6">
                @include('default.partials.title_category', ['title' => $category->name])
                <div class="row">
                    <div class="col-7">
                        <img src="{{ $firstNews->thumbnail_path }}" alt="" class="w-100 mb-3">
                        <h4><a class="text-default" title="{{ $firstNews->title }}" href="{{ route('news.show', [$category->slug, $firstNews->slug]) }}">{{ $firstNews->title }}</a></h4>
                        <span class="news-time">{{ getDifferentTime($firstNews->created_at) }}</span>
                        <p>{{ $firstNews->meta_content }}</p>
                    </div>
                    <div class="col-5">
                    @foreach($category->news->except($firstNews->id) as $childNews)
                        <p class="mb-0">
                            <a class="text-default" title="{{ $childNews->title }}" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                                {{ $childNews->title }}
                            </a>
                        </p>
                        <p class="news-time">{{ getDifferentTime($childNews->created_at) }}</span>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif