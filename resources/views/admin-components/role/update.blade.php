@extends('layouts.admin-layout')
@section('title', 'Update Role')
@section('content')
    <form method="post" action="{{ route('admin.role.update') }}">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Role</h3>
                </div>
                <div class="card-body">
                    <input id="cName" type="hidden" class="form-control" value="{{ $role->id }}" name="id">

                    <div class="form-group mb-3">
                        <label for="cName">Role Name</label>
                        <input id="cName" type="text" class="form-control" value="{{ $role->name }}"
                            name="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-secondary">Create</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
