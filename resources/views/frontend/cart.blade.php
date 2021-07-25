@extends('frontend.index')
@section('content')


    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>السلة</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->



    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success text-right">
                    {{Session::get('success')}}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger text-right">
                    {{Session::get('error')}}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">الصورة</th>
                            <th scope="col">اسم المنتج</th>
                            <th scope="col">السعر</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">الاجراء</th>
                            <th scope="col">المجموع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (\Cart::isEmpty())
                            <p class="alert alert-warning">لايوجد منتجات في السلة</p>
                        @else
                            @foreach(\Cart::getContent() as $item)
                                {{--                                {{dd($item)}}--}}
                                <tr>
                                    <td>
                                        @php
                                            $product =  \App\Models\Product::find($item->id)
                                        @endphp
                                        <a href="#"><img
                                                src="{{url('uploads/products/'.$product->images->first()->image)}}"
                                                alt=""></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('product.show', $item->id) }}">{{$item->name}}</a>
                                        <div class="mobile-cart-content row">
                                            <div class="col-xs-3">


                                                {{$item->quantity}}

                                            </div>
                                            <div class="col-xs-3">
                                                {{$item->price}}
                                            </div>
                                            <div class="col-xs-3">
                                                <h2 class="td-color"><a href="#" class="icon"><i
                                                            class="ti-close"></i></a>
                                                </h2>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$item->price}} {{ config('settings.currency_code') }}
                                    </td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td><a href="{{ route('checkout.cart.remove', $item->id) }}" class="icon"><i
                                                class="ti-close"></i></a></td>
                                    <td>
                                        <h2 class="td-color">{{$item->getPriceSum()}} {{ config('settings.currency_code') }}</h2>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                    <table class="table cart-table table-responsive-md">
                        <tfoot>
                        <tr>
                            <td>المجموع الكلي :</td>
                            <td>
                                <h2>{{Cart::getSubTotal()}} {{ config('settings.currency_code') }}</h2>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">

                <div class="col-4">
                    <a href="{{ route('home.index') }}" class="btn btn-solid">الاستمرار في التسوق</a>
                </div>
                <div class="col-4">
                    <a href="{{ route('checkout.cart.clear') }}" class="btn btn-danger btn-lg ml-2">تفريغ السلة</a>

                </div>
                <div class="col-4">
                    <a href="{{ route('checkout.index') }}" class="btn btn-solid">الدفع</a>
                </div>
            </div>
        </div>
    </section>
    <!--section end-->

@endsection
