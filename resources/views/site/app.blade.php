<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Códigos de Recarga</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.html">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets.site/favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets.site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets.site/css/main.css') }}">
</head>

<body>   

    <!-- preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader end  -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <header>
        @extends('site.header')
    </header>

    <!-- mobile menu info -->
    <div class="fix">
        <div class="side-info">
            <button class="side-info-close"><i class="fal fa-times"></i></button>
            <div class="side-info-content">
                <div class="bd-mobile-menu"></div>
                <div class="contact-infos mb-30">
                    <div class="contact-list mb-30">
                        <h4>Contact Info</h4>
                        <ul>
                            <li><i class="flaticon-location-1"></i>28/4 Palmal, London</li>
                            <li><i class="flaticon-email"></i><a href="https://themepure.net/cdn-cgi/l/email-protection#0960676f66497a686368276a6664"><span class="__cf_email__" data-cfemail="224b4c444d62514348430c414d4f">[email&#160;protected]</span></a></li>
                            <li><i class="flaticon-phone-call"></i><a href="tel:33388820055">333 888 200 - 55</a></li>
                        </ul>
                        <div class="sidebar__menu--social">
                            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-google"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-overlay"></div>
    <!-- mobile menu info -->

    <main>
        @yield('conteudo')
    </main>

    <!-- JS here -->
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('assets.site/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets.site/js/backToTop.js') }}"></script>
    <script src="{{ asset('assets.site/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets.site/js/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets.site/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets.site/js/main.js') }}"></script>
</body>

</html>