<table class="table table-bordered fs-12 text-center">
    <thead>
        <tr class="bg-thead">
            <th>Tiêu đề</th>
            <th>Hình ảnh</th>
            <th>Địa chỉ</th>
            <th>Diện tích (m2)</th>
            <th>Giá</th>
            <th>Đơn vị</th>
            <th>Hiển thị</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>
                    @if($post->imageLibraries->count())
                        <img src="{{ asset('storage' . $post->imageLibraries->first()->file_path) }}" style="width: 100px;" alt="">
                    @endif
                </td>
                <td>
                    @php($address = $post->address)
                    @if($address)
                        {{ $address->address }}, {{ $address->ward->name }}, {{ $address->district->name }}, {{ $address->ward->name }}
                    @endif
                </td>
                <td>{{ $post->total_area }}</td>
                <td>{{ $post->price }}</td>
                <td>{{ $post->price_unit_name }}</td>
                <td>
                    <div class="custom-control custom-switch">
                        <input data-url="{{ route('posts.change_status', $post->id) }}" type="checkbox" {{ $post->status ? 'checked' : '' }} class="custom-control-input js-change-status" id="switch{{ $post->id }}">
                        <label class="custom-control-label" for="switch{{ $post->id }}"></label>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $posts->appends(request()->all())->links() }}
</div>
@if(!$posts->count())
  <p class="fs-12 text-center">Bạn chưa đăng tin rao bán/cho thuê nào.</p>
@endif
