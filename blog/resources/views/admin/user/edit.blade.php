@extends('layouts.admin')

@section('title', 'Edit user')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
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
                col-form-label">Email</label>
            <div class="col-9">
                <input type="text" class="form-control" id="inputEmail3" name="email" value="{{old('email') ?? $user->email }}" placeholder="Email">
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-3
                col-form-label">Your name</label>
            <div class="col-9">
                <input type="text" class="form-control" id="inputEmail3" name="name" value="{{old('name') ?? $user->name }}" placeholder="Name">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputRole3" class="col-3
                col-form-label">Role</label>
            <div class="col-9">
                <select name="role_id" id="inputRole3">
                    <option value="0">Choose Role</option>
                    @if ($roleList->count() > 0)
                        @foreach ($roleList as $item)
                            <option value="{{ $item->id }}" {{ $user->role_id == $item->id?'selected':false }}>{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('role_id')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
    </form>

@endsection
