@extends('layouts.admin-layout')
@section("title","Update Product")
@section("content")
    <form method="post" action="{{route('admin.product.update')}}" >
        @csrf
        <input id="cName" type="text" class="form-control" value="{{$product->id}}"  style="visibility: hidden"  name="id">

        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Product</h3>
                </div>
                <div class="card-body">




                    <div class="form-group mb-3">
                        <label for="cName" >Category Name</label>
                        <select class="form-control" name="category_id">
                            <option value="">Category Name</option>
                            @foreach($categories as $category_item)
                                @if($category_item->id ===$product->category_id)
                                <option value="{{$category_item->id}}" selected>{{$category_item->name}}</option>
                                @else
                                    <option value="{{$category_item->id}}">{{$category_item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName" >Product Name</label>
                        <input id="cName" type="text" class="form-control" value="{{$product->name}}"   name="name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName" >Product Description</label>
                        <input id="cName" type="text" class="form-control" value="{{$product->description}}"  name="description">
                    </div>

                    <div class="form-group mb-3">
                        <label for="cPrice" >Price</label>
                        <input id="cPrice" type="text" class="form-control"  value="{{$product->price}}" name="price">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cStock" >Stock</label>
                        <input id="cStock" type="text" class="form-control" value="{{$product->stock}}" name="stock">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cPicture" >Picture</label>
                        <input id="cPicture" type="text" class="form-control" value="{{$product->picture}}" name="picture">
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



