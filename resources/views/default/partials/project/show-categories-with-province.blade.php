@php($categories = getProjectCategoriesWithProjectCount())
@php($activeCategoryId = isset($activeCategoryId)?$activeCategoryId:0)

@if (!empty($categories))
    @php(
        $categories = $categories->sortBy(function ($model) use ($activeCategoryId){
            return $model->id !== $activeCategoryId;
        })
    )
    <div class="block-show-categories-with-province">
        @foreach($categories as $category)
            <div>
                <h3>
                    <a href="{{route('pages.project.show_projects_in_category',['categorySlug' => $category->slug])}}">
                        {{$category->name}}
                        <span>({{$category->total_projects}})</span>
                    </a>
                </h3>

                @if($activeCategoryId === $category->id)
                    @php($provinces = getProvincesInProjectCategory($activeCategoryId))
                    @if(!empty($provinces))
                        <ul>
                            @foreach($provinces as $province)
                                <li><span>{{$province->name}}</span></li>
                            @endforeach
                        </ul>
                    @endif
                @endif
            </div>
        @endforeach
    </div>
@endif
