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
        <form action="{{ route('news.store') }}" method="POST" class="row" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Tiêu đề">
                </div>

                <div class="form-group">
                    <label for="meta_content" style="display: block">Mô tả ngắn</label>
                    <textarea name="meta_content" id="meta_content" style="width: 100%;" class="" rows="5">{{ old('meta_content') }}</textarea>
                    <em> - Tối đa 255 ký tự!</em>

                </div>

                <div class="form-group">
                    <label for="content" >Nội dung bài viêt</label>
                    <div id="editor-content"></div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="thumbnail" style="">Ảnh đại diện</label>
                        <input type="file" name="thumbnail" class="form-control" id="imgInp"  accept="image/png, image/jpeg, image/jpg, image/gif">
    
                        <img style="width: 200px; margin-top: 10px"  alt="" id="blah">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleFormControlSelect1">Danh mục</label>
                        <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                            <option>--Chọn--</option>
                            @if( isset($categories) )
                            @foreach( $categories as $category )
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group p_loader col-sm-6">
                        <label for="project_id">Dự án</label>
                        <input type="hidden" name="project_id" value="">
                        <input id="project" type="text" class="form-control" placeholder="Tên dự án">
                        <div class="loader"></div>
                        <em class="nothing">Không tìm thấy dự án</em>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <button class="btn btn-success" type="submit" onclick="onSubmit()" style="width: 100%; font-size: 16px;height: 34px;">Đăng bài</button>
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
    <script src="{{ asset('js/pages/news/editor.js') . '?m=' . filemtime('js/pages/news/editor.js') }}"></script>
    <script>
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
<script>
    var dataCate = [];
    var dataPro = [];
    $( function() {
        var availableTags = [];
        var debounce = null;
        $('#project').on('keyup', function(e){
                clearTimeout(debounce );
                $('.loader').css('display', 'block');
                debounce = setTimeout(function(){
                    $.ajax({
                        url:'{{ asset('') }}' + 'api/project/search',
                        method:"GET", 
                        data:{search:e.target.value},
                        success:function(data){ 
                            dataPro = data;
                            availableTags = [];
                            for( let i = 0; i < data.length; i++ ) {
                                availableTags.push(data[i].long_name)
                            }
                            if( data.length < 1 ) {
                                $('.nothing').css('display', 'block');
                            } else {
                                $('.nothing').css('display', 'none');
                            }
                            $('.loader').css('display', 'none');
                        }
                    }).then( function() { 
                        $( "#project" ).autocomplete({
                            source: availableTags
                        });
                    })
                }, 300);
            }); 
    } );

function onSubmit(){
    event.preventDefault();
    for( let i = 0; i < dataPro.length; i++ ) {
        if( dataPro[i].long_name == $('#project').val() ) {
            $( "input[name='project_id']" ).val(dataPro[i].id)
        }
    }

    for( let i = 0; i < dataCate.length; i++ ) {
        if( dataCate[i].title == $('#project').val() ) {
            $( "input[name='project_id']" ).val(dataCate[i].id)
        }
    }
    $('form').submit();
}

</script>
@endpush
