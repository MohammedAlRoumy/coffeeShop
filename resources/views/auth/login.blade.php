@extends('frontend.index')
@section('content')

<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
                    <h2>تسجيل الدخول</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="login-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>تسجيل دخول</h3>
                <div class="theme-card">
                    <form class="theme-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ادخل البريد الالكتروني"
                                value="{{old('email')}}"   required="">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">كلمة المرور</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                   placeholder="ادخل كلمة المرور" required="">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-solid">تسجيل الدخول</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 right-login">
                <h3>مستخدم جديد</h3>
                <div class="theme-card authentication-right">
                    <h6 class="title-font">إنشاء حساب</h6>
                    <p>قم بالتسجيل للحصول على حساب مجاني في متجرنا. تسجيل سريع وسهل. يتيح لك إمكانية الطلب من متجرنا.
                        لبدء التسوق انقر فوق التسجيل.
                    </p>
                    <a href="{{route('register')}}" class="btn btn-solid">إنشاء حساب</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection
