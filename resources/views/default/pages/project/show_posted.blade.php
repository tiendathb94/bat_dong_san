@extends('default.layouts.personal')

@section('page_title')
    Quản lý dự án đã đăng
@endsection

@section('main_content')
    <h3 class="mb-3">Quản lý dự án đã đăng</h3>
    <form class="mb-5">
        <div class="row">
            <div class="form-group col">
                <label>Từ khóa</label>
                <input class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm" value="{{$keyword}}"/>
            </div>
            <div class="form-group col">
                <label>Loại hình phát triển</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Loại hình phát triển --</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$categoryId == $category->id ? 'selected':''}}>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered fs-12 text-center">
        <thead>
        <tr class="bg-thead">
            <th class="d-none d-md-table-cell">ID</th>
            <th>Tên dự án</th>
            <th class="d-none d-md-table-cell">Tên ngắn</th>
            <th class="d-none d-md-table-cell">Loại hình phát triển</th>
            <th>Trạng thái</th>
            <th class="d-none d-md-table-cell">Ngày tạo</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr>
                <td class="d-none d-md-table-cell">{{$project->id}}</td>
                <td>{{$project->long_name}}</td>
                <td class="d-none d-md-table-cell">{{$project->short_name}}</td>
                <td class="d-none d-md-table-cell">{{$project->category ? $project->category->name:''}}</td>
                <td>
                    @switch($project->status)
                        @case(\App\Entities\Project::StatusPending)
                        <span class="bg-warning p-2 text-secondary">Đợi duyệt</span>
                        @break

                        @case(\App\Entities\Project::StatusApproved)
                        <span class="bg-success p-2 text-white">Đã duyệt</span>
                        @break

                        @case(\App\Entities\Project::StatusDeclined)
                        <span class="bg-danger p-2 text-white">Bị từ chối</span>
                        @break
                    @endswitch
                </td>
                <td class="d-none d-md-table-cell">{{\Carbon\Carbon::parse($project->created_at)->format('d/m/Y')}}</td>
                <td>
                    <a href="">
                        <span class="ti-pencil-alt"></span> Sửa
                    </a>

                    <a href="">
                        <span class="ti-trash"></span> Xóa
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{$projects->render()}}
@endsection
