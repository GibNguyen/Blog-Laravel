@extends('layouts.admin')

@section('title', 'Post Detail')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Post Detail</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<hr>

<form class="content" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="inputEmail3" class="col-3
        col-form-label">Title</label>
        <div class="col-9">
            <input type="text" class="form-control" id="inputEmail3" name="title" value="{{ $post->title }} "
                disabled>
        </div>
    </div>
    <hr>

    <div class="row mb-3">
        <label for="inputEmail3" class="col-3
        col-form-label">Author</label>
        <div class="col-9">
            <input type="text" class="form-control" id="inputEmail3" name="title" value="{{ $post->author }} "
                disabled>
        </div>
    </div>
    <hr>


    <div class="row mb-3">
        <label for="imgInp" class="col-3
        col-form-label">Image</label>
        <div class="col-9">
            <td><img src="{{ asset('upload/image/' . $post->image) }}" class="card-img-top" alt="...">
        </div>
    </div>

    <hr>


    <div class="row mb-3">
        <label for="editor" class="col-3
        col-form-label">Content</label>
        <div class="col-9">
            <span disable>{!! $post->content !!}</span>
        </div>
    </div>
    <hr>


    <div class="row mb-3">
        <label for="inputEmail3" class="col-3   
        col-form-label">Category</label>
        <div class="col-9">
            <td class="text-uppercase">
                @foreach ($post->category->all() as $item)
                    {{ $item->name }}
                    <br />
                @endforeach
            </td>
        </div>
    </div>
</form>
@endsection
