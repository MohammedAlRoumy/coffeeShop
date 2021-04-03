@extends('frontend.index')
@section('content')



    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>بيانات المستخدم</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- personal deatail section start -->
    <section class="contact-page register-page section-b-space">
        <div class="container">

            @if (session()->has('success'))
                <p class="alert alert-success">
                    {{ session('success') }}
                </p>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <h3>التفاصيل الشخصية</h3>
                    <form class="theme-form" action="{{route('updateProfile',$user->id)}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="name">الاسم الاول</label>
                                <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="name"  placeholder="الاسم الاول"
                                     value="{{old('firstname',$user->firstname)}}"  required="">
                                @error('firstname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email">الاسم الاخير</label>
                                <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="last-name" placeholder="الاسم الاخير"
                                       value="{{old('lastname',$user->lastname)}}"  required="">
                                @error('lastname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="review">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="review" placeholder="رقم الهاتف"
                                       value="{{old('phone',$user->phone)}}" required="">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email">البريد الالكتروني</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="البريد الالكتروني"
                                       value="{{old('email',$user->email)}}" required="">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 select_input">
                                <label for="review">الدولة</label>
                                <select name="country" class="form-control @error('country') is-invalid @enderror" size="1">
                                    @foreach($countries as $country)
                                    <option value="{{old('country',$user->country)}}" {{$user->country == $country->name ? 'selected' : ''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 select_input">
                                <label for="review">المدينة</label>
                                <select name="city" class="form-control @error('city') is-invalid @enderror" size="1">
                                    @foreach($cities as $city)
                                        <option value="{{old('city',$user->city)}}" {{$user->city == $city->name ? 'selected' : ''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name">العنوان</label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address',$user->address)}}" id="address-two" placeholder="العنوان"
                                       required="">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email">رمز البريد</label>
                                <input type="text" name="postcode" value="{{old('postcode',$user->postcode)}}" class="form-control @error('postcode') is-invalid @enderror" id="zip-code" placeholder="رمز البريد"
                                       required="">
                                @error('postcode')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-sm btn-solid" type="submit">حفظ البيانات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->

@endsection
