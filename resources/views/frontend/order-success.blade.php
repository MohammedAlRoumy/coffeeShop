@extends('frontend.index')
@section('content')

    <!-- thank-you section start -->
    <section class="section-b-space ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
                        <h2>شكرا لك</h2>
                        <p>تمت معالجة الدفع بنجاح وطلبك في الطريق</p>
                        <p>رقم الطلب : {{$order->order_number}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->
@endsection
