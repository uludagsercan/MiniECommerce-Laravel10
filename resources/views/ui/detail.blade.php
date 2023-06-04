@extends('layouts.app')
@section("link")
    <link rel="stylesheet" href="/assets/ui/detail.css">
@endsection
@section('content')

<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    
                    <div class="preview-pic tab-content">
                      <div class="tab-pane active" id="pic-1"><img  src="{{asset('/storage/images/products/'.$product->picture)}}" /></div>
             
                    </div>
             
                    
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{$product->category->name}} - {{$product->name}}</h3>
               
                    <p class="product-description">{{$product->description}}</p>
                    <h4 class="price">current price: <span>${{$product->price}}</span></h4>
                    <h4 class="price">current stock: <span>{{$product->stock}}</span></h4>
               
                    <div class="action">
                        <a href="{{route('admin.mailbox.create')}}" class="add-to-cart btn btn-secondary" type="button">Send Message</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection