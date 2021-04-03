@extends('dashboard.dashboard')

@section('css')
    <link href="{{asset('assets/css/pages/wizard/wizard-4.rtl.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">المنتجات</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">إضافة منتج</span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Info-->

        </div>
    </div>
@endsection
@section('content')


    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom card-transparent">
                <div class="card-body p-0">
                    <!--begin::Wizard-->
                    <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="true">
                        <!--begin::Wizard Nav-->
                        <!--end::Wizard Nav-->
                        <!--begin::Card-->
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <!--begin::Body-->
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-10">
                                        <!--begin::Wizard Form-->
                                        <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form"
                                              method="post" action="{{route('products.store')}}"
                                              enctype="multipart/form-data">

                                            @csrf

                                            <div class="row justify-content-center">
                                                <div class="col-xl-9">
                                                    <!--begin::Wizard Step 1-->
                                                    <div class="my-5 step" data-wizard-type="step-content"
                                                         data-wizard-state="current">

                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label
                                                                class="col-form-label col-xl-3 col-lg-3">العلامة
                                                                التجارية</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <select
                                                                    class="form-control form-control-lg form-control-solid @error('parent_id') is-invalid @enderror"
                                                                    name="brand_id">
                                                                    <option value="">ليس له علامة تجارية</option>
                                                                    @foreach ($brands as $brand)

                                                                        <option
                                                                            @if($brand->id == old('brand_id')) selected
                                                                            @endif value="{{ $brand->id }}">{{ $brand->name }}</option>

                                                                    @endforeach
                                                                </select>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                            @error('brand_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>


                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label
                                                                class="col-form-label col-xl-3 col-lg-3">التصنيف</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <select
                                                                    class="form-control form-control-lg form-control-solid @error('parent_id') is-invalid @enderror"
                                                                    name="category_id">
                                                                    <option value="">ليس له تصنيف</option>
                                                                    @foreach ($categories as $category)

                                                                        <option
                                                                            @if($category->id == old('category_id')) selected
                                                                            @endif value="{{ $category->id }}">{{ $category->name }}</option>

                                                                    @endforeach
                                                                </select>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                            @error('category_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">اسم
                                                                المنتج</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('name') is-invalid @enderror"
                                                                    name="name" type="text">

                                                                <div class="fv-plugins-message-container">
                                                                    @error('name')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!--end::Group-->
                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">اسم المنتج
                                                                في الرابط</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('slug') is-invalid @enderror"
                                                                    name="slug" type="text">
                                                                <div class="fv-plugins-message-container">
                                                                    @error('slug')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->


                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">وصف
                                                                المنتج</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <textarea
                                                                    class="form-control form-control-solid form-control-lg @error('description') is-invalid @enderror"
                                                                    name="description"></textarea>
                                                                <div class="fv-plugins-message-container">
                                                                    @error('description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label
                                                                class="col-xl-3 col-lg-3 col-form-label">السعر</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('price') is-invalid @enderror"
                                                                    name="price" type="text">
                                                                <div class="fv-plugins-message-container">
                                                                    @error('price')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">السعر
                                                                المخفض</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('sale_price') is-invalid @enderror"
                                                                    name="sale_price" type="text">
                                                                <div class="fv-plugins-message-container">
                                                                    @error('sale_price')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label
                                                                class="col-xl-3 col-lg-3 col-form-label">الكمية</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('quantity') is-invalid @enderror"
                                                                    name="quantity" type="number">
                                                                <div class="fv-plugins-message-container">
                                                                    @error('quantity')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <div class="form-group row">
                                                            <label class="col-3 col-form-label">الحالة</label>
                                                            <div class="col-9 col-form-label">
                                                                <div
                                                                    class="radio-inline @error('status') is-invalid @enderror">
                                                                    <label class="radio radio-success">
                                                                        <input type="radio" name="status" value="1"/>
                                                                        <span></span>
                                                                        مفعل
                                                                    </label>
                                                                    <label class="radio radio-success">
                                                                        <input type="radio" name="status" value="0"/>
                                                                        <span></span>
                                                                        غير مفعل
                                                                    </label>
                                                                </div>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('status')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!--begin::Wizard Actions-->
                                                        <div
                                                            class="d-flex justify-content-between border-top pt-10 mt-15">

                                                            <div>
                                                                <button type="submit"
                                                                        class="btn btn-success font-weight-bolder px-9 py-4">
                                                                    إضافة
                                                                </button>
                                                                <a href="" id="next-step"
                                                                   class="btn btn-primary font-weight-bolder px-9 py-4">إلغاء</a>
                                                            </div>
                                                        </div>
                                                        <!--end::Wizard Actions-->
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!--end::Wizard Form-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Wizard-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('js')
{{--    <script src="{{asset('assets/js/pages/crud/file-upload/dropzonejs.js')}}"></script>--}}


@endsection
