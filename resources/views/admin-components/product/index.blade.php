


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
                            <h3 class="card-title">Products</h3>

                            <div class="card-tools">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <td><a href="{{route("admin.product.create")}}" class="btn btn-outline-primary">Create Product</a></td>
                                        </div>
    
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group" style="width: 300px;">
                                            <form method="post" action="{{ route('admin.product.search') }}">
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
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Description</th>
                                    <th>Product Price</th>
                                    <th>Product Stock</th>
                                    <th>View</th>
                                    <th>Update</th>
                                    <th>Delete</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><img src="{{asset('/storage/images/products/'.$product->picture)}}" alt="product" style="width: 100px;" ></td>
                                        <td>{{ $product->category->name}}</td>
                                        <td>{{$product->name }}</td>
                                        <td>{{ $product->description}}</td>
                                        <td>{{ $product->price}}$</td>
                                        <td>{{ $product->stock}}</td>
                                        <td><a href="{{route("admin.product.show",["id"=>$product->id])}}" class="btn btn-outline-info">View Product</a></td>
                                        <td><a href="{{route("admin.product.edit",["id"=>$product->id])}}" class="btn btn-outline-info">Update Product</a></td>
                                        <td><a href="{{route("admin.product.destroy",["id"=>$product->id])}}" class="btn btn-outline-secondary">Delete Product</a></td>
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
