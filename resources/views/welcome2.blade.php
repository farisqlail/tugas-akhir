@extends('layouts.user')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>CV.Lintas Nusa</h1>
                    <h2>Aplikasi Rekrutmen dan Seleksi Karyawan dengan menggunakan metode SAW</h2>
                    <div class="d-flex">
                        <a href="{{ route('lowongan.home') }}" class="btn-get-started scrollto">Cari Lowongan!</a>
                        {{-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="{{ asset('user-template/assets/img/hero-img.png') }}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

@endsection
