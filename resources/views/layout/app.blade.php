<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
    <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
    <meta name="author" content="Coderthemes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Title -->
    <title>Petcare+</title>
    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo3.jpg') }}" />

    <!-- Light-box -->
    <link rel="stylesheet" href="{{ asset('assets/css/mklb.css') }}" type="text/css" />
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
    <!-- <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet"> -->
    <link href="{{ asset('assets/css/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css')}}" rel="stylesheet">

    <!-- Swiper js -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" type="text/css" />

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css" />
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
</head>

<body>
    <!--Navbar Start-->
    @include('layout.navbar')
    <!-- Navbar End -->

    <!-- home-agency start -->
    @yield('content')
    <!-- home-agency end -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" class="back-to-top-btn btn btn-dark" id="back-to-top"><i class="mdi mdi-chevron-up"></i></a>

    <!-- javascript -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>     -->
    <!-- <script src="{{ asset('assets/vendor/aos/aos.js')}}"></script> -->
    <script src="{{ asset('assets/js/aos.js') }}"></script>

    <!-- Portfolio filter -->
    <script src="{{ asset('assets/js/filter.init.js') }}"></script>
    <!-- Light-box -->
    <script src="{{ asset('assets/js/mklb.js') }}"></script>
    <!-- swiper -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>

    <!-- counter -->
    <script src="{{ asset('assets/js/counter.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/js/jquery.dataTables.js') }}"></script>

    @stack('custom_js')
    <script>
        AOS.init();
    </script>
</body>

</html>