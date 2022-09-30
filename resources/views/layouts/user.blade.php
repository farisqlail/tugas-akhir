<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CV.Lintas Nusa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('user-template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user-template/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('user-template/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="{{ url('/') }}" style="color: #16DF7E;">CV.Lintas Nusa</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                @if (Route::has('login'))
                    <ul>
                        <li><a class="nav-link scrollto {{ 'lowongan' == request()->segment(1) ? 'active' : '' }}"
                                href="{{ route('lowongan.home') }}">Lowongan</a></li>
                        @auth
                            <li><a class="nav-link scrollto {{ 'jadwal_tes' == request()->segment(1) ? 'active' : '' }}"
                                    href="{{ route('soal-tes.home') }}">Tes Online</a>
                            </li>

                            <li><a class="nav-link scrollto {{ 'pelamar' == request()->segment(1) ? 'active' : '' }}"
                                    href="{{ route('pelamar.riwayat', Auth::user()->id) }}">Riwayat Lamaran</a>
                            </li>

                            <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i
                                        class="bi bi-chevron-down"></i></a>
                                <ul>

                                    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">Logout</a>
                                    </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                        @else
                            <li><a class="nav-link scrollto {{ 'login' == request()->segment(1) ? 'active' : '' }}"
                                    href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link scrollto {{ 'register' == request()->segment(1) ? 'active' : '' }}"
                                    href="{{ route('register') }}">Register</a></li>
                        @endauth
                    </ul>
                @endif
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <div class="container" style="margin-bottom: 500px;">
        @yield('content')

    </div>


    <footer id="footer">

        <div class="footer-top">

            <div class="container">

                <div class="row  justify-content-center">
                    <div class="col-lg-6">
                        <h3>CV.LINTASNUSA</h3>
                        <p>Sistem Penerimaan Karyawan</p>
                    </div>
                </div>

                <div class="social-links">
                    <a href="https://wa.me/6281249356745" class="phone"><i class="bx bxs-phone"></i></a>
                    <a href="mailto:lintasnusa1990@gmail.com" class=""><i class="fas fa-envelope"></i></a>
                </div>

            </div>
        </div>

        <div class="container footer-bottom ">
            <div class="copyright">
                <strong><span><b>CV.LINTASNUSA</b></span></strong>
            </div>
            <div class="credits">
                Designed by <a href="{{ url('/') }}">CV.LINTASNUSA</a>
            </div>
        </div>
        &nbsp;
        </div>
    </footer><!-- End Footer -->

    {{-- <footer id="footer" class="mx-auto" style="margin-top: 100px">
        <div class="container footer-bottom clearfix">
            <div class="copyright">
                <strong><span><b>CV.LINTASNUSA</b></span></strong>. Email : <a
                    href="mailto:lintasnusa1990@gmail.com">lintasnusa1990@gmail.com</a>, Wa : <a
                    href="https://wa.me/6281249356745">+62 812-4935-6745 {{ date('Y') }}</a>
            </div>
            <div class="credits">
                Designed by <a href="{{ url('/') }}">CV.LINTASNUSA</a>
            </div>
        </div>
        &nbsp;
    </footer> --}}
    <!-- Vendor JS Files -->
    <script src="{{ asset('user-template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('user-template/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>


    <!-- Template Main JS File -->
    <script src="{{ asset('user-template/assets/js/main.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
