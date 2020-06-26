<form action="{{ route('pages.user.news') }}" method="GET">
    <div class="row my-3">
        <div class="col-3">
            <span for="from_date" class="colorblue">Từ ngày</span>
            <input id="from_date" name="from_date" type="date" class="form-control fs-12" value="{{ request('from_date') }}">
        </div>
        <div class="col-3">
            <span for="to_date" class="colorblue">Đến ngày</span>
            <input id="to_date" name="to_date" type="date" class="form-control fs-12" value="{{ request('to_date') }}">
        </div>
        <div class="col-3">
            <span for="type_id" class="colorblue">Loại tin</span>
            <select id="type_id" name="type_id" class="form-control fs-12">
                <option value="">Chọn loại tin</option>
                <option value="">Tin VIP đặc biệt</option>
                <option value="">Tin VIP 1</option>
            </select>
        </div>
        <div class="col-3">
            <span for="status" class="colorblue">Trạng thái</span>
            <select id="status" name="status" class="form-control fs-12">
                <option value="">Tất cả</option>
                <option value="">Còn hạn</option>
                <option value="">Hết hạn</option>
            </select>
        </div>
    </div>
    <div class="row my-3">
    <div class="col-3">
            <span for="title" class="colorblue">Mã tin/ tiêu đề</span>
            <input id="title" name="title" type="text" class="form-control fs-12" value="{{ request('title') }}">
        </div>
        <div class="col-3">
            <div class="d-flex h-100">
                <button class="btn-search align-self-end" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </div>
</form>