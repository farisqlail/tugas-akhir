@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Bobot Kriteria untuk Kriteria {{$kriteria->nama_kriteria}}</h3>
                        <div class="float-right">
                            <a href="{{ route('kriteria.index', ['id' => $kriteria->id_lowongan]) }}" class="btn btn-danger">Kembali</a>
                            <a href="{{ route('bobot_kriteria.tambah', ['id' => $kriteria->id_kriteria]) }}"
                                class="btn btn-success">Tambah</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Keterangan</th>
                                        <th>Nilai Bobot</th>
                                        <th class="text-center" style="width:20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($bobot_kriteria))
                                        @foreach ($bobot_kriteria as $data)

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datakriteria->nama_kriteria }}</td>
                                                <td>{{ $data->nama_bobot }}</td>
                                                <td>{{ $data->jumlah_bobot }}</td>
                                                <td class="text-center">

                                                    <a href="{{ route('bobot_kriteria.edit', ['id' => $data->id_bobot_kriteria]) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger delete" data-id="{{ $data->id_bobot_kriteria }}">Hapus</a>

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
            var bobotId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/lowongan/admin/bobot_kriteria/hapus/" + bobotId + ""
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
