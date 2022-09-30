@extends('layouts.user')

<img src="{{ asset('assets/img/Detail.png') }}" class="img-fluid" style="margin-top: 80px;" alt="" srcset="">

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">

            <div class="card" style="margin-top: 100px; width: 50rem; border: none;">
                <div class="card-body">
                    <h4>{{ $lowongan->posisi_lowongan }}</h4>
                    <br>
                    <i class="text-danger"> Pendaftaran ditutup pada: {{ $lowongan->berlaku_sampai }}</i></span>
                    <p class="mt-3">
                    <h3>Deskripsi Pekerjaan</h3>
                    {!! $lowongan->deskripsi_pekerjaan !!}
                    </p>
                    <p class="mt-1">
                    <h3>Persyaratan</h3>
                    {!! $lowongan->deskripsi_persyaratan !!}
                    </p>

                    @if (Auth::guest())
                        <div class="button-group" align="right">

                            <a href="{{ route('login') }}" class="btn-get-started">Lamar</a>
                        </div>
                    @else
                        <div class="button-group" align="right">
                            @if (\Carbon\Carbon::parse($lowongan->berlaku_sampai) > \Carbon\Carbon::now())

                                @php
                                    $check = false;
                                @endphp
                                @foreach ($lowongan->pelamar as $item)
                                    @if (Auth::user()->id == $item->id_user)
                                        <a href=" {{ route('lowongan.home') }}" class="btn-get-started">Kembali</a>
                                        @php
                                            $check = true;
                                        @endphp
                                    @endif
                                @endforeach
                                @if (!$check)
                                    <a href="{{ route('pelamar.tambah', $lowongan->id_lowongan) }}"
                                        class="btn-get-started">Lamar</a>
                                @endif
                            @endif

                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
