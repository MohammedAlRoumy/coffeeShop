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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">التصنيفات</h5>
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
                            @can('اضافة منتج')
                                <!--begin::Button-->
                                    <a href="{{route('products.create')}}" class="btn btn-primary font-weight-bolder">
                                        <i class="la la-plus"></i>إضافة</a>
                                    <!--end::Button-->
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المنتج</th>
                                    <th>الاسم في الرابط</th>
                                    <th>التصنيف الرئيسي</th>
                                    {{--                                    <th>الصورة</th>--}}
                                    <th>الحالة</th>
                                    <th>السعر</th>
                                    <th>السعر المخفض</th>
                                    <th>الكمية</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الاجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $index=>$product)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->slug}}</td>
                                        <td>{{$product->category->name}}</td>
                                        {{--<td><img src="{{asset('uploads/categories/'.$category->image)}}" width="80px"
                                                 alt="logo"></td>--}}
                                        <td>
                                            <span class="label label-lg font-weight-bold
                                             @if($product->status == 1)
                                                label-light-info
                                             @elseif($product->status == 0)
                                                label-light-danger
                                             @endif
                                                label-inline">
                                                    {{$product->status == 1 ? 'مفعل' : 'غير مفعل'}}
                                            </span>
                                        </td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->sale_price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->created_at->format('Y-m-d')}}</td>
                                        <td nowrap="nowrap">
                                            @can('اضافة منتج','تعديل منتج')

                                                <a href="{{route('products.images',$product->id)}}"
                                                   class="btn btn-warning btn-sm"><i
                                                        class="la la-image"></i></a>
                                            @endcan
                                            @can('تعديل منتج')
                                                <a href="{{route('products.edit',$product->id)}}"
                                                   class="btn btn-info btn-sm"><i
                                                        class="la la-edit"></i></a>
                                            @endcan
                                            @can('حذف منتج')
                                                <form
                                                    action="{{route('products.destroy',$product->id)}}"
                                                    method="post"
                                                    style="display: inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm delete"
                                                            title="Delete">
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                            {{ $products->links() }}
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

    {{--    <script src="{{asset('assets/plugins/custom/uppy/uppy.bundle.js')}}"></script>
        <script src="{{asset('assets/js/pages/crud/file-upload/uppy.js')}}"></script>--}}


    {{--    <script src="{{asset('assets/js/pages/crud/datatables/basic/headers.js')}}"></script>--}}
@endsection
