@extends('frontend.index')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>التصنيفات</h2>
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
                @foreach($categories as $category)
                <div class="col-md-4 pb-3">
                    <a href="{{route('products.index',['category_name'=>$category->name])}}">
                        <div class="mr-3 collection-banner p-center text-center">
                            <div class="img-part">
                                <img src="{{asset('uploads/categories/'.$category->image)}}" alt=""
                                     class="img-fluid blur-up lazyload bg-img">
                            </div>
                        </div>
                        <div class="contain-banner banner-3">
                            <div>
                                <h3 class="text-center">{{$category->name}}</h3>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="mt-5" >
                {{$categories->links()}}
            </div>
        </div>
    </section>
    <!-- banner section End -->

@endsection
