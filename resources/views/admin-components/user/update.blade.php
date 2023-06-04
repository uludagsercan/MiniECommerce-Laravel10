@extends('layouts.admin-layout')
@section('title', 'Create User')
@section('content')
    <form method="post" action="{{ route('admin.user.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update User</h3>
                </div>
                <div class="card-body">
                    <input id="cName" type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                    <div class="form-group mb-3">
                        <label for="cName">Role</label>
                        <select class="form-control" name="category_id">
                            <option value="">Role</option>
                            @foreach ($roles as $role)
                                @if ($user->role)
                                    @if ($role->name == $user->role->name)
                                        <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                    @else
                                    <option value="{{ $role->id }}" >{{ $role->name }}</option>

                                    @endif
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cName">User Name</label>
                        <input id="cName" type="text" class="form-control" name="name"
                            value="{{ $user->name }}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName">Email</label>
                        <input id="cName" type="text" class="form-control" name="email"
                            value="{{ $user->email }}">
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

       


                    <div class="input-group mb-3">

                        <button type="submit" class="btn btn-secondary">Update</button>
                    </div>

                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </form>

@endsection
