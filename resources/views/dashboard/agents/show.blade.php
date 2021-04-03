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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الوكلاء</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">عرض الوكيل</span>
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
                                        <div class="row justify-content-center">
                                            <div class="col-xl-9">
                                                <!--begin::Wizard Step 1-->
                                                <div class="my-5 step" data-wizard-type="step-content"
                                                     data-wizard-state="current">

                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">اسم
                                                            الوكيل</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-solid form-control-lg @error('name') is-invalid @enderror"
                                                                name="name" type="text" value="{{$agent->name}}"
                                                                readonly>

                                                        </div>

                                                    </div>
                                                    <!--end::Group-->

                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">البريد
                                                            الإلكتروني</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-solid form-control-lg"
                                                                name="email" type="email" value="{{$agent->email}}"
                                                                readonly>


                                                        </div>

                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">رقم
                                                            الهاتف</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-solid form-control-lg "
                                                                name="phone" type="text" value="{{$agent->phone}}"
                                                                readonly>

                                                        </div>

                                                    </div>
                                                    <!--end::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label
                                                            class="col-form-label col-xl-3 col-lg-3">الدولة</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select
                                                                class="form-control form-control-lg form-control-solid"
                                                                name="country" disabled>

                                                                <option
                                                                    value="{{ $agent->country }}"
                                                                    selected>{{ $agent->country }}</option>

                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label
                                                            class="col-form-label col-xl-3 col-lg-3">المدينة</label>
                                                        <div class="col-xl-9 col-lg-9">
                                                            <select
                                                                class="form-control form-control-lg form-control-solid "
                                                                name="city" disabled>

                                                                <option
                                                                    value="{{ $agent->city }}"
                                                                    selected>{{ $agent->city }}</option>

                                                            </select>
                                                            <div class="fv-plugins-message-container"></div>
                                                        </div>
                                                    </div>

                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">العنوان</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input
                                                                class="form-control form-control-solid form-control-lg "
                                                                name="phone" type="text" value="{{$agent->address}}"
                                                                readonly>

                                                        </div>

                                                    </div>
                                                    <!--end::Group-->

                                                    <div class="form-group row">
                                                        <label class="col-3 col-form-label">الحالة</label>
                                                        <div class="col-9 col-form-label">
                                                            <div
                                                                class="radio-inline">
                                                                <label class="radio radio-success">
                                                                    <input type="radio" name="status" value="1"
                                                                           {{$agent->status =='1'?'checked':''}} disabled/>
                                                                    <span></span>
                                                                    مفعل
                                                                </label>
                                                                <label class="radio radio-success">
                                                                    <input type="radio" name="status" value="0"
                                                                           {{$agent->status =='0'?'checked':''}} disabled/>
                                                                    <span></span>
                                                                    غير مفعل
                                                                </label>
                                                            </div>


                                                        </div>
                                                    </div>

                                                    <!--begin::Wizard Actions-->
                                                    <div
                                                        class="d-flex justify-content-between border-top pt-10 mt-15">

                                                        <div>
                                                            <a href="{{route('agents.index')}}" id="next-step"
                                                               class="btn btn-primary font-weight-bolder px-9 py-4">رجوع</a>
                                                        </div>
                                                    </div>
                                                    <!--end::Wizard Actions-->

                                                </div>
                                            </div>
                                        </div>

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
    <script src="{{asset('assets/js/pages/custom/user/add-user.js')}}"></script>
@endsection
