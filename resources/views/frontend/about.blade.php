@extends('frontend.index')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>من نحن</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->


    <!-- about section start -->
    <section class="about-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-section">
                        <img src="{{asset('uploads/aboutus/'.$about->image)}}"
                             class="img-fluid blur-up lazyload" alt="" width="100%">
                    </div>
                </div>

                <div class="col-sm-12">
                    <hr>
                    <h3>
                        {{$about->title}}
                    </h3>

                    <p >
                       {{$about->description}}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->

@endsection
