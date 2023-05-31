@extends('layouts.admin-layout')
@section("title","Create Announcement")
@section("content")
    <form method="post" action="{{route('admin.announcement.store')}}">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Announcement</h3>
                </div>
                <div class="card-body">

                  
                    <div class="form-group mb-3">
                        <label for="cName" >Product Name</label>
                        <select class="form-control" name="product_id">
                            <option value="">Product Name</option>
                            @foreach($products as $product) <option value="{{$product->id}}">{{$product->name}}</option>@endforeach
                        </select>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="cName" >Announcement Title</label>
                        <input id="cName" type="text" class="form-control"   name="announcement_title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName" >Announcement Description</label>
                        <input id="cName" type="text" class="form-control"  name="announcement_description">
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



