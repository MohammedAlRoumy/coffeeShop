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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">المستخدمون</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">تعديل مستخدم</span>
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
                                              method="post" action="{{route('users.update',$user->id)}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <div class="row justify-content-center">
                                                <div class="col-xl-9">
                                                    <!--begin::Wizard Step 1-->
                                                    <div class="my-5 step" data-wizard-type="step-content"
                                                         data-wizard-state="current">

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">الاسم الاول
                                                                </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('firstname') is-invalid @enderror"
                                                                    name="firstname" type="text" value="{{old('firstname',$user->firstname)}}" required>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('firstname')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">الاسم الاخير
                                                            </label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('lastname') is-invalid @enderror"
                                                                    name="lastname" type="text" value="{{old('lastname',$user->lastname)}}" required>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('lastname')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">البريد الإلكتروني</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('email') is-invalid @enderror"
                                                                    name="email" type="email" value="{{old('email',$user->email)}}" required>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('email')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">رقم الهاتف</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('phone') is-invalid @enderror"
                                                                    name="phone" type="text" value="{{old('phone',$user->phone)}}" required>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('phone')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">كلمة المرور</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('password') is-invalid @enderror"
                                                                    name="password" type="password" >

                                                                <div class="fv-plugins-message-container">
                                                                    @error('password')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">تأكيد كلمة المرور</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('password_confirmation') is-invalid @enderror"
                                                                    name="password_confirmation" type="password" >

                                                                <div class="fv-plugins-message-container">
                                                                    @error('password_confirmation')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label
                                                                class="col-form-label col-xl-3 col-lg-3">الدولة</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <select
                                                                    class="form-control form-control-lg form-control-solid @error('country') is-invalid @enderror"
                                                                    name="country">
                                                                    @foreach ($countries as $country)

                                                                        <option   @if($country->name == old('country',$country->name)) selected @endif
                                                                        value="{{ $country->name }}">{{ $country->name }}</option>

                                                                    @endforeach
                                                                </select>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                            @error('country')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label
                                                                class="col-form-label col-xl-3 col-lg-3">المدينة</label>
                                                            <div class="col-xl-9 col-lg-9">
                                                                <select
                                                                    class="form-control form-control-lg form-control-solid @error('city') is-invalid @enderror"
                                                                    name="city">
                                                                    @foreach ($cities as $city)

                                                                        <option
                                                                            @if($city->name == old('city',$city->name)) selected
                                                                            @endif value="{{ $city->name }}">{{ $city->name }}</option>

                                                                    @endforeach
                                                                </select>
                                                                <div class="fv-plugins-message-container"></div>
                                                            </div>
                                                            @error('city')
                                                            <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">العنوان</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('address') is-invalid @enderror"
                                                                    name="address" type="text" value="{{old('address',$user->address)}}" required>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('address')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!--end::Group-->

                                                        <!--begin::Group-->
                                                        <div class="form-group row fv-plugins-icon-container">
                                                            <label class="col-xl-3 col-lg-3 col-form-label">الرمز البريدي</label>
                                                            <div class="col-lg-9 col-xl-9">
                                                                <input
                                                                    class="form-control form-control-solid form-control-lg @error('postcode') is-invalid @enderror"
                                                                    name="postcode" type="text" value="{{old('postcode',$user->postcode)}}" required>

                                                                <div class="fv-plugins-message-container">
                                                                    @error('postcode')
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

@section('js')
    <script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
@endsection
