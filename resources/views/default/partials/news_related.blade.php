    <div class="row">
        <div class="col-12">
            <span class="font-weight-bold">
                Cùng chủ đề: 
            </span>
            <a href="">{{ $category->name }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <ul class="related-news">
                @foreach($relatedNews as $childRelatedNews)
                    <li>
                        <a class="font-weight-bold text-default" href="{{ route('news.show', [$category->slug, $childRelatedNews->slug]) }}">
                            {{ $childRelatedNews->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>