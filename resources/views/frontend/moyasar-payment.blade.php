@extends('frontend.index')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>الدفع</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <section class="contact-page section-b-space">
        <div class="container">

            <div class="row section-b-space">
                <div class="col-lg-12 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST">
                            @csrf
                                <input type="hidden" name="callback_url" value="http://localhost/coffeeShop/public/payments_redirect/{{$order->id}}/" />
                                <input type="hidden" name="publishable_api_key" value="pk_test_jkgSLzxCAU6rBb4u1XwMYFBqcNgPmatZBTrFwCE3" />
                                <input type="hidden" name="amount" value="{{intval(Cart::getSubTotal())}}" />
                                <input type="hidden" name="source[type]" value="creditcard" />

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="fname" style="float: right">الاسم </label>
                                        <input type="text" name="source[name]" class="form-control @error('source[name]') is-invalid @enderror" id="fname" placeholder="ادخل الاسم في البطاقة"
                                       required="" >
                                        @error('source[name]')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" style="float: right">رقم البطاقة</label>
                                        <input type="text" name="source[number]" class="form-control @error('source[number]') is-invalid @enderror" id="email" placeholder="رقم البطاقة" required="">
                                        @error('source[number]')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title" style="float: right">CVC</label>
                                        <input type="text" name="source[cvc]" class="form-control @error('source[cvc]') is-invalid @enderror" id="title" placeholder="ادخل cvc "
                                               required="">
                                        @error('source[cvc]')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="title" style="float: right">الشهر</label>
                                        <input type="text" name="source[month]" class="form-control @error('source[month]') is-invalid @enderror" id="title" placeholder="ادخل الشهر "
                                               required="">
                                        @error('source[month]')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="title" style="float: right">السنة</label>
                                        <input type="text" name="source[year]" class="form-control @error('source[year]') is-invalid @enderror" id="title" placeholder="ادخل السنة "
                                               required="">
                                        @error('source[year]')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <button class="btn btn-solid" type="submit">إتمام عملية الدفع</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <section
@endsection
