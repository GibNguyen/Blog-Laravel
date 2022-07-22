@extends('layouts.admin')

@section('title', 'User List')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif
    <p><a href="{{ route('admin.user.add') }}" class="btn btn-primary ">Add</a></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">Index</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if ($userList->count() > 0)
                @foreach ($userList as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td width="5%"><a href="{{ route('admin.user.edit', $user->id) }}"
                                class="btn btn-warning ">Edit</a></td>
                        @if (Auth::user()->id !== $user->id)
                            <td width="5%"><a onclick="return confirm('Are you sure you want to delete this user?')"
                                    href="{{ route('admin.user.delete',$user->id) }}" class="btn btn-danger ">Delete</a></td>
                        @endif
                    </tr>
                @endforeach

            @endif

        </tbody>
    </table>
    <div class='d-flex justify-content-center'>
        {!! $userList->links() !!}
    </div>
@endsection
