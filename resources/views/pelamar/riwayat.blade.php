@extends('layouts.user')

<img src="{{ asset('assets/img/Riwayat.png') }}" class="img-fluid" style="margin-top: 80px;" alt="" srcset="">

@section('content')

    <div class="container" style="margin-top: 100px;">

        <div class="table-responsive mt-5">
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Posisi Lamaran</th>
                        <th class="text-center">Tanggal Lamar</th>
                        <th class="text-center">Status Lamaran</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($pelamar))
                        @foreach ($pelamar as $data)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->lowongan->posisi_lowongan }}</td>
                                <td>{{ $data->lowongan->created_at->toFormattedDateString() }}</td>
                                <td>
                                    @if ($data->seleksi_satu == null && $data->seleksi_dua == null)
                                        <span class="text-warning">Lamaran belum ada status</span>
                                    @elseif($data->seleksi_satu == 'Diterima' && $data->seleksi_dua == null)
                                        <span class="text-success">Lolos Seleksi Tahap 1 <br>
                                            (Silahkan Mengikuti Tes Online) </span>
                                    @elseif ($data->seleksi_satu == 'Diterima' && $data->seleksi_dua == 'Diterima')
                                        <span class="text-success">Lolos Seleksi Tahap 2 <br>
                                            (Silahkan Datang Ke Perusahaan Untuk Mengikuti Wawancara) </span>

                                    @elseif($data->seleksi_satu == 'Ditolak' && $data->seleksi_dua == null)
                                        <span class="text-danger">Lamaran Ditolak</span>
                                    @elseif($data->seleksi_satu == 'Diterima' && $data->seleksi_dua == 'Ditolak')
                                        <span class="text-danger">Lamaran Ditolak</span>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
