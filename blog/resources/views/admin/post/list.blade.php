@extends('layouts.admin')

@section('title', 'Post List')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Post List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif
    <p><a href="{{ route('admin.post.add') }}" class="btn btn-primary ">Add</a></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">Index</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Image</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if ($postList->count() > 0)
                @foreach ($postList as $key => $post)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author }}</td>
                        <td class="text-uppercase">
                            @foreach ($post->category->all() as $item)
                                {{ $item->name }}
                                <br/>
                            @endforeach
                        </td>
                        <td><img width="30px" height="150px" src="{{ asset('upload/image/' . $post->image) }}" class="card-img-top" alt="...">

                        </td>
                        <td width="5%"><a href="{{ route('admin.post.detail', $post->id) }}"
                                class="btn btn-info ">View</a></td>
                        <td width="5%"><a href="{{ route('admin.post.edit', $post->id) }}"
                                class="btn btn-warning ">Edit</a></td>
                        <td width="5%"><a onclick="return confirm('Are you sure you want to delete this user?')"
                                href="{{ route('admin.post.delete', $post->id) }}" class="btn btn-danger ">Delete</a></td>
                    </tr>
                @endforeach

            @endif

        </tbody>
    </table>
    <div class='d-flex justify-content-center'>
        {!! $postList->links() !!}
    </div>
@endsection
