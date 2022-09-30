@extends('layouts.user')

<img src="{{ asset('assets/img/Daftar.png') }}" class="img-fluid" style="margin-top: 80px;" alt="" srcset="">

@section('content')

    <main id="main">
        <div class="container mt-5 mb-5">
            {{-- <h1 style="margin-top: 100px;" align="center">Daftar Lowongan Pekerjaan</h1> --}}

            <form action="{{ route('lowongan.search') }}" method="GET">
                <input class="form-control" name="search" value="{{ old('search') }}" type="text"
                    placeholder="Search ...">
                <br>
            </form>

            <div class="row" style="margin-top: 50px">
                @foreach ($lowongan as $data)
                    @if ($data->status_lowongan == 'Seleksi Selesai')
                    @else
                        <div class="col-md-6">
                            <div class="card card-lowongan shadow rounded">
                                <div class="card-body">
                                    <h4><b>{{ $data->posisi_lowongan }}</b></h4>
                                    <br>
                                    <i class="text-danger">
                                        @php
                                            $date = \Carbon\Carbon::parse($data->berlaku_sampai);
                                        @endphp
                                        @if ($date > \Carbon\Carbon::now())
                                            Pendaftaran berlaku sampai {{ $data->berlaku_sampai }}
                                            <br>
                                            @if (Auth::check())
                                                @php
                                                    $check = false;
                                                @endphp
                                                @foreach ($data->pelamar as $item)
                                                    @if (Auth::user()->id == $item->id_user)
                                                        <span class="badge badge-warning">Lamaran Sudah Diajukan</span>
                                                        @php
                                                            $check = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @else
                                            @endif
                                        @else
                                            <div class="row">
                                                <div class="col-md-6">
                                                    Pendaftaran ditutup
                                                </div>
                                                @if (Auth::check())
                                                    <div class="col-md-6" align="right">
                                                        @php
                                                            $check = false;
                                                        @endphp
                                                        @foreach ($data->pelamar as $item)
                                                            @if (Auth::user()->id == $item->id_user)
                                                                <span class="badge badge-warning">Lamaran Sudah
                                                                    Diajukan</span>
                                                                @php
                                                                    $check = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                @else
                                                @endif
                                            </div>
                                        @endif
                                    </i></span>
                                    <p class="mt-3">
                                    <h4>Persyaratan</h4>
                                    {!! $data->deskripsi_persyaratan !!}
                                    <h4>Deskripsi Pekerjaan</h4>
                                    {!! \Illuminate\Support\Str::limit($data->deskripsi_pekerjaan, 200) !!}
                                    </p>

                                    @if (Auth::guest())
                                        <div class="button-group mt-5" align="right">
                                            @if (\Carbon\Carbon::parse($data->berlaku_sampai) > date('Y-m-d'))
                                                <a href="{{ route('lowongan.detail', $data->id_lowongan) }}"
                                                    class="btn btn-outline-primary">Lihat Detail</a>
                                                <a href="{{ route('login') }}" class="btn-get-started">Lamar</a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="button-group" align="right">
                                            <a href="{{ route('lowongan.detail', $data->id_lowongan) }}"
                                                class="btn btn-outline-primary">Lihat Detail</a>
                                            @if (\Carbon\Carbon::parse($data->berlaku_sampai) > date('Y-m-d'))
                                                @php
                                                    $check = false;
                                                @endphp
                                                @foreach ($data->pelamar as $item)
                                                    @if (Auth::user()->id == $item->id_user)
                                                        @php
                                                            $check = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if (!$check)
                                                    <a href="{{ route('pelamar.tambah', $data->id_lowongan) }}"
                                                        class="btn-get-started">Lamar</a>
                                                @endif
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            </div><br>
                        </div>
                    @endif
                @endforeach
            </div>
    </main>



@endsection
