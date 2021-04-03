@extends('dashboard.dashboard')

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">تفاصيل الفاتورة </h5>
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
                                    <span class="opacity-70">{{$order_date}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">رقم الفاتورة</span>
                                    <span class="opacity-70">{{$order_number}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">بيانات العميل</span>
                                    <span class="d-flex flex-column align-items-md-start opacity-70">
                                        <span>
                                             {{$firstname}} {{$lastname}}
                                        </span>
                                        <span >
                                            {{$country}} ،
                                            {{$city}}

                                        </span>
                                        <span>
                                            {{$address}} ،
                                            {{$post_code}}

                                        </span>
                                        <span>
                                             {{$phone}}
                                        </span>
                                        <span>
                                             {{$email}}
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
                                    @foreach($items as $item)
                                        <tr class="font-weight-boldest">
                                            <td class="pl-0 pt-7">{{$item['product_name']}}</td>
                                            <td class="text-right pt-7">{{$item['quantity']}}</td>
                                            <td class="text-right pt-7">{{$item['unit_price']}} {{config('settings.currency_code')}}</td>
                                            <td class="text-danger pr-0 pt-7 text-right">{{$item['quantity'] * $item['unit_price']}} {{config('settings.currency_code')}}</td>
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
                                        <th class="font-weight-bold text-muted text-uppercase">المجموع</th>
                                        <th class="font-weight-bold text-muted text-uppercase">الخصم</th>
                                        <th class="font-weight-bold text-muted text-uppercase">المبلغ الإجمالي</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{$agent_name}}</td>
                                        <td>{{$sub_total}} {{config('settings.currency_code')}}</td>
                                        <td>{{$discount??'0'}}</td>
                                        <td class="text-danger font-size-h3 font-weight-boldest">{{$grand_total}} {{config('settings.currency_code')}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                   {{-- <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <a href="{{route('order.pdf',$order->id)}}"
                                   class="btn btn-light-primary font-weight-bold">تحميل الفاتورة
                                </a>
                                <button type="button" class="btn btn-primary font-weight-bold"
                                        onclick="window.print();">طباعة الفاتورة
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->--}}
                    <!-- end: Invoice-->
                </div>
            </div>
            <!-- end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('js')
    <script>
        window.print();
    </script>
@endsection
