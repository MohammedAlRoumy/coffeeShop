@extends('frontend.index')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>تفاصيل المنتج</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!-- section start -->
    <section>
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-slick">
                            @if ($product->images->count() > 0)
                                @foreach($product->images as $image)
                                    <div>
                                        <img src="{{asset('uploads/products/'.$image->image)}}" alt=""
                                             class="img-fluid blur-up lazyload image_zoom_cls-1">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slider-nav">
                                    @if ($product->images->count() > 0)
                                        @foreach($product->images as $image)
                                            <div>
                                                <img src="{{asset('uploads/products/'.$image->image)}}" alt=""
                                                     class="img-fluid blur-up lazyload">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart" enctype="multipart/form-data">
                            @csrf
                            <div class="product-right">
                                <h2>{{$product->name}}</h2>
                                <h4>
                                    @if($product->sale_price != null)
                                        <del>{{$product->price}}</del>
                                        <span>{{ config('settings.currency_code') }}</span>
                                    @endif
                                </h4>
                                <h3>
                                    @if($product->sale_price != null)
                                        {{$product->sale_price}} <span>{{ config('settings.currency_code') }}</span>
                                    @else
                                        {{$product->price}} <span>{{ config('settings.currency_code') }}</span>
                                    @endif
                                </h3>
                                <div class="product-description border-product">

                                    <h6 class="product-title">الكمية</h6>
                                    <div class="qty-box">
                                        <div class="input-group">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn quantity-left-minus" data-type="minus"
                                                    data-field="">
                                                <i class="ti-angle-left"></i>
                                            </button>
                                        </span>
                                            <input type="text" name="quantity" class="form-control input-number"
                                                   value="1"
                                                   min="1">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus" data-type="plus"
                                                    data-field="">
                                                    <i class="ti-angle-right"></i>
                                                </button>
                                            </span>
                                            <input type="hidden" name="productId" value="{{ $product->id }}">
                                            <input type="hidden" name="image" value="{{ $product->images->first()->image }}">
                                            <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="product-buttons">
                                    <button type="submit" data-toggle="modal" data-target="#addtocart"
                                            class="btn btn-solid">إضافة للسلة
                                    </button>
                                    {{--                                <a href="#" class="btn btn-solid">buy now</a>--}}
                                </div>
                                <div class="border-product">
                                    <h6 class="product-title">تفاصيل المنتج</h6>
                                    <p>{{$product->description}}</p>
                                </div>
                                <div class="border-product">
                                    <div class="product-icon">
                                        <form class="d-inline-block">
                                            <button class="wishlist-btn"><i class="fa fa-heart"></i>
                                                <span class="title-font">إضافة للمفضلة</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- product section start -->
    <section class="section-b-space j-box pets-box ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>منتجات مشابهه</h2>
                </div>
            </div>
            <div class="row search-product">
                @foreach($related_products as $related_product)
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="product-box">
                        <div class="img-wrapper">
                            <div class="front">
                                <a href="{{ route('product.show', $related_product->id) }}"><img
                                        src="{{asset('uploads/products/'.$related_product->images->first()->image)}}"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                            </div>
                            <div class="cart-info cart-wrap">
                                <button class="product__add-cart" title="إضافة للسلة">
                                    <i class="ti-shopping-cart product__add-cart product-{{$related_product->id}}"
                                       data-product-id="{{$related_product->id}}"
                                       data-product-name="{{$related_product->name}}"
                                       data-product-price="{{ $related_product->sale_price != '' ? $related_product->sale_price : $related_product->price }}"
                                       data-product-quantity="1"
                                       data-url="{{ route('product.add.cart')}}"
                                    ></i>
                                </button>
                                @auth()
                                    <a class="button product__fav-icon" title="إضافة للمفضلة">
                                        <i class="fa {{$related_product->is_favored ? 'fa-heart':'fa-heart-o'}} product__fav-icon product-{{$related_product->id}}"
                                           data-product-id="{{$related_product->id}}"
                                           data-url="{{route('product.toggle_favorite',$related_product->id)}}"
                                           aria-hidden="true"></i>
                                    </a>
                                @else
                                    <a href="{{route('login')}}" title="إضافة للمفضلة"><i class="ti-heart"
                                                                                          aria-hidden="true"></i></a>
                                @endauth
                            </div>
                        </div>
                        <div class="product-detail">
                            <a href="{{ route('product.show', $related_product->id) }}">
                                <h6>{{$related_product->name}}</h6>
                            </a>
                            <h4>
                                @if($related_product->sale_price != null)
                                    {{$related_product->sale_price}} {{\Config::get('currency_code')}}
                                @else
                                    {{$related_product->price}} {{\Config::get('currency_code')}}
                                @endif
                                @if($related_product->sale_price != null)
                                    <del>{{$related_product->price}} {{\Config::get('currency_code')}}</del>
                                @endif
                            </h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- product section end -->

@endsection
