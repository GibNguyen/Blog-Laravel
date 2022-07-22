@extends('layouts.admin')

@section('title', 'Add new user')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Post</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            Please check your input data
        </div>
    @endif
    <form class="content" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label for="inputEmail3" class="col-3
                col-form-label">Title</label>
            <div class="col-9">
                <input type="text" class="form-control" id="inputEmail3" name="title" value="{{ old('email') }}">
                @error('title')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="imgInp" class="col-3
                col-form-label">Image</label>
            <div class="col-9">
                <input type="file" id="imgInp" name="image" accept="image/*" onchange="previewFile(this);">
                <div class="col-md-12 mb-2">
                    <img class="img-thumbnail" id="previewImg" src="{{ asset('upload/image/img-upload.jpg') }} "
                        alt="your image" />
                </div>
                @error('image')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="editor" class="col-3
                col-form-label">Content</label>
            <div class="col-9">
                <textarea class="form-control ckeditor" id="editor" name="content" cols="80" rows="10"></textarea>
                @error('content')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="inputEmail3" class="col-3   
                col-form-label">Category</label>
            <div class="col-9">
                @foreach ($categoryList as $item)
                    <div class="form-check text-uppercase">
                        <input type="checkbox" name="category[]" id={{ $item->id }} value={{ $item->id }}>
                        <label for="{{ $item->id }}">{{ $item->name }}</label>
                    </div>
                @endforeach
                @error('category')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>



        <button type="submit" class="btn btn-success">Add</button>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        CKEDITOR.editorConfig = function(config) {
            // Define changes to default configuration here. For example:
            // config.language = 'fr';
            // config.uiColor = '#AADC6E';
            config.height = '100px';
        };
    </script>

    <script type="text/javascript">
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection
