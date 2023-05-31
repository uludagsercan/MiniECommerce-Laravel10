@extends('layouts.admin-layout')
@section("title","Update Category")

@section("content")
    <form method="post" action="{{route('admin.category.update')}}" >
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Category</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="cName" >Category Name</label>
                        <input id="cName" type="text" class="form-control" style="visibility: hidden" value="{{$category->id}}" name="id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName" >Category Name</label>
                        <input id="cName" type="text" class="form-control" value="{{$category->name}}" name="name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" >Category Description</label>
                        <input id="description" type="text" class="form-control" value="{{$category->description}}" name="description">
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


