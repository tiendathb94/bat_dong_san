@extends('default.layouts.personal')
@section('main_content')
    <div class="container main">
        <div>
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

        </div>
        <form action="{{ route('news.update', $news->slug) }}" method="POST" class="row" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name="title" value="{{  old('title', $news->title) }}" class="form-control" id="title" placeholder="Tiêu đề">
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="thumbnail" style="">Ảnh thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" id="imgInp"  accept="image/png, image/jpeg, image/jpg, image/gif">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Danh mục</label>
                            <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                                <option>--Chọn--</option>
                                @foreach( $categories as $category )
                                    <option @if( old('category_id', $news->category_id) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group p_loader">
                            <label for="project_id">Dự án liên quan</label>
                            <div id="js-get-project-id"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <img style="width: 200px; margin-top: 10px" src="{{ $pathImageThumbnail . $news->thumbnail }}"  alt="" id="blah">
                    </div>
                </div>

                <div class="form-group">
                    <label for="meta_content" style="display: block">Mô tả ngắn</label>
                    <textarea name="meta_content" id="meta_content" style="width: 100%;" class="form-control" maxlength=255 rows="5">{{ old('meta_content', $news->meta_content) }}</textarea>
                    <div class="form-text small text-muted">Tối đa 255 ký tự!</div>

                </div>

                <div class="form-group">
                    <label for="content" >Nội dung bài viêt</label>
                    <div id="editor-content"></div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <button class="btn btn-success" type="submit" style="width: 100%; font-size: 16px;height: 34px;">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link
        rel="stylesheet"
        href="{{ asset('css/pages/project/form.css') . '?m=' . filemtime('css/pages/project/form.css') }}">
    @include('default.pages.news.style')
@endpush
@push('scripts')
    <script>
        window.requestOld = @json(count(old()) ? old() : $news);
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
    </script>
    <script src="{{ asset('js/pages/news/editor.js') . '?m=' . filemtime('js/pages/news/editor.js') }}"></script>
    <script src="{{ asset('js/pages/news/project.js') . '?m=' . filemtime('js/pages/news/project.js') }}"></script>
@endpush
