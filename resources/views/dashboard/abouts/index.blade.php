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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">من نحن</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"></span>
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
                                              method="post" action="{{route('abouts.update',$about->id)}}"
                                              enctype="multipart/form-data">

                                            @csrf
{{--                                            @method('put')--}}

                                            <div class="row justify-content-center">
                                                <div class="col-xl-9">
                                                    <!--begin::Wizard Step 1-->
                                                    <div class="my-5 step" data-wizard-type="step-content"
                                                         data-wizard-state="current">
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-xl-3 col-lg-3 col-form-label text-left">صورة
                                                                من نحن </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <div
                                                                    class="image-input image-input-outline image-input-changed"
                                                                    id="kt_user_add_avatar" style="background-color:#ccc;">
                                                                    <div class="image-input-wrapper"
                                                                         style="background-image: url({{asset('uploads/aboutus/'.old('image',$about->image))}})"></div>
                                                                    <label
                                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                        data-action="change" data-toggle="tooltip"
                                                                        title="" data-original-title="تغيير الصورة">
                                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                                        <input type="file" name="image" class="@error('image') is-invalid @enderror"
                                                                               accept=".png, .jpg, .jpeg">
                                                                        <input type="hidden"
                                                                               name="profile_avatar_remove">
                                                                    </label>
                                                                    <span
                                                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                                        data-action="cancel" data-toggle="tooltip"
                                                                        title="" data-original-title="إلغاء الصورة">
																							<i class="ki ki-bold-close icon-xs text-muted"></i>
																						</span>
                                                                </div>
                                                                <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>

                                                                @error('image')
                                                                <div class="text-danger">{{ $message }}</div>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                        <!--end::Group-->
                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">عنوان من نحن
                                                                </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('name') is-invalid @enderror"
                                                                    name="title" type="text" value="{{old('title',$about->title)}}">

                                                                <div class="fv-plugins-message-container">
                                                                    @error('title')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">وصف
                                                                من نحن</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <textarea
                                                                    class="form-control form-control-solid form-control-lg @error('description') is-invalid @enderror"
                                                                    name="description" rows="8">{{old('description',$about->description)}}</textarea>
                                                                <div class="fv-plugins-message-container">
                                                                    @error('description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->


                                                        <!--begin::Wizard Actions-->
                                                        <div
                                                            class="d-flex justify-content-between border-top pt-10 mt-15">

                                                            <div>
                                                                @can('تعديل من نحن')
                                                                <button type="submit"
                                                                        class="btn btn-success font-weight-bolder px-9 py-4">
                                                                    تعديل
                                                                </button>
                                                                @endif
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
    <script src="{{asset('assets/js/pages/custom/user/add-user.js')}}"></script>
@endsection
