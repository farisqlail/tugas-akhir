@extends('admin.app')

@section('content')

    {{-- @include('jawaban.nilai', [$hasilTes[0]->id_hasil_tes]) --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Hasil Tes Posisi {{ $lowongan->posisi_lowongan }}</h2>
                        <div class="float-right">
                            <a href="{{ route('jadwal_tes.index') }}" class="btn btn-danger">Kembali</a>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Pelamar</th>
                                        <th class="text-center">Posisi Lowongan</th>
                                        <th class="text-center" style="width:40%">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($pelamar))
                                        @foreach ($pelamar as $data)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama_pelamar }}</td>
                                                <td>{{ $data->posisi_lowongan }}</td>

                                                <td class="text-center">

                                                    <a href="{{ route('jawaban.detail', $data) }}"
                                                        class="btn btn-success">Detail Jawaban</a>

                                                    {{-- <a href="{{ route('jawaban.nilai', $data->id_hasil_tes) }}"
                            data-toggle="modal" data-target="#nilaiJawaban{{ $data->id_hasil_tes }}" class="btn btn-info">Nilai Jawaban</a> --}}
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
                </div>
            @endsection
