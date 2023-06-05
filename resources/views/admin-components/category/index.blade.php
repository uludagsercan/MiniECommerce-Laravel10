@extends('layouts.admin-layout')
@section("title","Categories")

@section("content")
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categories</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <td><a href="{{route("admin.category.create")}}" class="btn btn-outline-primary">Create Category</a></td>
                                        </div>
    
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group" style="width: 300px;">
                                            <form method="post" action="{{ route('admin.category.search') }}">
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
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th>Update</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{$category->name }}</td>
                                        <td>{{ $category->description}}</td>
                                        <td><a href="{{route('admin.category.edit',["id"=>$category->id])}}" class="btn btn-outline-info">Update Category</a></td>
                                        <td><a href="{{route('admin.category.destroy',["id"=>$category->id])}}" type="button" class="btn btn-outline-secondary">Delete Category</a></td>


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
