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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">الطلبات</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">تعديل حالة الطلب</span>
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
                                              method="post" action="{{route('orders.update',$order->id)}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <div class="row justify-content-center">
                                                <div class="col-xl-9">
                                                    <!--begin::Wizard Step 1-->
                                                    <div class="my-5 step" data-wizard-type="step-content"
                                                         data-wizard-state="current">
{{--                                                        'pending', 'processing', 'completed', 'decline'--}}
                                                        <div class="form-group row">
                                                            <label class="col-3 col-form-label">الحالة</label>
                                                            <div class="col-9 col-form-label">
                                                                <div
                                                                    class="radio-inline @error('status') is-invalid @enderror">
                                                                    <label class="radio radio-success">
                                                                        <input type="radio" name="status" value="pending" {{$order->status =='pending'?'checked':''}}/>
                                                                        <span></span>
                                                                        معلق
                                                                    </label>
                                                                    <label class="radio radio-success">
                                                                        <input type="radio" name="status" value="processing" {{$order->status =='processing'?'checked':''}}/>
                                                                        <span></span>
                                                                        قيد التنفيذ
                                                                    </label>

                                                                    <label class="radio radio-success">
                                                                        <input type="radio" name="status" value="completed" {{$order->status =='completed'?'checked':''}}/>
                                                                        <span></span>
                                                                        مكتمل
                                                                    </label>

                                                                    <label class="radio radio-success">
                                                                        <input type="radio" name="status" value="decline" {{$order->status =='decline'?'checked':''}}/>
                                                                        <span></span>
                                                                        مرفوض
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
                                                                    تعديل
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

