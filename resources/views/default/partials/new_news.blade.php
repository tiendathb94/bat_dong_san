@php($firstNews = $news->first())
<div class="container">
    <div class="row">
        <div class="col-6">
            @include('default.partials.title_category', ['title' => 'Tin nổi bật'])
            <div class="row">
                <div class="col-12">
                    <img src="{{ $firstNews->thumbnail_path }}" alt="" class="w-100 mb-3">
                    <h4><a class="text-default" title="{{ $firstNews->title }}" href="{{ route('news.show', [$firstNews->category->slug, $firstNews->slug]) }}">{{ $firstNews->title }}</a></h4>
                    <span class="news-time">{{ $firstNews->created_at }}</span>
                    <p>{{ $firstNews->meta_content }}</p>
                </div>
                @foreach($news->except($firstNews->id) as $childNews)
                    <div class="col-4 mb-3">
                        <img src="{{ $childNews->thumbnail_path }}" alt="" class="w-100 mb-3">
                        <a class="text-default" title="{{ $childNews->title }}" href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                            {{ $childNews->title }}
                        </a>
                        <span class="news-time">{{ $childNews->created_at }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>