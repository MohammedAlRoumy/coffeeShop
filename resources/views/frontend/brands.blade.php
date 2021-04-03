@extends('frontend.index')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>العلامات التجارية</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!-- Banner section -->
    <section class="section-b-space pt-0 banner-6 ratio2_1">
        <div class="container">

            <div class="row partition3 banner-top-cls">
               @foreach($brands as $brand)
                <div class="col-md-3 pb-3">
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="{{asset('uploads/brands/'.$brand->logo)}}" width="125" height="125" alt=""></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- banner section End -->

@endsection
