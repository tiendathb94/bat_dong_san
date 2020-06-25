<table class="table table-bordered fs-12 text-center">
    <thead>
        <tr class="bg-thead">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Ngày đăng</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $newsChild)
          @switch($newsChild->status)
            @case(1)
              @php($bgColor = 'bg-dark')
              @break
            @case(2)
              @php($bgColor = 'bg-success')
              @break
            @default
              @php($bgColor = 'bg-await')
          @endswitch
            <tr>
                <td>{{ $newsChild->id }}</td>
                <td>{{ $newsChild->title }}</td>
                <td>{{ $newsChild->user->fullname }}</td>
                <td>{{ $newsChild->created_at_date }}</td>
                <td><span class="text-white {{ $bgColor }} px-2 py-1 rounded">{{ $newsChild->status_name }}</span></td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a title="" href="" class="mr-3">Sửa</a>|
                        <span id="btnDelete" data-action="{{ route('pages.news.destroy', $newsChild->id) }}" title="" href="" class="ml-3 text-danger cursor-pointer">Xóa</span>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="float-right fs-12">{{ $news->appends(request()->all())->links() }}</div>


<div class="modal" id="modalDelete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header border-0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body text-center">
        <i class="ti-alert text-danger fs-100"></i>
        <h3 class="my-5">Bạn chắc chắn muốn xóa?</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer border-0 justify-content-center">
        <form action="" method="POST" id="formDelete">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btnDelete', function () {
                $('#formDelete').attr('action', $(this).data('action'));
                $('#modalDelete').modal('show');
            })
        })
    </script>
@endpush