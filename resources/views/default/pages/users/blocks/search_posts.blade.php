<form action="{{ $action }}" method="GET">
    <div class="row my-3">
        <div class="col-4">
            <span for="title" class="colorblue">Tìm kiếm</span>
            <input id="title" name="title" type="text" class="form-control fs-12" value="{{ request('title') }}">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-4">
            <button class="btn-search" type="submit">Tìm kiếm</button>
        </div>
    </div>
</form>
