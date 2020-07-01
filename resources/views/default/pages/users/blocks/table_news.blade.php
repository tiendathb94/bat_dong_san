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
                <td><p class="text-white {{ $bgColor }} px-2 py-1 rounded">{{ $newsChild->status_name }}</p></td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a title="" href="{{ route('news.edit', $newsChild->slug) }}" class="mr-3">Sửa</a>|
                        <span id="btnDelete" data-action="{{ route('news.destroy', $newsChild->id) }}" title="" class="ml-3 text-danger cursor-pointer">Xóa</span>
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
    <p class="fs-12 text-center">Bạn chưa đăng bài tin tức nào.</p>
  @endif
@endif
<div class="float-right fs-12">{{ $news->appends(request()->all())->links() }}</div>
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
