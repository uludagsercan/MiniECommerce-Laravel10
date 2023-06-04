
@extends('layouts.admin-layout')
@section("title","Roles")

@section("content")
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Roles</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <td><a href="{{route("admin.role.create")}}" class="btn btn-outline-primary">Create Role</a></td>
                                        </div>
    
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group" style="width: 300px;">
                                            <input type="text" name="table_search" class="form-control " placeholder="Search">
        
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
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
                                    <th>Role Name</th>
                                


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name}}</td>
                                        <td><a href="{{route("admin.role.edit",["id"=>$role->id])}}" class="btn btn-outline-info">Update Role</a></td>
                                        <td><a href="{{route("admin.role.destroy",["id"=>$role->id])}}" class="btn btn-outline-secondary">Delete Role</a></td>
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
