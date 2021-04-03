@extends('dashboard.dashboard')
@section('css')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">طلبات </h5>
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
            <!--begin::Dashboard-->

            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header flex-wrap py-5">
                            <div class="card-title">
                                {{--                                <h3 class="card-label">العلامات التجارية</h3>--}}
                                <form action="">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="search" name="search" autofocus class="form-control"
                                                   placeholder="بحث" value="{{request()->search}}">
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-info mr-2"><i class="fa fa-search"></i>
                                                بحث
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-toolbar">
                                <!--begin::Dropdown-->

                                <!--end::Dropdown-->
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم العميل</th>
                                    <th>رقم الطلب</th>
                                    <th>الحالة</th>
                                    <th>عدد المنتجات</th>
                                    <th>المجموع</th>
                                    <th>الوكيل</th>
                                    <th>طريقة الدفع</th>
                                    <th>المدينة</th>
                                    <th>العنوان</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الاجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $index=>$order)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$order->user->firstname}} {{$order->user->lastname}}</td>
                                        <td>{{$order->order_number}}</td>
                                        <td>@if($order->status == 'pending')
                                                معلق
                                            @elseif($order->status == 'processing')
                                                قيد التنفيذ
                                            @elseif($order->status == 'completed')
                                                مكتمل
                                            @elseif($order->status == 'decline')
                                                مرفوض
                                            @endif

                                        </td>
                                        <td>{{$order->item_count}}</td>
                                        <td>{{$order->grand_total}}</td>
                                        <td>{{$order->admin->name}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>{{$order->city}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->created_at->format('Y-m-d')}}</td>


                                        <td nowrap="nowrap">
                                            @can('عرض طلب')
                                                <a href="{{route('orders.show',$order->id)}}"
                                                   class="btn btn-success btn-sm"><i
                                                        class="la la-eye"></i></a>
                                            @endcan
                                            @can('تعديل طلب')
                                                <a href="{{route('orders.edit',$order->id)}}"
                                                   class="btn btn-info btn-sm"><i
                                                        class="la la-edit"></i></a>
                                            @endcan
                                            @can('طباعة طلب')
                                                <a href="{{route('order.print',$order->id)}}"
                                                   class="btn btn-warning btn-sm"><i
                                                        class="la la-print"></i></a>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                            {{$orders->links()}}
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('js')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    {{--    <script src="{{asset('assets/js/pages/crud/datatables/basic/headers.js')}}"></script>--}}

    <script>
        $("#kt_sweetalert_demo_8").click(function (e) {
            Swal.fire({
                title: "هل انت متأكد من العملية ؟",
                text: "عند حذف هذا العنصر لايمكن استرجاعة",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "نعم, قم بالحذف!"
            }).then(function (result) {
                if (result.value) {
                    Swal.fire(
                        "تم الحذف!",
                        "تم حذف العنصر.",
                        "success"
                    )
                }
            });
        });
    </script>
@endsection
