@extends('layouts.admin')

@section('title', 'Edit Category')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-center">
            Please check your input data
        </div>
    @endif
    <form class="content" method="POST">
        @csrf
        <div class="row mb-3">
            <label for="inputEmail3" class="col-3
                col-form-label">Category Name</label>
            <div class="col-9">
                <input type="text" class="form-control" id="inputEmail3" name="name" value="{{old('name') ?? $category->name }}" placeholder="Name">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
    </form>

@endsection
