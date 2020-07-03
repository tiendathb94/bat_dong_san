@foreach($news as $key => $childNews)
    @if(!$key)
        <div class="row border-bottom border-dark">
            <div class="col-12 col-md-4">
                <img src="{{ $childNews->thumbnail_path }}" alt="">
            </div>

            <div class="col-12 col-md-8">
                <h4>
                    <a href="{{ route('news.show', [$childNews->category->slug, $childNews->slug]) }}">
                        {{ $childNews->title }}
                    </a>
                </h4>
                <p>{{ $childNews->created_at }}</p>
                <p>{{ $childNews->meta_content }}</p>
            </div>
        </div>
    @else
    @endif
@endforeach