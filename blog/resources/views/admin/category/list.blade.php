@extends('layouts.admin')

@section('title', 'Category List')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif
    <p><a href="{{ route('admin.category.add') }}" class="btn btn-primary ">Add</a></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">Index</th>
                <th>Name</th>
                <th>Posts Count</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if ($categoryList->count() > 0)
                @foreach ($categoryList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="text-uppercase">{{ $item->name }}</td>
                        <td>{{ $item->posts->count() }}</td>
                        <td width="5%"><a href="{{ route('admin.category.edit', $item->id) }}"
                                class="btn btn-warning ">Edit</a></td>
                        <td width="5%"><a onclick="return confirm('Are you sure you want to delete this Category?')"
                                href="{{ route('admin.category.delete', $item->id) }}" class="btn btn-danger ">Delete</a></td>
                    </tr>
                @endforeach

            @endif

        </tbody>
    </table>
    <div class='d-flex justify-content-center'>
        {!! $categoryList->links() !!}
    </div>
@endsection
