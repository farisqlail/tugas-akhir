@extends('layouts.user')

<img src="{{ asset('assets/img/Tes.png') }}" class="img-fluid" style="margin-top: 80px;" alt="" srcset="">

@section('content')

    <div class="container" style="margin-top: 4rem;">
        <h2><strong>Tes Online</strong></h2>
        @foreach ($jadwal_tes as $item)
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="text-success">Posisi Lowongan</h6>
                    <h5><b>{{ $item->posisi_lowongan }}</b></h5>
                    <br>
                    <span>
                        <i class="text-danger">
                            @if ($item->tanggal && $item->durasi_tes > \Carbon\Carbon::now())
                            Waktu Pengerjaan : {{ $item->tanggal }} - {{ $item->durasi_tes }}
                            @else
                                Status : Tes ditutup
                            @endif
                        </i>
                    </span>
                    <br><br>

                    <div class="button-mulai" align="right">
                        @if ($item->tanggal && $item->durasi_tes > \Carbon\Carbon::now())
                        <a href="{{ route('daftar_soal.home', ['id' => $item->id_jadwal_tes]) }}"
                            class="btn btn-success">Lihat Soal</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
