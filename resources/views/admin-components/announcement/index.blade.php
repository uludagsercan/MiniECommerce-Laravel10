@extends('layouts.admin-layout')
@section("title","Announcement")

@section("content")
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Announcements</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <td><a href="{{route("admin.announcement.create")}}" class="btn btn-outline-primary">Create Announcement</a></td>
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
                                    <th>Announcement Title</th>
                                    <th>Announcement Description</th>
                                    <th>Product Name</th>
                                    <th>Product Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($announcements as $announcement)
                                    <tr>
                                        <td>{{$announcement->id }}</td>
                                        <td>{{$announcement->announcement_title }}</td>
                                        <td>{{ $announcement->announcement_description}}</td>
                                        <td>{{ $announcement->product->name}}</td>
                                        <td>{{ $announcement->product->description}}</td>
                                        <td><a href="{{route('admin.announcement.edit',["id"=>$announcement->id])}}" class="btn btn-outline-info">Update Announcement</a></td>
                                        <td><a href="{{route('admin.announcement.destroy',["id"=>$announcement->id])}}" type="button" class="btn btn-outline-secondary">Delete Announcement</a></td>


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
