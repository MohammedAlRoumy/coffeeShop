@extends('frontend.index')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>المنتجات</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->



    <!-- section start -->
    <section class="section-b-space j-box pets-box ratio_asos">
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="collection-content col">
                        <div class="page-main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="collection-product-wrapper">
                                        <div class="product-wrapper-grid ">
                                            <div class="row margin-res">
                                                @foreach($products as $product)
                                                <div class="col-xl-3 col-6 col-grid-box">
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
                                                                        <a href="{{route('login')}}" title="إضافة للمفضلة"><i class="ti-heart"
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
                                                                        {{$product->sale_price}} {{\Config::get('currency_code')}}
                                                                    @else
                                                                        {{$product->price}} {{\Config::get('currency_code')}}
                                                                    @endif
                                                                    @if($product->sale_price != null)
                                                                        <del>{{$product->price}} {{\Config::get('currency_code')}}</del>
                                                                    @endif
                                                                </h4>
                                                            </div>
                                                        </div>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="mt-5" >
                                            {{$products->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section End -->

@endsection
