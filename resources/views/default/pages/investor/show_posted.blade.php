@extends('default.layouts.personal')

@section('page_title')
    Quản lý chủ đầu tư đã đăng
@endsection

@section('main_content')
    <h3 class="mb-3">Quản lý chủ đầu tư đã đăng</h3>
    <form class="mb-4">
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label>Từ khóa</label>
                <input
                    class="form-control"
                    name="keyword"
                    placeholder="Nhập từ khóa tìm kiếm"
                    value="{{$keyword}}"
                />
            </div>
            <div class="col col-sm-12 col-md-4 mt-md-5">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    @if(count($investors)<1)
        @include('default.partials.no-data',['message'=>'Bạn chưa đăng thông tin chủ đầu tư nào hoặc không có kết quả phù hợp với tìm kiếm của bạn.'])
    @else
        <table class="table table-bordered fs-12">
            <thead>
            <tr class="bg-thead">
                <th class="d-md-table-cell">ID</th>
                <th>Tên công ty/tổ chức</th>
                <th class="d-none d-md-table-cell">Phone</th>
                <th class="d-none d-md-table-cell">Ngày đăng</th>
                <th class="text-center">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($investors as $investor)
                <tr>
                    <td class="d-md-table-cell">{{$investor->id}}</td>
                    <td>{{$investor->name}}</td>
                    <td class="d-none d-md-table-cell">{{$investor->phone}}</td>
                    <td class="d-none d-md-table-cell">{{\Carbon\Carbon::parse($investor->created_at)->format('d/m/Y')}}</td>
                    <td class="text-center">
                        <a href="{{route('pages.investor.update', ['investorId' => $investor->id])}}">
                            <span class="ti-pencil-alt"></span> Sửa
                        </a>

                        <a href="" class="delete-investor-button" data-investor-id="{{$investor->id}}">
                            <span class="ti-trash"></span> Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{$investors->render()}}

        <div id="background-react-component-container"></div>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/investor/manage.js') . '?m=' . filemtime('js/pages/investor/manage.js') }}"></script>
@endpush
