@php($statistics = getStatisticsNewsManyPeopleRead($category->id))
<div class="w-100">
    <h4 class="text-white rounded-top mb-0 text-center py-2 font-weight-bold">Tin nhiều người đọc</h4>
</div>
<div class="w-100 border p-2">
    @foreach($statistics as $statistic)
        <div class="row mb-3">
            <div class="col-4">
                <a title="{{ $statistic->news->title }}" href="{{ route('news.show', [$statistic->news->category->slug, $statistic->news->slug]) }}">
                    <img alt="" src="{{ $statistic->news->thumbnail_path }}" alt="" class="w-100">
                </a>
            </div>
            <div class="col-8 pl-0">
                <a title="{{ $statistic->news->title }}" href="{{ route('news.show', [$statistic->news->category->slug, $statistic->news->slug]) }}" class="text-dark">
                    {{ $statistic->news->title }}
                </a>
            </div>
        </div>
    @endforeach
</div>

