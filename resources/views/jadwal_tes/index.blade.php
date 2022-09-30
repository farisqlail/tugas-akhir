@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Jadwal Tes</h2>
                        <div class="float-right">
                            <a href="{{ route('jadwal_tes.tambah') }}" class="btn btn-success">Tambah</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Posisi Lowongan</th>
                                        <th class="text-center">Tanggal Tes</th>
                                        <th class="text-center">Tanggal Notif</th>
                                        <th class="text-center">Batas Pengumpulan</th>
                                        <th class="text-center" style="width:40%">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($jadwal_tes))
                                        @foreach ($jadwal_tes as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->posisi_lowongan }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->tanggal_notif }}</td>
                                                <td>{{ $data->durasi_tes }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('daftar_soal.index', ['id' => $data->id_jadwal_tes]) }}"
                                                        class="btn btn-sm btn-info">Daftar Soal</a>
                                                    <a href="{{ route('jawaban.index', $data->id_lowongan) }}"
                                                        class="btn btn-sm btn-info">Nilai</a>
                                                    <a href="{{ route('jadwal_tes.ubah', ['id' => $data->id_jadwal_tes]) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="{{ route('jadwal_tes.notif', $data->id_jadwal_tes) }}" class="btn btn-sm btn-info">Beri Notif</a>
                                                    <a href="#" class="btn btn-sm btn-danger delete"
                                                        data-id="{{ $data->id_jadwal_tes }}">Hapus</a>
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.delete').click(function() {
            var jadwalId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/jadwal_tes/admin/jadwal/hapus/" + jadwalId + ""
                        swal("Data berhasil dihapus", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus");
                    }
                });
        });
    </script>

@endsection
