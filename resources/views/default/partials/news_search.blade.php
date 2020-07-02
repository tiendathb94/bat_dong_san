<div class="container search-news">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-5">
            <form action="{{ $actionSearch }}" method="get">
                <div class="form-inline">
                    <input type="text" class="form-control mx-2 mb-2" placeholder="Nhập từ khóa để tìm kiếm theo cụm từ">
                    <select name="" id="" class="form-control mx-2 mb-2">
                        <option value="">Nhà đất bán</option>
                        <option value="">Nhà đất cho thuê</option>
                        <option value="">Tin tức</option>
                        <option value="">Hỏi đáp</option>
                        <option value="">Dự án</option>
                        <option value="">Doanh nghiệp</option>
                        <option value="">Môi giới</option>
                    </select>
                    <button type="submit" class="btn btn-primary mx-2 mb-2">
                        Tìm kiếm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row page-title mt-3">
        <div class="col-12">
            <h1>{{ $title }}</h1>
            <span>{{ $time }}</span>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
</div>