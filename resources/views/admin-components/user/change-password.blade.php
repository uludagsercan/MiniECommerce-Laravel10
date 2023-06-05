@extends('layouts.admin-layout')
@section('title', 'Create User')
@section('content')
    <form method="post" action="{{ route('admin.user.changePassword') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">User</h3>
                </div>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="cPrice">Password</label>
                        <input id="cPrice" type="password" class="form-control" name="password" required>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="input-group mb-3">

                        <button type="submit" class="btn btn-secondary">Create</button>
                    </div>

                    <!-- /input-group -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </form>

@endsection
