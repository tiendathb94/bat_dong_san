<table class="table table-bordered fs-12 text-center">
    <thead>
        <tr class="bg-thead">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Ngày đăng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $newsChild)
            <tr>
                <td>{{ $newsChild->id }}</td>
                <td>{{ $newsChild->title }}</td>
                <td>{{ $newsChild->user->fullname }}</td>
                <td>{{ $newsChild->created_at_date }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                      <span data-status="2" data-action="{{ route('news.update_status', $newsChild->id) }}" title="" class="mr-3 text-primary cursor-pointer js-update-status">Phê duyệt</span>|
                      <span data-status="1" data-action="{{ route('news.update_status', $newsChild->id) }}" title="" class="ml-3 text-danger cursor-pointer js-update-status">Từ chối</span>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if(!$news->count())
  @if(request('title') || request('category_id'))
    <p class="fs-12 text-center">Dữ liệu tìm kiếm không có, vui lòng kiểm tra lại.</p>
  @else
    <p class="fs-12 text-center">Hiện chưa có bài tin tức nào.</p>
  @endif
@endif
<div class="float-right fs-12">{{ $news->appends(request()->all())->links() }}</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.js-update-status', function () {
              let action = $(this).data('action');
              let status = $(this).data('status');
              $('#status').val(status);
              $('#formUpdateStatus').attr('action', action);
              if (status == 2) {
                $('#formUpdateStatus').submit();
              } else {
                $('#modalUpdateStatus').modal('show');
              }
            })
        })
    </script>
@endpush