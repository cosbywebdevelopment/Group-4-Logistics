<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ appName() }}</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="msvalidate.01" content="BA85530A8410E4786D952AAF8EC2FFE3" />
    <meta name="meta-title" content="{{ appName() }}">
    <meta name="author" content="Cosby Web Development">
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

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
{{--    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{--    <link rel="stylesheet" type="text/css" href="./style.css" />--}}

<!-- Global site tag (gtag.js) - Google Analytics -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-217353091-1"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}

{{--        gtag('config', 'UA-217353091-1');--}}
{{--    </script>--}}

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
                <li><a class="nav-link scrollto" href="/#hero">HOME</a></li>
                <li><a class="nav-link scrollto" href="/#about">QUOTE</a></li>
                @auth
                    @if ($logged_in_user->isUser())
                        <li><a class="nav-link " href="{{ route('frontend.user.dashboard') }}">DASHBOARD</a></li>
                    @endif

                    <li><a class="nav-link " href="{{ route('frontend.user.account') }}">ACCOUNT</a></li>
                @else


                    @if (config('boilerplate.access.user.registration'))
                        <li><a class="nav-link " href="{{ route('frontend.auth.register') }}">REGISTER</a></li>
                    @endif
                @endauth
                @guest
                    <li><a class="getstarted" href="{{ route('frontend.auth.login') }}">LOGIN</a></li>
                @endguest
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

                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-fan align-middle"></i><span class="pl-2">Vehicle</span></h3>
                            <p class="font-weight-bold">{{ $type }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-envelope align-middle"></i><span class="pl-3">Package/Pallets</span></h3>
                            <p class="font-weight-bold">{{ $pallet }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-geo-alt align-middle"></i><span class="pl-2">Delivery Route</span></h3>
                            <p>Pickup Time: <span class="font-weight-bold">{{ $time }}</span> on
                                <span class="font-weight-bold">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</span>
                                <br>
                                Drop Off Time: <span class="font-weight-bold">{{ $dropTime }}</span> on
                                <span class="font-weight-bold">{{ \Carbon\Carbon::parse($dropDate)->format('d/m/Y') }}</span>
                                <br>
                                Miles: <span class="font-weight-bold">{{ $miles }}</span>
                                <br>
                                Pickup: <span class="font-weight-bold">{{ $pickupPostcode }}</span>
                                Drop: <span class="font-weight-bold">{{ $dropoffPostcode }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-currency-pound align-middle"></i><span class="pl-1">Cost</span></h3>

                            @if($surcharge || $weekend_collection || $after_5 || $min_charge)
                                <p class="font-weight-bold">£{{ number_format((float)Cart::session(Auth::user()->id)->getTotal(), 2, '.', '') }}<span style="color: red">*</span></p>
                            @else
                                <p class="font-weight-bold">£{{ number_format((float)Cart::session(Auth::user()->id)->getTotal(), 2, '.', '') }}</p>
                            @endif
                            <small>Total Cost (Inc. VAT)</small>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-info-circle align-middle"></i><span class="pl-2">Booking Information</span></h3>
                            <p>Booking Ref: <span class="font-weight-bold">{{ $ref }}</span>
                                <br>
                                Pickup Contact: <span class="font-weight-bold">{{ $pickup_contact }}</span>
                                <br>
                                Delivery Contact: <span class="font-weight-bold">{{ $delivery_contact }}</span>
                                <br>
                                Delivery Information: <span class="font-weight-bold">{{ $delivery_info }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box text-center">
                            <h3><i class="bi bi-info-circle align-middle"></i><span class="pl-2">Booking Information</span></h3>
                            <p>Size: <span class="font-weight-bold">{{ $size }}</span>
                                <br>
                                Weight: <span class="font-weight-bold">{{ $weight }}</span>
                                <br>
                                Notes: <span class="font-weight-bold">{{ $notes }}</span>
                                <br>
                                Confirm that the delivery does not include any dangerous goods: <span class="font-weight-bold">{{ ($confirm == 1) ? 'Yes' : 'No' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                    <small><span style="color: red">*</span> Congestion Charge / Weekend Collection / Collection After 5pm / Minimum Charge has been applied</small>

            </div>


            <div class="col-lg-6">

                @if($payment)
                    <form
                        role="form"
                        action="/stripePost"
                        method="post"
                        class="require-validation php-email-form"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        id="payment-form">
                        @csrf
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group'>
                                <label class='control-label'>Email</label> <input
                                    class='form-control' name="email" value="{{ Auth::user()->email }}" size='4' type='text' readonly>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                                type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (£{{ number_format((float)Cart::session($userId)->getTotal(), 2, '.', '') }})</button>
                            </div>
                        </div>
                    </form>
                @else
                    <h3>Booking Confirmed, an email has been sent to you!</h3>
                @endif


            </div>

        </div>

    </div>

</section><!-- End Contact Section -->



<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

{{--    <div class="footer-top">--}}
{{--        <div class="container">--}}
{{--            <div class="row gy-4">--}}
{{--                <div class="col-lg-5 col-md-12 footer-info">--}}
{{--                    <a href="index.html" class="logo d-flex align-items-center">--}}
{{--                        <img src="assets/img/logo.webp" alt="">--}}
{{--                        <span>FlexStart</span>--}}
{{--                    </a>--}}
{{--                    <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>--}}
{{--                    <div class="social-links mt-3">--}}
{{--                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>--}}
{{--                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>--}}
{{--                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>--}}
{{--                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-6 footer-links">--}}
{{--                    <h4>Useful Links</h4>--}}
{{--                    <ul>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-6 footer-links">--}}
{{--                    <h4>Our Services</h4>--}}
{{--                    <ul>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>--}}
{{--                        <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">--}}
{{--                    <h4>Contact Us</h4>--}}
{{--                    <p>--}}
{{--                        A108 Adam Street <br>--}}
{{--                        New York, NY 535022<br>--}}
{{--                        United States <br><br>--}}
{{--                        <strong>Phone:</strong> +1 5589 55488 55<br>--}}
{{--                        <strong>Email:</strong> info@example.com<br>--}}
{{--                    </p>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="container">
        <div class="copyright">
            &copy; Copyright {{ \Carbon\Carbon::today()->format('Y') }}<strong><span> Group 4 Logistics</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Developed by <a href="https://cosbywebdevelopment.co.uk/">Cosby Web Development</a>
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

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('d-none');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>" +
                    "<input type='hidden' name='userId' value='{{ $userId }}'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

</body>

</html>
