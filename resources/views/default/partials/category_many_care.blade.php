@php($categories = getCategoryManyPeopleCare())
<div class="w-100">
    <h4 class="text-white rounded-top mb-0 text-center py-2 font-weight-bold">Chủ đề được quan tâm</h4>
</div>
<div class="w-100 border p-2">
    <div class="row">
        <div class="col-12">
            <ul class="pl-5">
                @foreach($categories as $category)
                    <li>
                        <a class="text-dark" title="{{ $category->name }}" href="{{ route('category.show', $category->slug) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

