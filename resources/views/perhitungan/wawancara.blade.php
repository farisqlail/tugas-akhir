@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Data Pelamar</h2>
                    </div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable" style="width: 98%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th align="center">Posisi Lowongan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($pelamar))
                                        @foreach ($pelamar as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama_pelamar }}</td>
                                                <td>{{ $data->posisi_lowongan }}</td>
                                                <td align="center">
                                                    <a href="{{ route('hasil.wawancara', $data->id_pelamar) }}" class="btn btn-sm btn-success">Hasil</a>
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
