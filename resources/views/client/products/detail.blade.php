@extends('client.layouts.app')
@section('title','Product Detail')
@section('content')
    <!-- Page Header End -->
    @if (session('message'))
        <h2 class="" style="text-align: center; width:100%; color:red"> {{ session('message') }}</h2>
    @endif

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <form action="{{route('client.carts.add')}}" method="POST" class="row px-xl-5">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100"
                                 src="{{$product->image}}"
                                 alt="Image">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                <div class="d-flex mb-3">

                </div>
                <h3 class="font-weight-semi-bold mb-4">
                    <span style="text-decoration: line-through; color: #d0d0d0;font-weight: 400;">${{$product->old_price}}</span> {{$product->price}}
                </h3>

                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Size:</p>
                        @foreach(explode(',', $product->size) as $size)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="product_size" value="{{ $size}}" id="size{{$size}}">
                                <label class="form-check-label" for="size{{$size}}">{{$size}}</label>
                            </div>
                        @endforeach
                </div>

                <div class="d-flex mb-4">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Color:</p>
                    @foreach(explode(',', $product->color) as $color)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="option">
                            <label class="form-check-label" style="color: {{$color}}" for="inlineRadio1">{{$color}}</label>
                        </div>
                    @endforeach

                </div>


                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button  class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input id="quantityInput" type="text" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button  class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
