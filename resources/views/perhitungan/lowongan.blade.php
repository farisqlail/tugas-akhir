@extends('admin.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Lowongan</h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" style="width: 98%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Posisi Lowongan</th>
                                        <th align="center">Status Lowongan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($jadwalTes))
                                        @foreach ($jadwalTes as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->posisi_lowongan }}</td>
                                                <td align="center">
                                                    @if ($data->berlaku_sampai > date('Y-m-d') && $data->status_lowongan == null)
                                                        <span class="badge badge-success">Pendaftaran</span>
                                                    @elseif($data->berlaku_sampai < date('Y-m-d') && $data->status_lowongan == null)
                                                        <span class="badge badge-warning">Seleksi 1</span>
                                                    @elseif($data->berlaku_sampai < date('Y-m-d') && $data->status_lowongan == 'Seleksi 2')
                                                        <span class="badge badge-warning">Seleksi 2</span>
                                                    @elseif($data->berlaku_sampai < date('Y-m-d') && $data->status_lowongan == 'Seleksi Selesai')
                                                        <span class="badge badge-danger">Seleksi Selesai</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('perhitungan.validasi', $data) }}"
                                                        class="btn btn-sm btn-danger">Validasi</a>

                                                    @if (\Carbon\Carbon::parse($data->berlaku_sampai) < \Carbon\Carbon::now())
                                                        <a href="{{ route('perhitungan.index', $data) }}"
                                                            class="btn btn-sm btn-info">Seleksi 1</a>
                                                            @if ($data->durasi_tes < \Carbon\Carbon::now())
                                                            <a href="{{ Route('perhitungan.dua', $data) }}"
                                                                class="btn btn-sm btn-success">Seleksi 2</a>
                                                                
                                                             <a href="{{ route('wawancara') }}" class="btn btn-sm btn-info">Wawancara</a>   
                                                            @endif
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
                </div>
            </div>
        </div>
    </div>
@endsection
