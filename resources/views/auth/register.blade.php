@extends('frontend.index')
@section('content')


<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
                    <h2>إنشاء حساب جديد</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>إنشاء حساب جديد</h3>
                <div class="theme-card">
                    <form class="theme-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="firstname">الاسم الاول</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                       name="firstname" value="{{old('firstname')}}" id="firstname"
                                       placeholder="الاسم الاول" required="">
                                @error('firstname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lastname">الاسم الاخير</label>
                                <input type="text" name="lastname" value="{{old('lastname')}}"
                                       class="form-control @error('lastname') is-invalid @enderror"
                                       id="lastname" placeholder="الاسم الاخير" required="">
                                @error('lastname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="email">البريد الالكتروني</label>
                                <input type="email" name="email" value="{{old('email')}}"
                                       class="form-control @error('email') is-invalid @enderror" id="email"
                                       placeholder="البريد الالكتروني" required="">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" name="phone" value="{{old('phone')}}"
                                       class="form-control @error('phone') is-invalid @enderror" id="phone"
                                       placeholder="رقم الهاتف" required="">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 select_input">
                                <label for="country">الدولة</label>
                                <select id="country" name="country" required=""
                                        class="form-control @error('country') is-invalid @enderror"
                                        size="1">
                                    @foreach ($countries as $country)

                                        <option  @if($country->name == old('country')) selected @endif
                                            value="{{ $country->name }}">{{ $country->name }}</option>

                                    @endforeach
                                </select>
                                @error('country')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 select_input">
                                <label for="city">المدينة</label>
                                <select id="city" name="city" required=""
                                        class="form-control @error('city') is-invalid @enderror"
                                        size="1">
                                    @foreach ($cities as $city)
                                        <option @if($city->name == old('city')) selected @endif
                                        value="{{ $city->name }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="address">العنوان</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                       id="address" placeholder="العنوان" value="{{old('address')}}"  required="">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="postcode">رمز البريد</label>
                                <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror"
                                       id="postcode" placeholder="رمز البريد"
                                      value="{{old('postcode')}}" required="">
                                @error('postcode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="password">كلمة المرور</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" placeholder="ادخل كلمة المرور" required="">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm">تاكيد كلمة المرور</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation" id="password_confirmation"
                                       placeholder="ادخل تاكيد كلمة المرور" required="">
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-solid">انشاء حساب جديد</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection
