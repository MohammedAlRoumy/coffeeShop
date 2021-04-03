@extends('frontend.index')
@section('content')

    <!-- Home slider -->
    <section class="p-0 small-slider">
        <div class="slide-1 home-slider">
            @foreach($sliders as $slider)
                <div>
                    <div class="home p-center text-center">
                        <img src="{{asset('uploads/sliders/'.$slider->image)}}" alt=""
                             class="bg-img blur-up lazyload">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="slider-contain ">
                                        <div>
                                            <h4 style="color: #ff9944;">{{$slider->stitle}}</h4>
                                            <h1 style="color: #ff9944;">{{$slider->ftitle}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- Home slider end -->

    <!-- collection banner -->
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <div class="title1 title5">
                    <a href="{{route('categories')}}"><h2 class="title-inner1">التصنيفات</h2></a>
                    <hr role="tournament6">
                </div>
            </div>
        </div>
    </div>

    <section class="banner-furniture p-t-0 ratio_45">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slide-3 no-arrow">
                        @foreach($categories as $category)
                            <div>
                                <a href="#">
                                    <div class="mr-3 collection-banner p-center text-center">
                                        <div class="img-part">
                                            <img src="{{asset('uploads/categories/'.$category->image)}}" alt=""
                                                 class="img-fluid blur-up lazyload bg-img">
                                        </div>
                                        <div class="contain-banner banner-3">
                                            <div>
                                                <h2>{{$category->name}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- collection banner end -->


    <!-- Product slider -->
    <section class="section-b-space j-box pets-box ratio_square">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title1 title5">

                        <h2 class="title-inner1">تخفيضات</h2>
                        <hr role="tournament6">
                    </div>
                    <div class="team-4 product-m no-arrow">

                        @foreach($products_low as $product_low)
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <a href="{{ route('product.show', $product_low->id) }}"><img
                                                src="{{asset('uploads/products/'.$product_low->images->first()->image)}}"
                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        <button class="product__add-cart" title="إضافة للسلة">
                                            <i class="ti-shopping-cart product__add-cart product-{{$product_low->id}}"
                                               data-product-id="{{$product_low->id}}"
                                               data-product-name="{{$product_low->name}}"
                                               data-product-price="{{ $product_low->sale_price != '' ? $product_low->sale_price : $product_low->price }}"
                                               data-product-quantity="1"
                                               data-url="{{ route('product.add.cart')}}"
                                            ></i>
                                        </button>
                                        @auth()
                                            <a class="button product__fav-icon" title="إضافة للمفضلة">
                                                <i class="fa {{$product_low->is_favored ? 'fa-heart':'fa-heart-o'}} product__fav-icon product-{{$product_low->id}}"
                                                   data-product-id="{{$product_low->id}}"
                                                   data-url="{{route('product.toggle_favorite',$product_low->id)}}"
                                                   aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="{{route('login')}}" title="إضافة للمفضلة"><i class="ti-heart"
                                                                                                  aria-hidden="true"></i></a>
                                        @endauth
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <a href="{{ route('product.show', $product_low->id) }}">
                                        <h6>{{$product_low->name}}</h6>
                                    </a>
                                    <h4>
                                        @if($product_low->sale_price != null)
                                            {{$product_low->sale_price}} {{ config('settings.currency_code') }}
                                        @else
                                            {{$product_low->price}} {{ config('settings.currency_code') }}
                                        @endif
                                        @if($product_low->sale_price != null)
                                            <del>{{$product_low->price}} {{ config('settings.currency_code') }}</del>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product slider end -->


    <!-- Product slider -->
    <section class="section-b-space j-box pets-box ratio_square">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title1 title5">
                        <h2 class="title-inner1">وصل حديثا</h2>
                        <hr role="tournament6">
                    </div>
                    <div class="team-4 product-m no-arrow">
                        @foreach($products_new as $product_new)
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="lable-block">
                                        <span class="lable3">جديد</span>
                                    </div>
                                    <div class="front">
                                        <a href="{{ route('product.show', $product_new->id) }}"><img
                                                src="{{asset('uploads/products/'.$product_new->images->first()->image)}}"
                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                    </div>
                                    <div class="cart-info cart-wrap">
                                        <button data-toggle="modal" data-target="#addtocart" title="Add to cart"><i
                                                class="ti-shopping-cart"></i></button>
                                        <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart"
                                                                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <a href="{{ route('product.show', $product_new->id) }}">
                                        <h6>{{$product_new->name}}</h6>
                                    </a>
                                    <h4>
                                        @if($product_new->sale_price != null)
                                            {{$product_new->sale_price}} {{ config('settings.currency_code') }}
                                        @else
                                            {{$product_new->price}} {{ config('settings.currency_code') }}
                                        @endif
                                        @if($product_new->sale_price != null)
                                            <del>{{$product_new->price}} {{ config('settings.currency_code') }}</del>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product slider end -->

    @foreach($categories as $category)
        @if($category->products->count() > 0 )
            <!-- Product slider -->
            <section class="section-b-space j-box pets-box ratio_square">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title1 title5">
                                <a href="{{route('products',['category_name' => $category->name])}}"><h2
                                        class="title-inner1">{{$category->name}}</h2></a>
                                <hr role="tournament6">
                            </div>
                            <div class="team-4 product-m no-arrow">
                                @foreach($category->products as $product)
                                    <div class="product-box">
                                        <div class="img-wrapper">
                                            <div class="front">
                                                <a href="{{ route('product.show', $product->id) }}"><img
                                                        src="{{asset('uploads/products/'.$product->images->first()->image)}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                            </div>
                                            <div class="cart-info cart-wrap">
                                                <button class="product__add-cart" title="إضافة للسلة">
                                                    <i class="ti-shopping-cart product__add-cart product-{{$product->id}}"
                                                       data-product-id="{{$product->id}}"
                                                       data-product-name="{{$product->name}}"
                                                       data-product-price="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}"
                                                       data-product-quantity="1"
                                                       data-url="{{ route('product.add.cart')}}"
                                                    ></i>
                                                </button>
                                                @auth()
                                                    <a class="button product__fav-icon" title="إضافة للمفضلة">
                                                        <i class="fa {{$product->is_favored ? 'fa-heart':'fa-heart-o'}} product__fav-icon product-{{$product->id}}"
                                                           data-product-id="{{$product->id}}"
                                                           data-url="{{route('product.toggle_favorite',$product->id)}}"
                                                           aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="{{route('login')}}" title="إضافة للمفضلة"><i
                                                            class="ti-heart"
                                                            aria-hidden="true"></i></a>
                                                @endauth
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            <a href="{{ route('product.show', $product->id) }}">
                                                <h6>{{$product->name}}</h6>
                                            </a>
                                            <h4>
                                                @if($product->sale_price != null)
                                                    {{$product->sale_price}} {{ config('settings.currency_code') }}
                                                @else
                                                    {{$product->price}} {{ config('settings.currency_code') }}
                                                @endif
                                                @if($product->sale_price != null)
                                                    <del>{{$product->price}} {{ config('settings.currency_code') }}</del>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Product slider end -->
        @endif

    @endforeach

    <!--  logo section -->
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="title1 title5">
                    <!-- <h4>العلامات التجارية</h4> -->
                    <a href="{{route('brands')}}"><h2 class="title-inner1">العلامات التجارية</h2></a>
                    <hr role="tournament6">
                </div>
            </div>
        </div>
    </div>
    <section class="section-b-space p-t-0 ratio2_3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="team-4 no-arrow">

                        @foreach($brands as $brand)
                            <div>
                                <div class="logo-block">
                                    <a href="#"><img src="{{asset('uploads/brands/'.$brand->logo)}}" width="125"
                                                     height="125" alt=""></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- logo section end-->

@endsection
