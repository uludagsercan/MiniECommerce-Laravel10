@extends('layouts.admin-layout')
@section('title', 'Create Product')
@section('content')
    <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Product</h3>
                </div>
                <div class="card-body">



                    <div class="form-group mb-3">
                        <label for="cName">Category Name</label>
                        <select class="form-control" name="category_id">
                            <option value="">Category Name</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cName">Product Name</label>
                        <input id="cName" type="text" class="form-control" name="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="cName">Product Description</label>
                        <input id="cName" type="text" class="form-control" name="description">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cPrice">Price</label>
                        <input id="cPrice" type="text" class="form-control" name="price">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="cStock">Stock</label>
                        <input id="cStock" type="text" class="form-control" name="stock">
                        @error('stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="cPicture">Picture</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cPicture" name="picture">
                                <label class="custom-file-label" for="cPicture">Choose file</label>
                            </div>

                        </div>
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
