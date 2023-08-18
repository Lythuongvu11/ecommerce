@extends('client.layouts.app')
@section('title', 'Search Results')
@section('content')

    <h1>Kết quả tìm kiếm cho "{{ $query }}"</h1>
    <div id="grid">
        @foreach($products as $item)
            <a href="#" class="product">
                <div class="info-large">
                    <h4>{{$item->name}}</h4>
                    {{--                            <div class="sku">--}}
                    {{--                                PRODUCT SKU: <strong>89356</strong>--}}
                    {{--                            </div>--}}

                    <div class="price-big">
                        <span>${{$item->old_price}}</span> {{$item->price}}
                    </div>

                    <h3>COLORS</h3>
                    <div class="colors">
                        <ul>
                            @foreach(explode(',', $item->color) as $color)
                                <div class="c-{{ $color }}"><span></span></div>
                            @endforeach
                        </ul>
                    </div>

                    <h3>SIZE</h3>
                    <div class="sizes-large">
                        {{$item->size}}
                    </div>

                    <button class="add-cart-large">Add To Cart</button>

                </div>
                <div class="make3D">
                    <div class="product-front">
                        <div class="shadow"></div>
                        <img src="{{$item->image}}" alt="" />
                        <div class="image_overlay"></div>
                        <div class="add_to_cart">Add to cart</div>
                        <div class="view_gallery">View gallery</div>
                        <div class="stats">
                            <div class="stats-container">
                                <span class="product_price">${{$item->price}}</span>
                                <span class="product_name">{{$item->name}}</span>
                                <p>{{$item->description}}</p>

                                <div class="product-options">
                                    <strong>SIZES</strong>
                                    <span>{{$item->size}}</span>
                                    <strong>COLORS</strong>
                                    <div class="colors">
                                        @foreach(explode(',', $item->color) as $color)
                                            <div class="c-{{ $color }}"><span></span></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-back">
                        <div class="shadow"></div>
                        <div class="carousel">
                            <ul class="carousel-container">
                                <li><img src="{{$item->image}}" alt="" /></li>
                                <li><img src="{{$item->image}}" alt="" /></li>
                                <li><img src="{{$item->image}}" alt="" /></li>
                            </ul>
                            <div class="arrows-perspective">
                                <div class="carouselPrev">
                                    <div class="y"></div>
                                    <div class="x"></div>
                                </div>
                                <div class="carouselNext">
                                    <div class="y"></div>
                                    <div class="x"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flip-back">
                            <div class="cy"></div>
                            <div class="cx"></div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{ $products->links() }}

@endsection
