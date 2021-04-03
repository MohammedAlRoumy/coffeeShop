@extends('dashboard.dashboard')

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">تفاصيل الطلب </h5>
                <!--end::Page Title-->
            </div>
            <!--end::Info-->

        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!-- begin::Card-->
            <div class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 pt-md-20 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between pb-10 pb-md-16 flex-column flex-md-row">
                                <div>
                                    <img src="{{asset('uploads/settings/'.config('settings.site_logo'))}}" width="40"
                                         alt="">
                                    <h3 class=" mb-5 mt-3">{{config('settings.site_name')}}</h3>
                                </div>
                                <div class="d-flex flex-column align-items-md-end px-0">

                                    <span class="d-flex flex-column align-items-md-start ">
															<span>
                                                                {{config('settings.default_country')}} ،
                                                                {{config('settings.default_city')}} ،
                                                                {{config('settings.default_address')}}
                                                            </span>
															<span>البريد الإلكتروني : {{config('settings.default_email_address')}}</span>
                                                            <span>رقم الهاتف : {{config('settings.default_phone')}}</span>
														</span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">تاريخ الفاتورة</span>
                                    <span class="opacity-70">{{$order->created_at->format('Y-m-d')}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">رقم الفاتورة</span>
                                    <span class="opacity-70">{{$order->order_number}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">بيانات العميل</span>
                                    <span class="d-flex flex-column align-items-md-start opacity-70">
                                        <span>
                                             {{$order->firstname}} {{$order->lastname}}
                                        </span>
                                        <span >
                                            {{$order->country}} ،
                                            {{$order->city}}

                                        </span>
                                        <span>
                                            {{$order->address}} ،
                                            {{$order->postcode}}
                                        </span>
                                        <span>
                                            {{$order->phone}}
                                        </span>
                                        <span>
                                            {{$order->email}}
                                        </span>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">اسم المنتج</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">الكمية</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">سعر الوحدة</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">السعر
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $x)
                                    <tr class="font-weight-boldest">
                                        <td class="pl-0 pt-7">{{$x->product->name}}</td>
                                        <td class="text-right pt-7">{{$x->quantity}}</td>
                                        <td class="text-right pt-7">{{$x->price}} {{config('settings.currency_code')}}</td>
                                        <td class="text-danger pr-0 pt-7 text-right">{{$x->quantity * $x->price}} {{config('settings.currency_code')}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">اسم المندوب</th>
                                        {{--<th class="font-weight-bold text-muted text-uppercase">ACC.NO.</th>
                                        <th class="font-weight-bold text-muted text-uppercase">DUE DATE</th>--}}
                                        <th class="font-weight-bold text-muted text-uppercase">المبلغ الإجمالي</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{$order->admin->name}}</td>
                                        {{--<td>12345678909</td>
                                        <td>Jan 07, 2018</td>--}}
                                        <td class="text-danger font-size-h3 font-weight-boldest">{{$order->grand_total}} {{config('settings.currency_code')}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">

                                <a href="{{route('orders.index')}}" class="btn btn-primary font-weight-bold">رجوع
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!-- end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

