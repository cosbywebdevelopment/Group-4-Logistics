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

    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css' rel='stylesheet' />
{{--    <script src='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js'></script>--}}
{{--    <link href='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css' rel='stylesheet' />--}}

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
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Quote Tool</a></li>
{{--          <li><a class="nav-link scrollto" href="#services">Services</a></li>--}}
{{--          <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>--}}
{{--          <li><a class="nav-link scrollto" href="#team">Team</a></li>--}}
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
{{--          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>--}}
{{--          <li>--}}
{{--              <a class="nav-link scrollto" href="/checkout">Checkout</a>--}}
{{--          </li>--}}
          <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        @include('includes.partials.messages')
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <h1 style="color: #9b9a9d" data-aos="fade-up">A <span style="color: #fc8a18">TO</span> B
              BUSINESS
              SOLUTIONS</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Local & International Delivery</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Quote</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="/assets/img/vehicles/7.5 Tonne.jpg" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>with our instant quote tool you can be sure what you'll be paying</h3>
                <form id="quote_form">
                    <div class="row">
                        <div class="mb-3 col-lg-9">
                            <label for="exampleFormControlInput1" class="form-label text-capitalize">pick up from</label>
                            <input type="text" class="form-control" id="geoPickup" placeholder="Type Your Address" required>
                        </div>
                        <div class="mb-3 col-lg-9">
                            <label for="exampleFormControlInput1" class="form-label text-capitalize">drop off at</label>
                            <input type="text" class="form-control" id="geoDropOff" placeholder="Type Your Address" required>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="exampleFormControlInput1" class="form-label text-capitalize">pick up time</label>
                            <input id="pickup_time" type="time" class="form-control" required>
                        </div>
                        <div class="mb-3 col-lg-5">
                            <label for="exampleFormControlInput1" class="form-label text-capitalize">pick up date</label>
                            <input id="pickup_date" type="date" class="form-control" required>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label for="exampleFormControlInput1" class="form-label text-capitalize">drop off time</label>
                            <input id="drop_off_time" type="time" class="form-control" required>
                        </div>
                        <div class="mb-3 col-lg-5">
                            <label for="exampleFormControlInput1" class="form-label text-capitalize">drop off date</label>
                            <input id="drop_off_date" type="date" class="form-control" required>
                        </div>
                    </div>

              <div class="text-center text-lg-start">
                  <button id="quote" type="submit" class="btn btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                      <span>Quote Me!</span>
                      <i class="bi bi-cash-coin"></i>
                  </button>
              </div>
                </form>
                <div class="mt-3 text-center">
                    <button id="clear_map" type="button" class="btn btn-outline-primary">
                        <span>Clear Map!</span>
                    </button>
                </div>

            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
{{--            <img src="assets/img/quote.png" class="img-fluid" alt="">--}}
              <div id='map' style='width: 500px; height: 400px;'></div>
          </div>
        </div>
      </div>
    </section>

        <section id="vehicle" class="testimonials">
          <div id="vehicles" class="container" style="display: none">

              <header class="section-header">
                  <p>Choose your vehicle</p>
              </header>

              <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                  <div class="swiper-wrapper">
                      @foreach($vehicle as $vehicles)
                          <div class="swiper-slide vehicleModal"
                               data-type="{{ $vehicles->type }}"
                               data-id="{{ $vehicles->id }}"
                               data-mileage-cost="{{ $vehicles->per_mile }}"
                               data-max-weight="{{ $vehicles->max_weight }}"
                               data-pallets="{{ $vehicles->pallets }}"
                               data-min-charge="{{ $vehicles->min_charge }}"
                          >
                              <div class="testimonial-item">
                                  <p>Length: @if($vehicles->length == 0.00) 'N/A' @else {{$vehicles->length}}m @endif</p>
                                  <p>Height: @if($vehicles->height == 0.00) 'N/A' @else {{$vehicles->height}}m @endif</p>
                                  <p>Width: @if($vehicles->width == 0.00) 'N/A' @else {{$vehicles->width}}m @endif</p>
                                  <p>Payload: {{ $vehicles->pallets }}</p>
                                  <p>Max Weight: {{ $vehicles->weight }}</p>
                                  <div class="profile mt-auto">
                                      <img width="250px" src="assets/img/vehicles/{{ $vehicles->type }}.jpg" class="" alt="">
                                      <h3>{{ $vehicles->type }}</h3>
                                      <h4></h4>
                                  </div>
                              </div>
                          </div><!-- End testimonial item -->
                      @endforeach
                  </div>
                  <!-- If we need navigation buttons -->
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
              </div>

          </div>
    </section><!-- End About Section -->
{{--    <!-- ======= Values Section ======= -->--}}
{{--    <section id="values" class="values">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Our Values</h2>--}}
{{--          <p>Odit est perspiciatis laborum et dicta</p>--}}
{{--        </header>--}}

{{--        <div class="row">--}}

{{--          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">--}}
{{--            <div class="box">--}}
{{--              <img src="assets/img/values-1.png" class="img-fluid" alt="">--}}
{{--              <h3>Ad cupiditate sed est odio</h3>--}}
{{--              <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">--}}
{{--            <div class="box">--}}
{{--              <img src="assets/img/values-2.png" class="img-fluid" alt="">--}}
{{--              <h3>Voluptatem voluptatum alias</h3>--}}
{{--              <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">--}}
{{--            <div class="box">--}}
{{--              <img src="assets/img/values-3.png" class="img-fluid" alt="">--}}
{{--              <h3>Fugit cupiditate alias nobis.</h3>--}}
{{--              <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Values Section -->--}}

{{--    <!-- ======= Counts Section ======= -->--}}
{{--    <section id="counts" class="counts">--}}
{{--      <div class="container" data-aos="fade-up">--}}

{{--        <div class="row gy-4">--}}

{{--          <div class="col-lg-3 col-md-6">--}}
{{--            <div class="count-box">--}}
{{--              <i class="bi bi-emoji-smile"></i>--}}
{{--              <div>--}}
{{--                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>--}}
{{--                <p>Happy Clients</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6">--}}
{{--            <div class="count-box">--}}
{{--              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>--}}
{{--              <div>--}}
{{--                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>--}}
{{--                <p>Projects</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6">--}}
{{--            <div class="count-box">--}}
{{--              <i class="bi bi-headset" style="color: #15be56;"></i>--}}
{{--              <div>--}}
{{--                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>--}}
{{--                <p>Hours Of Support</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6">--}}
{{--            <div class="count-box">--}}
{{--              <i class="bi bi-people" style="color: #bb0852;"></i>--}}
{{--              <div>--}}
{{--                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>--}}
{{--                <p>Hard Workers</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}
{{--    </section><!-- End Counts Section -->--}}

{{--    <!-- ======= Features Section ======= -->--}}
{{--    <section id="features" class="features">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Features</h2>--}}
{{--          <p>Laboriosam et omnis fuga quis dolor direda fara</p>--}}
{{--        </header>--}}

{{--        <div class="row">--}}

{{--          <div class="col-lg-6">--}}
{{--            <img src="assets/img/features.png" class="img-fluid" alt="">--}}
{{--          </div>--}}

{{--          <div class="col-lg-6 mt-5 mt-lg-0 d-flex">--}}
{{--            <div class="row align-self-center gy-4">--}}

{{--              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">--}}
{{--                <div class="feature-box d-flex align-items-center">--}}
{{--                  <i class="bi bi-check"></i>--}}
{{--                  <h3>Eos aspernatur rem</h3>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">--}}
{{--                <div class="feature-box d-flex align-items-center">--}}
{{--                  <i class="bi bi-check"></i>--}}
{{--                  <h3>Facilis neque ipsa</h3>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">--}}
{{--                <div class="feature-box d-flex align-items-center">--}}
{{--                  <i class="bi bi-check"></i>--}}
{{--                  <h3>Volup amet voluptas</h3>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">--}}
{{--                <div class="feature-box d-flex align-items-center">--}}
{{--                  <i class="bi bi-check"></i>--}}
{{--                  <h3>Rerum omnis sint</h3>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">--}}
{{--                <div class="feature-box d-flex align-items-center">--}}
{{--                  <i class="bi bi-check"></i>--}}
{{--                  <h3>Alias possimus</h3>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">--}}
{{--                <div class="feature-box d-flex align-items-center">--}}
{{--                  <i class="bi bi-check"></i>--}}
{{--                  <h3>Repellendus mollitia</h3>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}

{{--        </div> <!-- / row -->--}}

{{--        <!-- Feature Tabs -->--}}
{{--        <div class="row feture-tabs" data-aos="fade-up">--}}
{{--          <div class="col-lg-6">--}}
{{--            <h3>Neque officiis dolore maiores et exercitationem quae est seda lidera pat claero</h3>--}}

{{--            <!-- Tabs -->--}}
{{--            <ul class="nav nav-pills mb-3">--}}
{{--              <li>--}}
{{--                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Saepe fuga</a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <a class="nav-link" data-bs-toggle="pill" href="#tab2">Voluptates</a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <a class="nav-link" data-bs-toggle="pill" href="#tab3">Corrupti</a>--}}
{{--              </li>--}}
{{--            </ul><!-- End Tabs -->--}}

{{--            <!-- Tab Content -->--}}
{{--            <div class="tab-content">--}}

{{--              <div class="tab-pane fade show active" id="tab1">--}}
{{--                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>--}}
{{--                <div class="d-flex align-items-center mb-2">--}}
{{--                  <i class="bi bi-check2"></i>--}}
{{--                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>--}}
{{--                </div>--}}
{{--                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non eveniet magni quaerat nemo et.</p>--}}
{{--                <div class="d-flex align-items-center mb-2">--}}
{{--                  <i class="bi bi-check2"></i>--}}
{{--                  <h4>Incidunt non veritatis illum ea ut nisi</h4>--}}
{{--                </div>--}}
{{--                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>--}}
{{--              </div><!-- End Tab 1 Content -->--}}

{{--              <div class="tab-pane fade show" id="tab2">--}}
{{--                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>--}}
{{--                <div class="d-flex align-items-center mb-2">--}}
{{--                  <i class="bi bi-check2"></i>--}}
{{--                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>--}}
{{--                </div>--}}
{{--                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non eveniet magni quaerat nemo et.</p>--}}
{{--                <div class="d-flex align-items-center mb-2">--}}
{{--                  <i class="bi bi-check2"></i>--}}
{{--                  <h4>Incidunt non veritatis illum ea ut nisi</h4>--}}
{{--                </div>--}}
{{--                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>--}}
{{--              </div><!-- End Tab 2 Content -->--}}

{{--              <div class="tab-pane fade show" id="tab3">--}}
{{--                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>--}}
{{--                <div class="d-flex align-items-center mb-2">--}}
{{--                  <i class="bi bi-check2"></i>--}}
{{--                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>--}}
{{--                </div>--}}
{{--                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non eveniet magni quaerat nemo et.</p>--}}
{{--                <div class="d-flex align-items-center mb-2">--}}
{{--                  <i class="bi bi-check2"></i>--}}
{{--                  <h4>Incidunt non veritatis illum ea ut nisi</h4>--}}
{{--                </div>--}}
{{--                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>--}}
{{--              </div><!-- End Tab 3 Content -->--}}

{{--            </div>--}}

{{--          </div>--}}

{{--          <div class="col-lg-6">--}}
{{--            <img src="assets/img/features-2.png" class="img-fluid" alt="">--}}
{{--          </div>--}}

{{--        </div><!-- End Feature Tabs -->--}}

{{--        <!-- Feature Icons -->--}}
{{--        <div class="row feature-icons" data-aos="fade-up">--}}
{{--          <h3>Ratione mollitia eos ab laudantium rerum beatae quo</h3>--}}

{{--          <div class="row">--}}

{{--            <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">--}}
{{--              <img src="assets/img/features-3.png" class="img-fluid p-4" alt="">--}}
{{--            </div>--}}

{{--            <div class="col-xl-8 d-flex content">--}}
{{--              <div class="row align-self-center gy-4">--}}

{{--                <div class="col-md-6 icon-box" data-aos="fade-up">--}}
{{--                  <i class="ri-line-chart-line"></i>--}}
{{--                  <div>--}}
{{--                    <h4>Corporis voluptates sit</h4>--}}
{{--                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">--}}
{{--                  <i class="ri-stack-line"></i>--}}
{{--                  <div>--}}
{{--                    <h4>Ullamco laboris nisi</h4>--}}
{{--                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">--}}
{{--                  <i class="ri-brush-4-line"></i>--}}
{{--                  <div>--}}
{{--                    <h4>Labore consequatur</h4>--}}
{{--                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">--}}
{{--                  <i class="ri-magic-line"></i>--}}
{{--                  <div>--}}
{{--                    <h4>Beatae veritatis</h4>--}}
{{--                    <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">--}}
{{--                  <i class="ri-command-line"></i>--}}
{{--                  <div>--}}
{{--                    <h4>Molestiae dolor</h4>--}}
{{--                    <p>Et fuga et deserunt et enim. Dolorem architecto ratione tensa raptor marte</p>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">--}}
{{--                  <i class="ri-radar-line"></i>--}}
{{--                  <div>--}}
{{--                    <h4>Explicabo consectetur</h4>--}}
{{--                    <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>--}}
{{--                  </div>--}}
{{--                </div>--}}

{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--        </div><!-- End Feature Icons -->--}}

{{--      </div>--}}

{{--    </section><!-- End Features Section -->--}}

{{--    <!-- ======= Services Section ======= -->--}}
{{--    <section id="services" class="services">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Services</h2>--}}
{{--          <p>Veritatis et dolores facere numquam et praesentium</p>--}}
{{--        </header>--}}

{{--        <div class="row gy-4">--}}

{{--          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">--}}
{{--            <div class="service-box blue">--}}
{{--              <i class="ri-discuss-line icon"></i>--}}
{{--              <h3>Nesciunt Mete</h3>--}}
{{--              <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>--}}
{{--              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">--}}
{{--            <div class="service-box orange">--}}
{{--              <i class="ri-discuss-line icon"></i>--}}
{{--              <h3>Eosle Commodi</h3>--}}
{{--              <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>--}}
{{--              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">--}}
{{--            <div class="service-box green">--}}
{{--              <i class="ri-discuss-line icon"></i>--}}
{{--              <h3>Ledo Markt</h3>--}}
{{--              <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>--}}
{{--              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">--}}
{{--            <div class="service-box red">--}}
{{--              <i class="ri-discuss-line icon"></i>--}}
{{--              <h3>Asperiores Commodi</h3>--}}
{{--              <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>--}}
{{--              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">--}}
{{--            <div class="service-box purple">--}}
{{--              <i class="ri-discuss-line icon"></i>--}}
{{--              <h3>Velit Doloremque.</h3>--}}
{{--              <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>--}}
{{--              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">--}}
{{--            <div class="service-box pink">--}}
{{--              <i class="ri-discuss-line icon"></i>--}}
{{--              <h3>Dolori Architecto</h3>--}}
{{--              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>--}}
{{--              <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Services Section -->--}}

{{--    <!-- ======= Pricing Section ======= -->--}}
{{--    <section id="pricing" class="pricing">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Pricing</h2>--}}
{{--          <p>Check our Pricing</p>--}}
{{--        </header>--}}

{{--        <div class="row gy-4" data-aos="fade-left">--}}

{{--          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">--}}
{{--            <div class="box">--}}
{{--              <h3 style="color: #07d5c0;">Free Plan</h3>--}}
{{--              <div class="price"><sup>$</sup>0<span> / mo</span></div>--}}
{{--              <img src="assets/img/pricing-free.png" class="img-fluid" alt="">--}}
{{--              <ul>--}}
{{--                <li>Aida dere</li>--}}
{{--                <li>Nec feugiat nisl</li>--}}
{{--                <li>Nulla at volutpat dola</li>--}}
{{--                <li class="na">Pharetra massa</li>--}}
{{--                <li class="na">Massa ultricies mi</li>--}}
{{--              </ul>--}}
{{--              <a href="#" class="btn-buy">Buy Now</a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">--}}
{{--            <div class="box">--}}
{{--              <span class="featured">Featured</span>--}}
{{--              <h3 style="color: #65c600;">Starter Plan</h3>--}}
{{--              <div class="price"><sup>$</sup>19<span> / mo</span></div>--}}
{{--              <img src="assets/img/pricing-starter.png" class="img-fluid" alt="">--}}
{{--              <ul>--}}
{{--                <li>Aida dere</li>--}}
{{--                <li>Nec feugiat nisl</li>--}}
{{--                <li>Nulla at volutpat dola</li>--}}
{{--                <li>Pharetra massa</li>--}}
{{--                <li class="na">Massa ultricies mi</li>--}}
{{--              </ul>--}}
{{--              <a href="#" class="btn-buy">Buy Now</a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">--}}
{{--            <div class="box">--}}
{{--              <h3 style="color: #ff901c;">Business Plan</h3>--}}
{{--              <div class="price"><sup>$</sup>29<span> / mo</span></div>--}}
{{--              <img src="assets/img/pricing-business.png" class="img-fluid" alt="">--}}
{{--              <ul>--}}
{{--                <li>Aida dere</li>--}}
{{--                <li>Nec feugiat nisl</li>--}}
{{--                <li>Nulla at volutpat dola</li>--}}
{{--                <li>Pharetra massa</li>--}}
{{--                <li>Massa ultricies mi</li>--}}
{{--              </ul>--}}
{{--              <a href="#" class="btn-buy">Buy Now</a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">--}}
{{--            <div class="box">--}}
{{--              <h3 style="color: #ff0071;">Ultimate Plan</h3>--}}
{{--              <div class="price"><sup>$</sup>49<span> / mo</span></div>--}}
{{--              <img src="assets/img/pricing-ultimate.png" class="img-fluid" alt="">--}}
{{--              <ul>--}}
{{--                <li>Aida dere</li>--}}
{{--                <li>Nec feugiat nisl</li>--}}
{{--                <li>Nulla at volutpat dola</li>--}}
{{--                <li>Pharetra massa</li>--}}
{{--                <li>Massa ultricies mi</li>--}}
{{--              </ul>--}}
{{--              <a href="#" class="btn-buy">Buy Now</a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Pricing Section -->--}}

{{--    <!-- ======= F.A.Q Section ======= -->--}}
{{--    <section id="faq" class="faq">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>F.A.Q</h2>--}}
{{--          <p>Frequently Asked Questions</p>--}}
{{--        </header>--}}

{{--        <div class="row">--}}
{{--          <div class="col-lg-6">--}}
{{--            <!-- F.A.Q List 1-->--}}
{{--            <div class="accordion accordion-flush" id="faqlist1">--}}
{{--              <div class="accordion-item">--}}
{{--                <h2 class="accordion-header">--}}
{{--                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">--}}
{{--                    Non consectetur a erat nam at lectus urna duis?--}}
{{--                  </button>--}}
{{--                </h2>--}}
{{--                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">--}}
{{--                  <div class="accordion-body">--}}
{{--                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="accordion-item">--}}
{{--                <h2 class="accordion-header">--}}
{{--                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">--}}
{{--                    Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?--}}
{{--                  </button>--}}
{{--                </h2>--}}
{{--                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">--}}
{{--                  <div class="accordion-body">--}}
{{--                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="accordion-item">--}}
{{--                <h2 class="accordion-header">--}}
{{--                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">--}}
{{--                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?--}}
{{--                  </button>--}}
{{--                </h2>--}}
{{--                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">--}}
{{--                  <div class="accordion-body">--}}
{{--                    Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-6">--}}

{{--            <!-- F.A.Q List 2-->--}}
{{--            <div class="accordion accordion-flush" id="faqlist2">--}}

{{--              <div class="accordion-item">--}}
{{--                <h2 class="accordion-header">--}}
{{--                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">--}}
{{--                    Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?--}}
{{--                  </button>--}}
{{--                </h2>--}}
{{--                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">--}}
{{--                  <div class="accordion-body">--}}
{{--                    Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="accordion-item">--}}
{{--                <h2 class="accordion-header">--}}
{{--                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">--}}
{{--                    Tempus quam pellentesque nec nam aliquam sem et tortor consequat?--}}
{{--                  </button>--}}
{{--                </h2>--}}
{{--                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">--}}
{{--                  <div class="accordion-body">--}}
{{--                    Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--              <div class="accordion-item">--}}
{{--                <h2 class="accordion-header">--}}
{{--                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">--}}
{{--                    Varius vel pharetra vel turpis nunc eget lorem dolor?--}}
{{--                  </button>--}}
{{--                </h2>--}}
{{--                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">--}}
{{--                  <div class="accordion-body">--}}
{{--                    Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}

{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End F.A.Q Section -->--}}

{{--    <!-- ======= Portfolio Section ======= -->--}}
{{--    <section id="portfolio" class="portfolio">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Portfolio</h2>--}}
{{--          <p>Check our latest work</p>--}}
{{--        </header>--}}

{{--        <div class="row" data-aos="fade-up" data-aos-delay="100">--}}
{{--          <div class="col-lg-12 d-flex justify-content-center">--}}
{{--            <ul id="portfolio-flters">--}}
{{--              <li data-filter="*" class="filter-active">All</li>--}}
{{--              <li data-filter=".filter-app">App</li>--}}
{{--              <li data-filter=".filter-card">Card</li>--}}
{{--              <li data-filter=".filter-web">Web</li>--}}
{{--            </ul>--}}
{{--          </div>--}}
{{--        </div>--}}

{{--        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-app">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>App 1</h4>--}}
{{--                <p>App</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-web">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>Web 3</h4>--}}
{{--                <p>Web</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-app">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>App 2</h4>--}}
{{--                <p>App</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 2"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-card">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>Card 2</h4>--}}
{{--                <p>Card</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Card 2"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-web">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>Web 2</h4>--}}
{{--                <p>Web</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Web 2"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-app">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>App 3</h4>--}}
{{--                <p>App</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 3"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-card">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>Card 1</h4>--}}
{{--                <p>Card</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Card 1"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-card">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>Card 3</h4>--}}
{{--                <p>Card</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Card 3"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4 col-md-6 portfolio-item filter-web">--}}
{{--            <div class="portfolio-wrap">--}}
{{--              <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">--}}
{{--              <div class="portfolio-info">--}}
{{--                <h4>Web 3</h4>--}}
{{--                <p>Web</p>--}}
{{--                <div class="portfolio-links">--}}
{{--                  <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>--}}
{{--                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Portfolio Section -->--}}

{{--    <!-- ======= Testimonials Section ======= -->--}}
{{--    <section id="testimonials" class="testimonials">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Testimonials</h2>--}}
{{--          <p>What they are saying about us</p>--}}
{{--        </header>--}}

{{--        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">--}}
{{--          <div class="swiper-wrapper">--}}

{{--            <div class="swiper-slide">--}}
{{--              <div class="testimonial-item">--}}
{{--                <div class="stars">--}}
{{--                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>--}}
{{--                </div>--}}
{{--                <p>--}}
{{--                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.--}}
{{--                </p>--}}
{{--                <div class="profile mt-auto">--}}
{{--                  <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">--}}
{{--                  <h3>Saul Goodman</h3>--}}
{{--                  <h4>Ceo &amp; Founder</h4>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div><!-- End testimonial item -->--}}

{{--            <div class="swiper-slide">--}}
{{--              <div class="testimonial-item">--}}
{{--                <div class="stars">--}}
{{--                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>--}}
{{--                </div>--}}
{{--                <p>--}}
{{--                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.--}}
{{--                </p>--}}
{{--                <div class="profile mt-auto">--}}
{{--                  <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">--}}
{{--                  <h3>Sara Wilsson</h3>--}}
{{--                  <h4>Designer</h4>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div><!-- End testimonial item -->--}}

{{--            <div class="swiper-slide">--}}
{{--              <div class="testimonial-item">--}}
{{--                <div class="stars">--}}
{{--                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>--}}
{{--                </div>--}}
{{--                <p>--}}
{{--                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.--}}
{{--                </p>--}}
{{--                <div class="profile mt-auto">--}}
{{--                  <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">--}}
{{--                  <h3>Jena Karlis</h3>--}}
{{--                  <h4>Store Owner</h4>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div><!-- End testimonial item -->--}}

{{--            <div class="swiper-slide">--}}
{{--              <div class="testimonial-item">--}}
{{--                <div class="stars">--}}
{{--                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>--}}
{{--                </div>--}}
{{--                <p>--}}
{{--                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.--}}
{{--                </p>--}}
{{--                <div class="profile mt-auto">--}}
{{--                  <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">--}}
{{--                  <h3>Matt Brandon</h3>--}}
{{--                  <h4>Freelancer</h4>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div><!-- End testimonial item -->--}}

{{--            <div class="swiper-slide">--}}
{{--              <div class="testimonial-item">--}}
{{--                <div class="stars">--}}
{{--                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>--}}
{{--                </div>--}}
{{--                <p>--}}
{{--                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.--}}
{{--                </p>--}}
{{--                <div class="profile mt-auto">--}}
{{--                  <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">--}}
{{--                  <h3>John Larson</h3>--}}
{{--                  <h4>Entrepreneur</h4>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div><!-- End testimonial item -->--}}

{{--          </div>--}}
{{--          <div class="swiper-pagination"></div>--}}
{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Testimonials Section -->--}}

{{--    <!-- ======= Team Section ======= -->--}}
{{--    <section id="team" class="team">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Team</h2>--}}
{{--          <p>Our hard working team</p>--}}
{{--        </header>--}}

{{--        <div class="row gy-4">--}}

{{--          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">--}}
{{--            <div class="member">--}}
{{--              <div class="member-img">--}}
{{--                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">--}}
{{--                <div class="social">--}}
{{--                  <a href=""><i class="bi bi-twitter"></i></a>--}}
{{--                  <a href=""><i class="bi bi-facebook"></i></a>--}}
{{--                  <a href=""><i class="bi bi-instagram"></i></a>--}}
{{--                  <a href=""><i class="bi bi-linkedin"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="member-info">--}}
{{--                <h4>Walter White</h4>--}}
{{--                <span>Chief Executive Officer</span>--}}
{{--                <p>Velit aut quia fugit et et. Dolorum ea voluptate vel tempore tenetur ipsa quae aut. Ipsum exercitationem iure minima enim corporis et voluptate.</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">--}}
{{--            <div class="member">--}}
{{--              <div class="member-img">--}}
{{--                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">--}}
{{--                <div class="social">--}}
{{--                  <a href=""><i class="bi bi-twitter"></i></a>--}}
{{--                  <a href=""><i class="bi bi-facebook"></i></a>--}}
{{--                  <a href=""><i class="bi bi-instagram"></i></a>--}}
{{--                  <a href=""><i class="bi bi-linkedin"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="member-info">--}}
{{--                <h4>Sarah Jhonson</h4>--}}
{{--                <span>Product Manager</span>--}}
{{--                <p>Quo esse repellendus quia id. Est eum et accusantium pariatur fugit nihil minima suscipit corporis. Voluptate sed quas reiciendis animi neque sapiente.</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">--}}
{{--            <div class="member">--}}
{{--              <div class="member-img">--}}
{{--                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">--}}
{{--                <div class="social">--}}
{{--                  <a href=""><i class="bi bi-twitter"></i></a>--}}
{{--                  <a href=""><i class="bi bi-facebook"></i></a>--}}
{{--                  <a href=""><i class="bi bi-instagram"></i></a>--}}
{{--                  <a href=""><i class="bi bi-linkedin"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="member-info">--}}
{{--                <h4>William Anderson</h4>--}}
{{--                <span>CTO</span>--}}
{{--                <p>Vero omnis enim consequatur. Voluptas consectetur unde qui molestiae deserunt. Voluptates enim aut architecto porro aspernatur molestiae modi.</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">--}}
{{--            <div class="member">--}}
{{--              <div class="member-img">--}}
{{--                <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">--}}
{{--                <div class="social">--}}
{{--                  <a href=""><i class="bi bi-twitter"></i></a>--}}
{{--                  <a href=""><i class="bi bi-facebook"></i></a>--}}
{{--                  <a href=""><i class="bi bi-instagram"></i></a>--}}
{{--                  <a href=""><i class="bi bi-linkedin"></i></a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="member-info">--}}
{{--                <h4>Amanda Jepson</h4>--}}
{{--                <span>Accountant</span>--}}
{{--                <p>Rerum voluptate non adipisci animi distinctio et deserunt amet voluptas. Quia aut aliquid doloremque ut possimus ipsum officia.</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Team Section -->--}}

{{--    <!-- ======= Clients Section ======= -->--}}
{{--    <section id="clients" class="clients">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Our Clients</h2>--}}
{{--          <p>Temporibus omnis officia</p>--}}
{{--        </header>--}}

{{--        <div class="clients-slider swiper">--}}
{{--          <div class="swiper-wrapper align-items-center">--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>--}}
{{--            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>--}}
{{--          </div>--}}
{{--          <div class="swiper-pagination"></div>--}}
{{--        </div>--}}
{{--      </div>--}}

{{--    </section><!-- End Clients Section -->--}}

{{--    <!-- ======= Recent Blog Posts Section ======= -->--}}
{{--    <section id="recent-blog-posts" class="recent-blog-posts">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Blog</h2>--}}
{{--          <p>Recent posts form our Blog</p>--}}
{{--        </header>--}}

{{--        <div class="row">--}}

{{--          <div class="col-lg-4">--}}
{{--            <div class="post-box">--}}
{{--              <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>--}}
{{--              <span class="post-date">Tue, September 15</span>--}}
{{--              <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit</h3>--}}
{{--              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4">--}}
{{--            <div class="post-box">--}}
{{--              <div class="post-img"><img src="assets/img/blog/blog-2.jpg" class="img-fluid" alt=""></div>--}}
{{--              <span class="post-date">Fri, August 28</span>--}}
{{--              <h3 class="post-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>--}}
{{--              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-4">--}}
{{--            <div class="post-box">--}}
{{--              <div class="post-img"><img src="assets/img/blog/blog-3.jpg" class="img-fluid" alt=""></div>--}}
{{--              <span class="post-date">Mon, July 11</span>--}}
{{--              <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>--}}
{{--              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Recent Blog Posts Section -->--}}

{{--    <!-- ======= Contact Section ======= -->--}}
{{--    <section id="contact" class="contact">--}}

{{--      <div class="container" data-aos="fade-up">--}}

{{--        <header class="section-header">--}}
{{--          <h2>Contact</h2>--}}
{{--          <p>Contact Us</p>--}}
{{--        </header>--}}

{{--        <div class="row gy-4">--}}

{{--          <div class="col-lg-6">--}}

{{--            <div class="row gy-4">--}}
{{--              <div class="col-md-6">--}}
{{--                <div class="info-box">--}}
{{--                  <i class="bi bi-geo-alt"></i>--}}
{{--                  <h3>Address</h3>--}}
{{--                  <p>A108 Adam Street,<br>New York, NY 535022</p>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="col-md-6">--}}
{{--                <div class="info-box">--}}
{{--                  <i class="bi bi-telephone"></i>--}}
{{--                  <h3>Call Us</h3>--}}
{{--                  <p>+1 5589 55488 55<br>+1 6678 254445 41</p>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="col-md-6">--}}
{{--                <div class="info-box">--}}
{{--                  <i class="bi bi-envelope"></i>--}}
{{--                  <h3>Email Us</h3>--}}
{{--                  <p>info@example.com<br>contact@example.com</p>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="col-md-6">--}}
{{--                <div class="info-box">--}}
{{--                  <i class="bi bi-clock"></i>--}}
{{--                  <h3>Open Hours</h3>--}}
{{--                  <p>Monday - Friday<br>9:00AM - 05:00PM</p>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--          </div>--}}

{{--          <div class="col-lg-6">--}}
{{--            <form action="forms/contact.php" method="post" class="php-email-form">--}}
{{--              <div class="row gy-4">--}}

{{--                <div class="col-md-6">--}}
{{--                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>--}}
{{--                </div>--}}

{{--                <div class="col-md-6 ">--}}
{{--                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>--}}
{{--                </div>--}}

{{--                <div class="col-md-12 text-center">--}}
{{--                  <div class="loading">Loading</div>--}}
{{--                  <div class="error-message"></div>--}}
{{--                  <div class="sent-message">Your message has been sent. Thank you!</div>--}}

{{--                  <button type="submit">Send Message</button>--}}
{{--                </div>--}}

{{--              </div>--}}
{{--            </form>--}}

{{--          </div>--}}

{{--        </div>--}}

{{--      </div>--}}

{{--    </section><!-- End Contact Section -->--}}

      <!-- Modal -->
      <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="">Your selection</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/checkoutPost" method="post">
                      @csrf
                      <input id="miles_input" name="miles_input" hidden>
                      <input id="id_input" name="type_id" hidden>
                      <input id="type_input" name="type_input" hidden>
                      <input id="time_input" name="time_input" hidden>
                      <input id="date_input" name="date_input" hidden>
                      <input id="time_off_input" name="time_off_input" hidden>
                      <input id="date_off_input" name="date_off_input" hidden>
                      <input id="pickup_input" name="pickup_input" hidden>
                      <input id="dropoff_input" name="dropoff_input" hidden>
                      <input id="pickup_postcode_input" name="pickup_postcode_input" hidden>
                      <input id="drop_off_postcode_input" name="drop_off_postcode_input" hidden>
                      <div class="modal-body">
                          <h3>You have chosen a <span id="typeLabel"></span> which can take a load of upto <span id="max_weight"></span></h3>
                          <h4>Your Route Mileage: <span id="miles"></span></h4>
                          <h4>Cost From <span id="cost"></span> +VAT</h4>
                          <h4>pickup Time <span id="time"></span> Date <span id="date"></span></h4>
                          <h4>Drop Off Time <span id="drop_time"></span> Date <span id="drop_date"></span></h4>
                          <p>Click the "Checkout" button to book.</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" style="background: #fc8a18; border-color: #fc8a18">Checkout</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="">Please Login or Register</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                      <a class="btn btn-secondary" href="/register">Register</a>
                      <a class="btn btn-primary" href="/login">Login</a>
                  </div>
              </div>
          </div>
      </div>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

{{--    <div class="footer-newsletter">--}}
{{--      <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--          <div class="col-lg-12 text-center">--}}
{{--            <h4>Our Newsletter</h4>--}}
{{--            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>--}}
{{--          </div>--}}
{{--          <div class="col-lg-6">--}}
{{--            <form action="" method="post">--}}
{{--              <input type="email" name="email"><input type="submit" value="Subscribe">--}}
{{--            </form>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}

{{--    <div class="footer-top">--}}
{{--      <div class="container">--}}
{{--        <div class="row gy-4">--}}
{{--          <div class="col-lg-5 col-md-12 footer-info">--}}
{{--            <a href="index.html" class="logo d-flex align-items-center">--}}
{{--              <img src="assets/img/logo.webp" alt="">--}}
{{--              <span>Group 4 Logistics</span>--}}
{{--            </a>--}}
{{--            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>--}}
{{--            <div class="social-links mt-3">--}}
{{--              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>--}}
{{--              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>--}}
{{--              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>--}}
{{--              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>--}}
{{--            </div>--}}
{{--          </div>--}}

{{--          <div class="col-lg-2 col-6 footer-links">--}}
{{--            <h4>Useful Links</h4>--}}
{{--            <ul>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>--}}
{{--            </ul>--}}
{{--          </div>--}}

{{--          <div class="col-lg-2 col-6 footer-links">--}}
{{--            <h4>Our Services</h4>--}}
{{--            <ul>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>--}}
{{--              <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>--}}
{{--            </ul>--}}
{{--          </div>--}}

{{--          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">--}}
{{--            <h4>Contact Us</h4>--}}
{{--            <p>--}}
{{--              A108 Adam Street <br>--}}
{{--              New York, NY 535022<br>--}}
{{--              United States <br><br>--}}
{{--              <strong>Phone:</strong> +1 5589 55488 55<br>--}}
{{--              <strong>Email:</strong> info@example.com<br>--}}
{{--            </p>--}}

{{--          </div>--}}

{{--        </div>--}}
{{--      </div>--}}
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

<script>
    let autoPickup;
    let autoDropOff;
    let geoPickupLat;
    let geoPickupLong;
    let geoDropOffLat;
    let geoDropOffLong;
    let pickupTime;
    let pickupDate;
    let dropOffTime;
    let dropOffDate;
    let miles = 0;
    let pickupPostcode;
    let dropOffPostcode;

    $('.vehicleModal').click(function(event) {
        let type = $(this).data('type');
        let id = $(this).data('id');
        let mileageCost = $(this).data('mileage-cost');
        let maxWeight = $(this).data('max-weight');
        let pallets = $(this).data('pallets');
        let minCharge = $(this).data('min-charge');
        let cost = miles.toFixed(2) * mileageCost;
        //console.log(cost)
        if(cost < minCharge){
            cost = minCharge
            cost = Number(cost)
        }
        $("#pickup_input").val($("#geoPickup").val() + ', ' + pickupPostcode)
        $("#dropoff_input").val($("#geoDropOff").val()+ ', ' + dropOffPostcode)
        $("#pickup_postcode_input").val(pickupPostcode)
        $("#drop_off_postcode_input").val(dropOffPostcode)
        $("#time_input").val(pickupTime)
        $("#date_input").val(pickupDate)
        $("#time_off_input").val(dropOffTime)
        $("#date_off_input").val(dropOffDate)
        $("#typeLabel").text(type);
        $("#type_input").val(type);
        $("#id_input").val(id);
        $("#mileage_cost").text(mileageCost);
        $("#max_weight").text(maxWeight);
        $("#pallets").text(pallets);
        $("#time").text(pickupTime);
        $("#date").text(pickupDate);
        $("#drop_time").text(dropOffTime);
        $("#drop_date").text(dropOffDate);
        $("#miles").text(miles.toFixed(2));
        $("#miles_input").val(miles.toFixed(2));
        $("#cost").text('£' + cost.toFixed(2));
        $('#vehicleModal').modal('show');
    });

    $("#clear_map").click(function (){
        location.reload();
        // let offset = 60;
        // // Our scroll target : the top position of the
        // let target = $('#about').offset().top - offset;
    })

    @auth
        @if ($logged_in_user->isUser())

            $("#quote_form").submit(function (e){
                e.preventDefault()

                // set pick up time and date
                pickupTime = $("#pickup_time").val()
                pickupDate = $("#pickup_date").val()
                dropOffTime = $("#drop_off_time").val()
                dropOffDate = $("#drop_off_date").val()
                // An offset to push the content down from the top.
                let offset = 60;
                // Our scroll target : the top position of the
                let target = $('#vehicle').offset().top - offset;
                // The magic...smooth scrollin' goodness.
                $('html, body').animate({scrollTop:target}, 600);
                $("#vehicles").show('fade')//.attr('data-aos','fade-down')
            })

        @endif

        @else
            $("#quote_form").submit(function (e){
                e.preventDefault()
            // window.location.href = '/login';
            // open modal
            $('#loginModal').modal('show');
            })
    @endauth


    // google api places
    function initAutocomplete(){
        autoPickup = new google.maps.places.Autocomplete(
            document.getElementById('geoPickup'),
            {
                types: ['address'],
                componentRestrictions: {'country': ['uk']},
                fields: ['place_id', 'geometry', 'address_components']
            });
        autoDropOff = new google.maps.places.Autocomplete(
            document.getElementById('geoDropOff'),
            {
                types: ['address'],
                componentRestrictions: {'country': ['uk']},
                fields: ['place_id', 'geometry', 'address_components']
            });
        // store geo data
        autoPickup.addListener('place_changed', onPlacePickup);
        autoDropOff.addListener('place_changed', onPlaceDropOff);
    }

    function onPlacePickup(){
        let place = autoPickup.getPlace();
        // get postcode
        for (var i = 0; i < place.address_components.length; i++) {
            for (var j = 0; j < place.address_components[i].types.length; j++) {
                if (place.address_components[i].types[j] === "postal_code") {
                    pickupPostcode = place.address_components[i].long_name;
                }
            }
        }
        console.log(pickupPostcode)
        if(!place.geometry.location.lat){
            // user did not select an address
            document.getElementById('geoPickup').placeholder = 'Enter a place';
        } else {
            document.getElementById('geoPickup').innerHTML = place.name;
            geoPickupLat = place.geometry.location.lat();
            geoPickupLong = place.geometry.location.lng();

            // function to set start param
            setRoute([geoPickupLong,geoPickupLat]);
            //console.log([geoPickupLat,geoPickupLong])
        }
    }

    function onPlaceDropOff(){
        let place2 = autoDropOff.getPlace();
        // get postcode
        for (var b = 0; b < place2.address_components.length; b++) {
            for (var r = 0; r < place2.address_components[b].types.length; r++) {
                if (place2.address_components[b].types[r] === "postal_code") {
                    dropOffPostcode = place2.address_components[b].long_name;
                }
            }
        }
        console.log(dropOffPostcode)

        if(!place2.geometry){
            // user did not select an address
            document.getElementById('geoDropOff').placeholder = 'Enter a place';
        } else {
            document.getElementById('geoDropOff').innerHTML = place2.name;
            geoDropOffLat = place2.geometry.location.lat();
            geoDropOffLong = place2.geometry.location.lng();
            endRoute([geoDropOffLong,geoDropOffLat]);
        }
    }

    // mapbox api
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ3JvdXA0bG9naXN0aWNzIiwiYSI6ImNsMWJ5dmRtejAyaTQzZnAzdTgzZTI0NnAifQ.mR63lFlRLTQg2kE5swvmsw';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v11', // style URL
        center: [-1.1941504496901416, 53.3], // starting position [lng, lat]
        zoom: 5 // starting zoom
    });
    // create a function to make a directions request
    async function getRoute(end) {

        const query = await fetch(
            `https://api.mapbox.com/directions/v5/mapbox/driving/${geoPickupLong},${geoPickupLat};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=${mapboxgl.accessToken}`,
            { method: 'GET' }
        );
        //console.log(query)
        const json = await query.json();
        //console.log(json)
        const data = json.routes[0];

        const route = data.geometry.coordinates;
        const geojson = {
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'LineString',
                coordinates: route
            }
        };
        //console.log(geojson)
        // if the route already exists on the map, we'll reset it using setData
        if (map.getSource('route')) {
            map.getSource('route').setData(geojson);
        }
        // otherwise, we'll make a new request
        else {
            map.addLayer({
                id: 'route',
                type: 'line',
                source: {
                    type: 'geojson',
                    data: geojson
                },
                layout: {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                paint: {
                    'line-color': '#3887be',
                    'line-width': 5,
                    'line-opacity': 0.75
                }
            });
        }
        // add turn instructions here at the end
        const steps = data.legs[0].steps;
        let distance = 0;
        for (const step of steps) {
            distance += step.distance;
            //console.log(step.distance)
        }
        miles = distance * 0.00062137
        //console.log(miles)

    }

    function setRoute(start) {
        // make an initial directions request that
        // starts and ends at the same location
        getRoute(start);

        // Add starting point to the map
        map.addLayer({
            id: 'point',
            type: 'circle',
            source: {
                type: 'geojson',
                data: {
                    type: 'FeatureCollection',
                    features: [
                        {
                            type: 'Feature',
                            properties: {},
                            geometry: {
                                type: 'Point',
                                coordinates: start
                            }
                        }
                    ]
                }
            },
            paint: {
                'circle-radius': 5,
                'circle-color': '#3887be'
            }
        });
    };

    function endRoute(finish){

            const coords = finish;
            //console.log(coords)
            const end = {
                type: 'FeatureCollection',
                features: [
                    {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'Point',
                            coordinates: coords
                        }
                    }
                ]
            };
            if (map.getLayer('end')) {
                map.getSource('end').setData(end);
            } else {
                map.addLayer({
                    id: 'end',
                    type: 'circle',
                    source: {
                        type: 'geojson',
                        data: {
                            type: 'FeatureCollection',
                            features: [
                                {
                                    type: 'Feature',
                                    properties: {},
                                    geometry: {
                                        type: 'Point',
                                        coordinates: coords
                                    }
                                }
                            ]
                        }
                    },
                    paint: {
                        'circle-radius': 5,
                        'circle-color': '#f30'
                    }
                });
            }
            getRoute(coords);

        };

    // const swiper = new Swiper('.swiper', {
    //     // Optional parameters
    //     direction: 'horizontal',
    //     loop: true,
    //
    //     // If we need pagination
    //     // pagination: {
    //     //     el: '.swiper-pagination',
    //     // },
    //
    //     // Navigation arrows
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    //
    // });
</script>

<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANuqMix1FlQmAVcJk-VnF225H-ecxEKok&libraries=places&callback=initAutocomplete">
</script>


</body>

</html>
