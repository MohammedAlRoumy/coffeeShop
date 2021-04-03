<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{asset('uploads/settings/'.config('settings.site_favicon'))}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('uploads/settings/'.config('settings.site_favicon'))}}" type="image/x-icon"/>
    <title>{{config('settings.site_name')}} | {{config('settings.site_title')}}</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/fontawesome.css')}}">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/slick-theme.css')}}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/animate.css')}}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/themify-icons.css')}}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.css')}}">

{{--    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/easyautocomplete/easy-autocomplete.min.css') }}">--}}

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/color15.css')}}" media="screen"
          id="color">

    <style>
        .fw-900 {
            font-weight: 900;
        }
    </style>

</head>

<body class="rtl">

<!-- header start -->
<header class="header-2 header-6 header-fixed">
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>مرحبا بك في متجر قهوتنا لبيع القهوة</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist">
                            @auth
                            <a href="{{ route('products', ['favorite' => 1]) }}">
                                @auth
                                    <span class="badge btn-dark"
                                          id="nav__fav-count" data-fav-count="{{ auth()->user()->products_count }}">
                                     {{ auth()->user()->products_count > 9 ? '9+' : auth()->user()->products_count }}
                                </span>
                                @endauth
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                المفضلة
                            </a>
                            @else
                                <a href="{{ route('login') }}">
                                    @auth
                                        <span class="badge btn-dark"
                                              id="nav__fav-count" data-fav-count="{{ auth()->user()->products_count }}">
                                     {{ auth()->user()->products_count > 9 ? '9+' : auth()->user()->products_count }}
                                </span>
                                    @endauth
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    المفضلة
                                </a>
                            @endauth

                        </li>
                        <li class="onhover-dropdown mobile-account">
                            <i class="fa fa-user" aria-hidden="true"></i> حسابي
                            @if (Route::has('login'))
                                <ul class="onhover-show-div">

                                    @auth
                                        <li>
                                            <a href="{{route('profile',auth()->user()->id)}}" data-lng="en">
                                                {{auth()->user()->firstname}}  {{auth()->user()->lastname}}

                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('myOrders',auth()->user()->id)}}" data-lng="en">
                                                طلباتي
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                تسجيل خروج
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                </form>

                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{route('login')}}" data-lng="en">
                                                تسجيل دخول
                                            </a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}" data-lng="es">
                                                    تسجيل مستخدم جديد
                                                </a>
                                            </li>
                                        @endif
                                    @endauth
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu border-section border-top-0">

                    <div class="menu-left">
                        <div>
                            <a href="#"><img src="{{asset('uploads/settings/'.config('settings.site_logo'))}}" width="60" height="40"
                                             class="img-fluid blur-up lazyloaded" alt=""></a>
                        </div>
                    </div>

                    <x-search/>

                    <div class="menu-right pull-right">
                        <div class="icon-nav">
                            <ul>
                                <x-mobile-search/>

                                <li class="onhover-div mobile-cart">
                                    <div>
                                        <a href="{{route('checkout.cart')}}">
                                            <img src="{{asset('frontend/assets/images/icon/cart.png')}}"
                                                 class="img-fluid blur-up lazyload" alt="">
                                            <i class="ti-shopping-cart"></i>
                                            <span class="badge btn-danger">{{ $cartCount }}</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row ">
            <div class="col-lg-12">
                <div class="main-nav-center">
                    <nav id="main-nav">
                        <div class="toggle-nav">
                            <i class="fa fa-bars sidebar-bar"></i>
                        </div>
                        <!-- Sample menu definition -->
                        <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                            <li>
                                <div class="mobile-back text-right">رجوع<i class="fa fa-angle-right pl-2"
                                                                           aria-hidden="true"></i></div>
                            </li>
                            <li>
                                <a href="{{route('contactus')}}">
                                    <h4>اتصل بنا</h4>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('home.about')}}">
                                    <h4>من نحن</h4>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('brands')}}">
                                    <h4>العلامات التجارية</h4>
                                </a>
                            </li>


                            <li>
                                <a href="{{route('products')}}">
                                    <h4>المنتجات</h4>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('categories')}}">
                                    <h4>التصنيفات</h4>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('home.index')}}">
                                    <h4>الرئيسية</h4>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->

@yield('content')

<!-- footer -->
<footer class="footer-light">
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row footer-theme partition-f">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-title footer-mobile-title">
                        <h4>من نحن</h4>
                    </div>
                    <div class="footer-contant">
                        <div class="footer-logo">
                            <a href="#"><img src="{{asset('uploads/settings/'.config('settings.site_logo'))}}" width="60" height="40"
                                             class="img-fluid blur-up lazyloaded" alt=""></a>
                        </div>
                        <p>قهوتنا هو متجر الكتروني مختص في بيع القهوة ومستلزماتها داخل اللملكة العربية السعودية ،
                            حيث يمكنك التسوق من خلاله وشراء القهوة المفضلة لديك بكل سهولة </p>
                        <div class="footer-social">
                            <ul>
                                <li><a href="{{config('settings.social_facebook')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="{{config('settings.social_youtube')}}" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a href="{{config('settings.social_twitter')}}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="{{config('settings.social_instagram')}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col offset-xl-1">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>روابط سريعة</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li><a href="{{route('home.index')}}">الرئيسية</a></li>
                                <li><a href="{{route('categories')}}">التصنيفات</a></li>
                                <li><a href="{{route('contactus')}}">من نحن</a></li>
                                <li><a href="{{route('home.about')}}">اتصل بنا</a></li>
                                <li><a href="{{route('login')}}">تسجيل الدخول</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>للتواصل</h4>
                        </div>
                        <div class="footer-contant">
                            <ul class="contact-list">
                                <li><i class="fa fa-map-marker"></i>
                                    {{config('settings.default_country')}} ،
                                     {{config('settings.default_city')}} ،
                                     {{config('settings.default_address')}}
                                </li>
                                <li><i class="fa fa-phone"></i>اتصل بنا: {{config('settings.default_phone')}}</li>
                                <li><i class="fa fa-envelope-o"></i>البريد الالكتروني: <a
                                        href="#">{{config('settings.default_email_address')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="sub-footer black-subfooter">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p>{{date('Y')}} <i class="fa fa-copyright" aria-hidden="true"></i>  قهوتنا
                        </p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="payment-card-bottom">
                        <ul>
                            <li>
                                <a href="#"><img src="{{asset('frontend/assets/images/icon/visa.png')}}" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('frontend/assets/images/icon/mastercard.png')}}"
                                                 alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('frontend/assets/images/icon/paypal.png')}}" alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('frontend/assets/images/icon/american-express.png')}}"
                                                 alt=""></a>
                            </li>
                            <li>
                                <a href="#"><img src="{{asset('frontend/assets/images/icon/discover.png')}}" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->


<!-- tap to top -->
<div class="tap-top border-white border">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top end -->


<!-- latest jquery-->
<script src="{{asset('frontend/assets/js/jquery-3.3.1.min.js')}}"></script>

<!-- menu js-->
<script src="{{asset('frontend/assets/js/menu.js')}}"></script>

<!-- lazyload js-->
<script src="{{asset('frontend/assets/js/lazysizes.min.js')}}"></script>

<!-- popper js-->
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>

<!-- slick js-->
<script src="{{asset('frontend/assets/js/slick.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('frontend/assets/js/bootstrap.js')}}"></script>

<!-- Bootstrap Notification js-->
<script src="{{asset('frontend/assets/js/bootstrap-notify.min.js')}}"></script>

<!-- Theme js-->
<script src="{{asset('frontend/assets/js/script.js')}}"></script>


{{--<script src="{{ asset('frontend/assets/plugins/easyautocomplete/jquery.easy-autocomplete.min.js') }}"></script>--}}

<script>
    $(window).on('load', function () {
        setTimeout(function () {
            $('#exampleModal').modal('show');
        }, 2500);
    });

    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>
<script>
    $('#coupon').on('click', function (e) {
        e.preventDefault()
        var c = $('[name=coupon]').val()
        if (!c) {
            return
        }
        window.location = window.location + '?coupon=' + c;
    })
</script>
<script>
    $(document).ready(function () {

        let favCount = Number($('#nav__fav-count').data('fav-count'));

        $(document).on('click', '.product__fav-icon', function (e) {
            e.preventDefault();
            // alert('test');


            toggleFavorite($(this));

        });//end of on click fav icon


        function toggleFavorite(btn) {
            // alert(url);
            let url = btn.find('.product__fav-icon').data('url');
            let productId = btn.find('.product__fav-icon').data('product-id');

            $.ajax({
                url: url,
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

            }).done(function (res) {
                if (res.added) {
                    btn.find('.fa').addClass('fa-heart').removeClass('fa-heart-o');
                    favCount++
                } else {
                    btn.find('.fa').removeClass('fa-heart').addClass('fa-heart-o');
                    favCount--
                }
                favCount > 9 ? $('#nav__fav-count').html('9+') : $('#nav__fav-count').html(favCount);
                $('#nav__fav-count').data('fav-count', favCount)


                // to remove books from favorite page when click unfavored book
                if ($('.prodcut-' + productId).closest('.favorite').length) {

                    $('.prodcut-' + prodcutId).closest('.book').remove();

                }//end of if
            });//end of ajax call

        }

    });//end of document ready


</script>

<script>
    $(document).ready(function () {


        $(document).on('click', '.product__add-cart', function () {
            // alert('test');
            let url = $(this).find('.product__add-cart').data('url');
            let productId = $(this).find('.product__add-cart').data('product-id');
            let productName = $(this).find('.product__add-cart').data('product-name');
            let productPrice = $(this).find('.product__add-cart').data('product-price');
            let productQuantity = $(this).find('.product__add-cart').data('product-quantity');


            addCart(url, productId, productName, productPrice, productQuantity);

        });//end of on click fav icon


        function addCart(url, productId, productName, productPrice, productQuantity) {


            $.ajax({
                url: url,
                data: {
                    productId: productId,
                    name: productName,
                    price: productPrice,
                    quantity: productQuantity,
                },
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

            });//end of ajax call

        }

    });//end of document ready


</script>
{{--
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var options = {

        url: function (search) {
            return "{{route('products')}}?search=" + search ;
        },

        ajaxSettings: {
            dataType: "json"
        },

        getValue: "name",

        list: {

            onChooseEvent: function () {
                var product = $('.form-control[type="search"]').getSelectedItemData();
                var url = "product/" + product.id;
                window.location.replace(url);
            }
        },

        theme: "round",
        adjustWidth: false,
    };

    $('.form-control[type="search"]').easyAutocomplete(options)

</script>--}}


</body>

</html>
