<form action="{{ route('pages.user.news') }}" method="GET">
    <div class="row my-3">
        <div class="col-4">
            <span for="title" class="colorblue">Tìm kiếm</span>
            <input id="title" name="title" type="text" class="form-control fs-12" value="{{ request('title') }}">
        </div>
        <div class="col-4">
            <span for="category_id" class="colorblue">Chủ đề</span>
            <select id="category_id" name="category_id" class="form-control fs-12">
            <option value="">Tất cả chủ đề</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-4">
            <button class="btn-search" type="submit">Tìm kiếm</button>
        </div>
    </div>
</form>