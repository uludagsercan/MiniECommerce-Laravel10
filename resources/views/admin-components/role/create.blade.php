@extends('layouts.admin-layout')
@section('title', 'Create Role')
@section('content')
    <form method="post" action="{{ route('admin.role.store') }}">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Role</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="cName">Role Name</label>
                        <input id="cName" type="text" class="form-control" name="name">
                        @error('name')
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
