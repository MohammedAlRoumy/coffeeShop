@extends('frontend.index')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>طلبات المستخدم</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!--section start-->
    <section class="cart-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table  table-responsive-xs">
                        <thead>
                        <tr class="table-head text-center">
                            <th scope="col">رقم الطلب</th>
                            <th scope="col">عدد المنتجات</th>
                            <th scope="col">طريقة الدفع</th>
                            <th scope="col">المبلغ الاجمالي</th>
                            <th scope="col">حالة الطلب</th>
                            <th scope="col">تاريخ الإنشاء</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if (empty($orders))
                            <p class="alert alert-warning">لايوجد منتجات في السلة</p>
                        @else
                            @foreach($orders as $order)
                                {{--                                {{dd($item)}}--}}
                                <tr>

                                    <td>
                                        {{$order->order_number}}
                                    </td>
                                    <td>
                                        {{$order->item_count}}
                                    </td>
                                    <td>
                                        {{$order->payment_method}}
                                    </td>
                                    <td>
                                        {{$order->grand_total}} {{ config('settings.currency_code') }}
                                    </td>
                                    <td>
                                        {{$order->status}}
                                    </td>
                                    <td>
                                        {{$order->created_at->format('Y-m-d')}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                    </table>
                </div>
                <div class="mt-5" >
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </section>
    <!--section end-->
@endsection
