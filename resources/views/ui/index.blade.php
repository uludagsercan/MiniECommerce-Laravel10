@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">



            <div class="col-md-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
    
                        @foreach ($announcements as $announcement)
                            @if ($announcement['id'] == $announcements[0]->id)
                                <div class="carousel-item active">
                                    <a href="{{ route('home.detail', ['id' => $announcement->product->id]) }}">
                                        <img class="d-block w-100" height="750"
                                            src="{{ asset('/storage/images/products/' . $announcements[0]->product->picture) }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5 style="color:black">{{ $announcement->announcement_title }}</h5>
                                            <p style="color:black">{{ $announcement->announcement_description }}</p>
                                        </div>
                                    </a>
                                </div>
                            @else
                            <div class="carousel-item">
                                <a href="{{ route('home.detail', ['id' => $announcement->product->id]) }}">
                                    <img class="d-block w-100" height="750"
                                        src="{{ asset('/storage/images/products/' . $announcement->product->picture) }}"
                                        alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 style="color:black">{{ $announcement->announcement_title }}</h5>
                                        <p style="color:black"> {{ $announcement->announcement_description }}</p>
                                    </div>
                                </a>
    
                            </div>
                            @endif
                        @endforeach
    
    
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        

            @foreach ($products as $product)
                <div class="col-md-3 mt-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header" style="background: cornsilk">
                            {{ $product->category->name }}
                        </div>
                        <img class="card-img-top" height="150" src="{{ asset('/storage/images/products/' . $product->picture) }}"
                            alt="Product">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="{{ route('home.detail', ['id' => $product->id]) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
@endsection
