<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="/">
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="dns-prefetch" href="//www.w3.org">
    <link rel="dns-prefetch" href="//www.facebook.com">
    <link rel="dns-prefetch" href="//www.instagram.com">
    <link rel="dns-prefetch" href="//www.twitter.com">
    <link rel="dns-prefetch" href="//www.youtube.com">
    <link rel="dns-prefetch" href="//ersintat.com">
    <link rel="dns-prefetch" href="//techradar.com">
    <link rel="dns-prefetch" href="//turbologo.com">
    <link rel="dns-prefetch" href="//thepeer.com">
    <link rel="dns-prefetch" href="//techi.com">
    <link rel="dns-prefetch" href="//grapk.com">
    <link rel="dns-prefetch" href="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1"
        name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="css?family=Roboto:400,500,600,700" rel="stylesheet" type="text/css">

    <style>
        :root {
            --primary-color: #644222;
            --secondary-color: #be9874;
            --input-border-color: #d7cfc8;
            --primary-color-hover: #2e1913;
            --btn-text-color-hover: #101010;
            --heading-font: 'Jost', sans-serif;
            --primary-font: 'Roboto', sans-serif;
        }
    </style>
    <title>{{ config('app.name' )  }} </title>
    <link rel="canonical" href="/">
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content={{ config('app.name') }}>
    <meta property="og:type" content="article">
    <meta property="og:title" content={{ config('app.name') }}>
    <meta property="og:description" content="">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ route('home') }}/storage/general/logo.png">
    <meta name="twitter:title" content={{ config('app.name') }}>
    <meta name="twitter:description" content="">
    <link rel="icon" type="image/x-icon" href="storage/general/favicon.png">
    <style>
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fcrc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fabc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fcbc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fbxc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fcxc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fchc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmsu5fbbc4amp6lq.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu72xkktu1kvnz.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu5mxkktu1kvnz.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu7mxkktu1kvnz.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu4wxkktu1kvnz.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu7wxkktu1kvnz.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu7gxkktu1kvnz.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfomcnqeu92fr1mu4mxkktu1kg.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fcrc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fabc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fcbc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fbxc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fcxc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fchc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmeu9fbbc4amp6lq.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfcrc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfabc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfcbc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfbxc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0370-0377, U+037A-037F, U+0384-038A, U+038C, U+038E-03A1, U+03A3-03FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfcxc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfchc4amp6lbbp.woff2) format('woff2');
            unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url(storage/fonts/0fc20595eb/srobotov32kfolcnqeu92fr1mmwulfbbc4amp6lq.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
    <style>
        :root {
            --primary-font: "Roboto", sans-serif;
        }
    </style>
    <link media="all" type="text/css" rel="stylesheet"
        href="vendor/core/plugins/language/css/language-public.css?v=2.2.0">
    <link media="all" type="text/css" rel="stylesheet"
        href="vendor/core/core/base/libraries/ckeditor/content-styles.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/bootstrap/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/animate.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/fontawesome-all.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"> --}}
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/magnific-popup/magnific-popup.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/toastr/toastr.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/css/theme.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/default.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/responsive.css">
    <link media="all" type="text/css" rel="stylesheet" href="/themes/plugins/datepicker/bootstrap-datepicker.css">
    <script defer src="/themes/plugins/jquery.min.js"></script>
    {{-- <link media="all"   type="text/css" href="/themes/plugins/lightgallery/css/lightgallery.min.css" /> --}}
    
    <style>
        .page_speed_395945049 {
            height: 16px;
            width: auto;
        }

        .page_speed_1397160958 {
            background: #101010;
        }

        .page_speed_2114884026 {
            background-image: url(storage/banners/slider-1.png);
            background-size: cover;
        }

        .page_speed_143050126 {
            animation-delay: 0.8s;
        }

        .page_speed_969299176 {
            background-image: url(storage/banners/slider-2.png);
            background-size: cover;
        }

        .page_speed_331827282 {
            background-color: #F7F5F1;
        }

        .page_speed_1078341075 {
            background: #F7F5F1
        }

        .page_speed_616625798 {
            background-image: url('storage/backgrounds/testimonial-bg.png');
            background-size: cover;
        }

        .page_speed_1848109931 {
            background-image: url('storage/general/video-bg.png');
            background-repeat: no-repeat;
            background-position: center bottom;
            background-size: cover;
        }

        .page_speed_843775877 {
            background-color: #F7F5F1
        }

        .page_speed_1235585080 {
            background-image: url('storage/backgrounds/footer-bg.png');
        }

        .page_speed_1985284762 {
            display: none
        }

        .page_speed_1385941178 {
            background-color: #000;
            color: #fff;
        }

        .page_speed_2065514044 {
            max-width: 1170px;
        }

        .page_speed_1090855292 {
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
        }
    </style>
</head>

<body>
    <header class="header-area header-three">
        <div class="header-top second-header d-none d-md-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 d-none d-lg-block header-top-left">
                        <div class="header-cta">
                            <ul>
                                <li class="opening_hours">
                                    <i class="far fa-clock"></i>
                                    <span>Open 24/7 - Check-in: 1:00 PM | Check-out: 11:00 AM</span>
                                </li>
                                <li>
                                    <i class="far fa-mobile"></i>
                                    <strong><a href="tel:+2347055353419">08180000104</a></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-none d-lg-block text-end header-top-end">
                        <div class="header-social">
                            @guest
                                <a href="/login" class="ms-3">
                                    <i class="fa fa-sign-in-alt"></i>
                                    <span class="text-white customer-name-header ms-1">Login</span>
                                </a>
                                @else
                                <a href="{{ route('dashboard.home') }}">
                                    <img src="{{ asset('images/profile/'.Auth::user()->profile_image ) }}" class="rounded-circle ms-3 text-white customer-avatar-header" title="" width="16" alt="">
                                    <span class="customer-name text-white ms-1 customer-name-header">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                                </a>
                            @endguest
                            <span class="social-links">
                                <a target="_blank" href="https://www.facebook.com/"  title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a target="_blank"  href="https://www.instagram.com/" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a target="_blank"  href="https://www.twitter.com/" title="Twitter"><i class="fab fa-twitter"></i></a>
                                <a target="_blank" href="https://www.youtube.com/" title="YouTube"><i class="fab fa-youtube"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="header-sticky" class="menu-area">
            <div class="container">
                <div class="second-menu">
                    <div class="row align-items-center">
                        <div class="col-8 col-md-4 col-lg-2 col-xl-2">
                            <div class="logo"><a href="/"><img src="storage/general/logo.png" alt=""></a></div>
                        </div>
                        <div class="col-4 col-md-8 col-lg-8 col-xl-8">
                            <div class="main-menu text-center">
                                <nav id="mobile-menu">
                                    <ul class="main-menu">
                                        <li class="">
                                            <a class="active" href="/" > Home </a>
                                        </li>
                                        <li class="">
                                            <a class="" href="/rooms" > Our Rooms </a>
                                        </li>
                                        <li class="">
                                            <a class="active" href="/about" > About Us </a>
                                        </li>
                                        {{-- <li class="has-sub ">
                                            <a class="" href="#" > Blog </a>
                                        </li> --}}
                                    </ul>
                                </nav>
                            </div>
                            <button class="navbar-toggler text-white float-end d-lg-none btn btn-toggle-menu-mobile" type="button" data-bs-toggle="collapse" data-bs-target="#menu-mobile-nav"
                                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-list"></i>
                            </button>
                        </div>
                        <div class="d-none d-lg-block col-xl-2 col-lg-2"><a href="#booking-form"  class="top-btn mt-10 mb-10">Reservation</a></div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg-body-tertiary menu-mobile d-lg-none">
                <div class="collapse navbar-collapse" id="menu-mobile-nav">
                    <div class="menu">
                        <div class="menu-title"><span>Menu</span></div>
                        <ul class="navbar-nav mb-2 mb-lg-0 me-3 ms-3">
                            <li class="nav-item"><a href="/" class="nav-link   active"
                                    >Home</a></li>
                            <li class="nav-item"><a href="/rooms" class="nav-link  ">Our Rooms</a></li>
                           
                            <li class="nav-item"><a href="/about" class="nav-link  active"
                                   >About Us</a></li>
                            
                        </ul>
                        <div class="menu-title mt-20"><span>Account</span></div>
                        <ul class="navbar-nav mb-2 mb-lg-0 me-3 ms-3">
                            <li><a href="/login">Login</a></li>
                            <li><a href="/register">Register</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    @yield('content')

<footer class="footer-bg footer-p">
        <div class="footer-top pt-90 pb-40 ">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title mb-30"><img src="" alt=""></div>
                            <div class="f-contact">
                                <ul>
                                    <li><i class="icon fal fa-phone"></i><span>08180000104</span></li>
                                    <li><i class="icon fal fa-envelope"></i><span><a href="#"
                                                class="__cf_email__">Email</a>  info@house7.com.ng</span>
                                    </li>
                                    <li><i class="icon fal fa-map-marker-check"></i><span>7, Commercial Avenue, off Ikpokpan Road, GRA, Benin City</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>Our Links</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a target="_self" class="font-sm color-grey-200" href="/">Home</a></li>
                                    <li><a target="_self" class="font-sm color-grey-200" href="/about">About
                                            Us</a></li>
                                    <li><a target="_self" class="font-sm color-grey-200" href="/contact">Contact
                                            Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>Our Services</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a target="_self" class="font-sm color-grey-200" href="#">FAQ</a></li>
                                    <li><a target="_self" class="font-sm color-grey-200" href="#">Support</a>
                                    </li>
                                    <li><a target="_self" class="font-sm color-grey-200" href="#">Privacy</a>
                                    </li>
                                    <li><a target="_self" class="font-sm color-grey-200"
                                            href="#">Term &amp; Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     {{--  <div class="col-xl-4 col-lg-4 col-sm-6">
                      <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>Subscribe To Our Newsletter</h2>
                            </div>
                            <div class="footer-link" dir="ltr">
                                <div class="subricbe p-relative form-newsletter" data-animation="fadeInDown"
                                    data-delay=".4s">
                                    <form method="POST" action=""
                                        accept-charset="UTF-8" id="botble-newsletter-forms-fronts-newsletter-form"
                                        class="subscribe-form dirty-check">
                                        <div class="input-group mb-3"><input class="form-control"
                                                placeholder="Enter Your Email" id="newsletter-email" required="required"
                                                name="email" type="email"></div>
                                        <div
                                            class="newsletter-message newsletter-success-message page_speed_1985284762">
                                        </div>
                                        <div class="newsletter-message newsletter-error-message page_speed_1985284762">
                                        </div><button class="btn header-btn" type="submit"><i
                                                class="fas fa-location-arrow"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>--}}
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6"> ©{{ date('Y') }} {{ config('app.name') }}. All right reserved. </div>
                    <div class="col-lg-6 col-md-6 text-end text-xl-right">
                        <div class="footer-social"><a target="_blank" href="https://www.facebook.com/"
                                title="Facebook"><i class="fab fa-facebook-f"></i></a><a target="_blank"
                                href="https://www.instagram.com/" title="Instagram"><i
                                    class="fab fa-instagram"></i></a><a target="_blank" href="https://www.twitter.com/"
                                title="Twitter"><i class="fab fa-twitter"></i></a><a target="_blank"
                                href="https://www.youtube.com/" title="YouTube"><i class="fab fa-youtube"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/themes/plugins/imagesloaded.min.js"></script>
    <script src="/themes/plugins/jquery.counterup.min.js"></script>
    <script src="/themes/plugins/jquery.scrollUp.min.js"></script>
    <script src="/themes/plugins/jquery.waypoints.min.js"></script>
    <script src="/themes/plugins/js_isotope.pkgd.min.js"></script>
    <script src="/themes/plugins/one-page-nav-min.js"></script>
    <script src="/themes/plugins/parallax.min.js"></script>
    <script src="/themes/plugins/popper.min.js"></script>
    <!-- Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="/themes/plugins/wow.min.js"></script>
    <script src="/themes/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="/themes/plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/themes/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/themes/plugins/toastr/toastr.min.js"></script>
    <script src="/themes/js/main.js"></script>
    <script src="vendor/core/plugins/language/js/language-public.js?v=2.2.0"></script>
    <script src="/themes/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="/themes/plugins/lightgallery/js/lightgallery.min.js"></script>
    <script src="/themes/riorelax/plugins/jquery-bar-rating/jquery.barrating.min.js"></script>
    <script src="{{ asset('themes/js/custom-slider.js') }}"></script>
    @stack('scripts')
    @include('partials.message')
</body>

</html>