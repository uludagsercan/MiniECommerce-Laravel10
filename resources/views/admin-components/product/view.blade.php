@extends('layouts.admin-layout')
@section('title', 'Update Announcement')
@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $product->category->name }}</h3>
                        <div class="col-12">
                            <img src="{{ asset('/storage/images/products/' . $product->picture) }}" alt="product"
                                alt="Product Image">

                        </div>

                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>

                        <hr>

                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                ${{ $product->price }}
                            </h2>
                            <h4 class="mt-0">
                                <small>Stock: {{ $product->stock }} </small>
                            </h4>
                        </div>

                        <div class="mt-4">

                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-outline-info">
                                Update Product
                            </a>

                        </div>

                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                      <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                        <a class="nav-item nav-link" id="product-Stock-tab" data-toggle="tab" href="#product-Stock" role="tab" aria-controls="product-Stock" aria-selected="false">Stock</a>
                       
                      </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">{{$product->description}}</div>
                      <div class="tab-pane fade" id="product-Stock" role="tabpanel" aria-labelledby="product-Stock-tab"> {{$product->stock}}</div>
                    </div>
                  </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
