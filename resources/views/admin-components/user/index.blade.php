@extends('layouts.admin-layout')
@section('title', 'Users')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <td><a href="{{ route('admin.user.create') }}"
                                                    class="btn btn-outline-primary">Create User</a></td>
                                        </div>

                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group" style="width: 300px;">
                                            <form method="post" action="{{ route('admin.user.search') }}">
                                                @csrf

                                                <input type="text" name="search" class="form-control "
                                                    placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                        </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Email</th>

                                        <th>View</th>
                                        <th>Update</th>
                                        <th>Delete</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>

                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td><a href="{{ route('admin.user.show', ['id' => $user->id]) }}"
                                                    class="btn btn-outline-primary">View User</a></td>

                                            <td><a href="{{ route('admin.user.edit', ['id' => $user->id]) }}"
                                                    class="btn btn-outline-info">Update User</a></td>
                                            <td><a href="{{ route('admin.user.destroy', ['id' => $user->id]) }}"
                                                    class="btn btn-outline-secondary">Delete User</a></td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
