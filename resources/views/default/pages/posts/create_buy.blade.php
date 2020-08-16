@extends('default.layouts.personal')

@section('page_title')
    Đăng tin cần mua, cần thuê nhà đất
@endsection

@section('main_content')
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($error = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $error }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <h4>Thông tin mô tả</h4>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12">
                <label htmlFor="title">Tiêu đề <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" id="title" name="title"/>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12">
                <label htmlFor="content">Nội dung tin đăng <span class="text-danger">(*)</span></label>
                <textarea rows="3" class="form-control" id="content" name="content"></textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                <label htmlFor="">Tải lên hình ảnh</label>
                <input type="file" name="image" class="form-control" id="imgInp" accept="image/png, image/jpeg, image/jpg, image/gif">
            </div>
            <div class="col-6">
                <img style="width: 200px; margin-top: 10px"  alt="" id="blah">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4>Thông tin cơ bản</h4>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="form">Hình thức <span class="text-danger">(*)</span></label>
                <select class="form-control" id="form" name="slug">
                    <option value="">-- Hình thức --</option>
                    <option value="nha-dat-can-mua">Nhà đất cần mua</option>
                    <option value="nha-dat-can-thue">Nhà đất cần thuê</option>
                </select>
            </div>
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Loại <span class="text-danger">(*)</span></label>
                <select class="form-control" id="form" name="category_id">
                    <option value="">Loại</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category ->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="form">Tỉnh/Thành phố <span class="text-danger">(*)</span></label>
                <select class="form-control" id="form" name="province_id" onchange="getDistricts($(this).val())">
                    <option value="">-- Tỉnh/Thành phố --</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province ->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Quận/Huyện <span class="text-danger">(*)</span></label>
                <select class="form-control" disabled id="district" name="district_id" onchange="getWards($(this).val())">
                    <option value="">-- Quận/Huyện --</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Phường/Xã <span class="text-danger">(*)</span></label>
                <select class="form-control" disabled id="ward" name="ward_id">
                    <option value="">-- Phường/Xã --</option>
                </select>
            </div>
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Đường/Phố <span class="text-danger">(*)</span></label>
                <input type="text" name="address" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Dự án</label>
                <select class="form-control" id="form" name="project_id">
                    <option value="">-- Dự án --</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project ->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Diện tích</label>
                <div class="w-75 d-flex align-items-center">
                    <input type="number" class="form-control mr-3" name="total_area"/>
                    <span>m2</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-sm-12 col-md-6">
                <label htmlFor="">Giá</label>
                <input  type="number" class="form-control mr-3" name="price"/>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col d-flex justify-content-center">
                <button type="submit" class="btn btn-success mr-3">Đăng tin</button>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/posts/create_sell.css') . '?m=' . filemtime('css/pages/posts/create_sell.css') }}">
@endpush
@push('scripts')
    <script>
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        window.requestOld = @json(old());
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

        function getDistricts(id) {
            $.ajax({
                url: "{{ route('posts.get.district') }}",
                type: "POST",
                data: {
                    id: id
                },
                success: function (respon) {
                    let text = '<option value="" class="d-none" disabled selected>-- Quận/Huyện --</option>';
                    $.each( respon.districts, function( key, value ) {
                        text += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $('#district').removeAttr('disabled');
                    $('#district').html(text);
                },
                errors: function () {
                    alert('Lỗi server chưa lấy được danh sách huyện.')
                }
            })
        }

        function getWards(id) {
            $.ajax({
                url: "{{ route('posts.get.ward') }}",
                type: "POST",
                data: {
                    id: id
                },
                success: function (respon) {
                    let text = '<option value="" class="d-none" disabled selected>-- Phường/Xã --</option>';
                    $.each( respon.wards, function( key, value ) {
                        text += `<option value="${value.id}">${value.name}</option>`;
                    });
                    $('#ward').removeAttr('disabled');
                    $('#ward').html(text);
                },
                errors: function () {
                    alert('Lỗi server chưa lấy được danh sách huyện.')
                }
            })
        }
    </script>
	<script src="{{ asset('vendor/js/gijgo.min.js') }}" type="text/javascript"></script>
@endpush
