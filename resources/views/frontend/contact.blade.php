@extends('frontend.index')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>اتصل بنا</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!--section start-->
    <section class="contact-page section-b-space">
        <div class="container">


            @if (session()->has('success'))
                <p class="alert alert-success">
                    {{ session('success') }}
                </p>
            @endif


            <div class="row section-b-space">
                <div class="col-lg-8 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="theme-form" action="" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="fname">الاسم الاول </label>
                                        <input type="text" name="fname" class="form-control @error('fname') is-invalid @enderror" id="fname" placeholder="ادخل الاسم الاول"
                                             required=""  >
                                        @error('fname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lname">الاسم الاخير </label>
                                        <input type="text" name="lname" class="form-control @error('lname') is-invalid @enderror" id="lname" placeholder="ادخل الاسم الاخير"
                                            required=""   >
                                        @error('lname')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">البريد الالكتروني</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ادخل البريد الالكتروني" required="">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title">عنوان الرسالة</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="ادخل عنوان الرسالة"
                                               required="">
                                        @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="message">الرسالة</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" placeholder="ادخل محتوى الرسالة"
                                                  id="message" rows="6"></textarea>
                                        @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-solid" type="submit">ارسل الرسالة</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-right">
                        <ul>

                            <li>
                                <div class="contact-icon"><img src="{{asset('frontend/assets/images/icon/phone.png')}}"
                                                               alt="Generic placeholder image">
                                    <h6>الهاتف</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{config('settings.default_phone')}}</p>
                                </div>
                            </li>

                            <li>
                                <div class="contact-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <h6>العنوان</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{config('settings.default_address')}}</p>
                                    <p>{{config('settings.default_city')}}</p>
                                    <p>{{config('settings.default_country')}}</p>
                                </div>
                            </li>

                            <li>
                                <div class="contact-icon"><img src="{{asset('frontend/assets/images/icon/email.png')}}"
                                                               alt="Generic placeholder image">
                                    <h6>البريد الالكتروني</h6>
                                </div>
                                <div class="media-body">
                                    <p>{{config('settings.default_email_address')}}</p>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--Section ends-->
@endsection
