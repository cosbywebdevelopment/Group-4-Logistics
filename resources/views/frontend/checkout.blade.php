<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ appName() }}</title>
    <meta name="description" content="@yield('meta_description', appName())">
    {{--        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">--}}
    @yield('meta')

    @stack('before-styles')
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">

@stack('after-styles')

<!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css' rel='stylesheet' />

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
{{--    <link rel="stylesheet" type="text/css" href="./style.css" />--}}


<!-- =======================================================
    * Template Name: FlexStart - v1.9.0
    * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body>

@include('includes.partials.read-only')
@include('includes.partials.logged-in-as')
{{--@include('includes.partials.announcements')--}}
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <img src="assets/img/logo.webp" alt="">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="/#hero">Home</a></li>
                <li><a class="nav-link scrollto" href="/#about">Quote Tool</a></li>
                <li><a class="nav-link scrollto" href="/#services">Services</a></li>
                <li><a class="nav-link scrollto" href="/#portfolio">Portfolio</a></li>
                <li><a class="nav-link scrollto" href="/#team">Team</a></li>
                {{--          <li><a href="blog.html">Blog</a></li>--}}
                <li class="dropdown"><a href="#"><span>Join Us</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @auth
                            @if ($logged_in_user->isUser())
                                <li><a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a></li>
                            @endif

                            <li><a href="{{ route('frontend.user.account') }}">@lang('Account')</a></li>
                        @else
                            <li><a href="{{ route('frontend.auth.login') }}">@lang('Login')</a></li>

                            @if (config('boilerplate.access.user.registration'))
                                <li><a href="{{ route('frontend.auth.register') }}">@lang('Register')</a></li>
                            @endif
                        @endauth
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="/#contact">Contact</a></li>
                <li>
                    <a class="nav-link active" href="/checkout">Checkout</a>
                </li>
                <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->


<!-- ======= Contact Section ======= -->
<section id="" class="contact mt-5">

    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <p>Checkout</p>
        </header>

        <div class="row gy-4">
            <div class="col-lg-6">
                @foreach($item as $row)
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-fan align-middle"></i><span class="pl-2">Vehicle</span></h3>
                            <p class="font-weight-bold">{{ $row->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-envelope align-middle"></i><span class="pl-3">Package</span></h3>
                            <p class="font-weight-bold">{{ $pallet }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-geo-alt align-middle"></i><span class="pl-2">Delivery Route</span></h3>
                            <p>Pickup Time: <span class="font-weight-bold">{{ $time }}</span> on
                                <span class="font-weight-bold">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</span>
                                <br>
                                Miles: <span class="font-weight-bold">{{ $miles }}</span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-currency-pound align-middle"></i><span class="pl-1">Cost</span></h3>
                            <p class="font-weight-bold">£{{ $row->price }}</p>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach

            <div class="col-lg-6">

                <div class="row gy-4">
                    <div class="info-box text-center">

                        <p>This is where the payment gateway will be</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section><!-- End Contact Section -->



<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <img src="assets/img/logo.png" alt="">
                        <span>FlexStart</span>
                    </a>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>
                        A108 Adam Street <br>
                        New York, NY 535022<br>
                        United States <br><br>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
