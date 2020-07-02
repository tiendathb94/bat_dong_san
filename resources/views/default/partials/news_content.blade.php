<div class="container content-news mb-5">
    <div class="row">
        <div class="col-12">
            {!! $news->content !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right font-weight-bold">
            {{ $news->user->fullname }}
        </div>
    </div>
    <div class="row">
        @foreach($relatedNews as $childRelatedNews)
            <div class="col-12 font-weight-bold">
                <a class="text-default" href="{{ route('news.show', [$category->slug, $childRelatedNews->slug]) }}" >
                    &gt;&gt; {{ $childRelatedNews->title }}
                </a>
            </div>
        @endforeach
    </div>
</div>