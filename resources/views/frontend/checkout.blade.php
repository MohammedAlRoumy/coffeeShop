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


    <!-- section start -->
    <section class="section-b-space">
        <div class="container">
            {{--
                        <form action="{{route('coupon.check')}}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    @isset($coupon)
                                        <input type="text" class="form-control @error('coupon') is-invalid @enderror" name="coupon"
                                               placeholder="كود الخصم"   value="{{$coupon->code}}"  aria-label=""
                                               aria-describedby="basic-addon1">
                                        @error('coupon')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <input type="text" class="form-control @error('coupon') is-invalid @enderror" name="coupon"
                                               placeholder="كود الخصم" value="" aria-label=""
                                               aria-describedby="basic-addon1">
                                        @error('coupon')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @endisset
                                    <button type="submit" id="coupon" class="btn-solid btn btn-sm">تحقق</button>

                                </div>
                            </div>
                        </form>

                        <hr>--}}


            @if (session()->has('success'))
                <p class="alert alert-success">
                    {{ session('success') }}
                </p>
            @endif


            @if (session()->has('error'))
                <p class="alert alert-danger">
                    {{ session('error') }}
                </p>
            @endif


            <div class="checkout-page">
                <div class="checkout-form">
                    <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>تفاصيل الفاتورة</h3>
                                </div>
                                <div class="row check-out">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">الاسم الاول</div>
                                        <input type="text" name="firstname" value="{{auth()->user()->firstname}}"
                                               placeholder="">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">الاسم الاخير</div>
                                        <input type="text" name="lastname" value="{{auth()->user()->lastname}}"
                                               placeholder="">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">الهاتف</div>
                                        <input type="text" name="phone" value="{{auth()->user()->phone}}"
                                               placeholder="">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">البريد الالكتروني</div>
                                        <input type="text" name="email" value="{{auth()->user()->email}}"
                                               placeholder="">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">الدولة</div>
                                        <select id="country" name="country" required=""
                                                class="form-control @error('country') is-invalid @enderror"
                                                size="1">
                                            @foreach ($countries as $country)

                                                <option @if($country->name == auth()->user()->country) selected @endif
                                                value="{{ $country->name }}">{{ $country->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">المدينة</div>
                                        <select id="city" name="city" required=""
                                                class="form-control @error('city') is-invalid @enderror"
                                                size="1">
                                            @foreach ($cities as $city)
                                                <option @if($city->name == auth()->user()->city) selected @endif
                                                value="{{ $city->name }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">العنوان</div>
                                        <input type="text" name="address" value="{{auth()->user()->address}}"
                                               placeholder="">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">رمز البريد</div>
                                        <input type="text" name="post_code" value="{{auth()->user()->postcode}}"
                                               placeholder="">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label" style="float: right">ملاحظات</div>
                                        <textarea name="notes" class="form-control" placeholder=""
                                                  id="message" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>المنتج <span>المجموع</span></div>
                                        </div>
                                        <ul class="qty">
                                            @foreach(\Cart::getContent() as $item)
                                                <li>{{$item->name}} * {{$item->quantity}}
                                                    <span>{{$item->getPriceSum()}} {{ config('settings.currency_code') }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul class="total">
                                            @isset($coupon)

                                            @else
                                                <li>المجموع الكلي <span class="count">
                                                     {{Cart::getSubTotal()}} {{ config('settings.currency_code') }}
                                                </span>
                                                </li>
                                            @endisset
                                            <hr>
                                            <li>
                                                الخصم <span class="count">
                                                    @isset($coupon)
                                                        {{Cart::getCondition($coupon->name)->getValue()}}
                                                        @if($coupon->discount_type == 'fixed')
                                                            {{ config('settings.currency_code') }}
                                                        @else
{{--                                                            %--}}
                                                        @endif
                                                    @endisset
                                                </span>
                                            </li>
                                            <hr>
                                                @isset($coupon)
                                            <li>المجموع الكلي بعد الخصم <span
                                                    class="count">{{Cart::getSubTotal()}} {{ config('settings.currency_code') }}</span>
                                            </li>
                                                @endisset
                                        </ul>

                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            @isset($coupon)
                                                <input type="text"
                                                       class="form-control @error('coupon') is-invalid @enderror"
                                                       name="coupon"
                                                       placeholder="كود الخصم" value="{{$coupon->code}}" aria-label=""
                                                       aria-describedby="basic-addon1">
                                                @error('coupon')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            @else
                                                <input type="text"
                                                       class="form-control @error('coupon') is-invalid @enderror"
                                                       name="coupon"
                                                       placeholder="كود الخصم" value="" aria-label=""
                                                       aria-describedby="basic-addon1">
                                                @error('coupon')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            @endisset
                                            <a href="{{route('coupon.check')}}" id="coupon"
                                               class="btn-solid btn btn-sm">تحقق</a>

                                        </div>
                                    </div>

                                    <hr>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>

                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment_method"
                                                                   value="الدفع عند الاستلام"
                                                                   onclick="document.getElementById('moyasar').style.display = 'none'"
                                                                   id="payment-2">
                                                            <label for="payment-2">الدفع عند الاستلام</label>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="radio-option paypal">
                                                            <input type="radio" name="payment_method" value="ميسر" onclick="document.getElementById('moyasar').style.display = 'block'" id="payment-1">
                                                            <label for="payment-1">ميسر</label>
{{--
                                                            <div class="row" style="display: none" id="moyasar">
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="field-label">الاسم في البطاقة</div>
                                                                    <input type="text" value="" placeholder="" width="100%">
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="field-label">رقم البطاقة</div>
                                                                    <input type="text" value="" placeholder="" width="100%">
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="field-label">رقم التحقق CVV</div>
                                                                    <input type="text" value="" placeholder="" width="100%">
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="field-label">الشهر</div>
                                                                    <input type="number" value="" placeholder="" width="100%">
                                                                </div>
                                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="field-label">السنة</div>
                                                                    <input type="number" value="" placeholder="" width="100%">
                                                                </div>
                                                            </div>
--}}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn-solid btn">إكمال الدفع</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
@endsection
