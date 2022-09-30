@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Kriteria {{ $lowongan->posisi_lowongan }}</h2>
                        <div class="float-right">
                            <a href="{{ route('lowongan.index') }}" class="btn btn-danger">Kembali</a>
                            <a href="{{ route('kriteria.tambah', ['id' => $lowongan->id_lowongan]) }}"
                                class="btn btn-success">Tambah</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kriteria</th>
                                        <th class="text-center">Atribut</th>
                                        <th class="text-center">Bobot (%)</th>
                                        <th class="text-center" style="width: 30%">Aksi</th>
                                    </tr>
                                </thead>
                                @if ($nilai < 100)
                                    <span class="text-warning"> <i>Presentase Bobot harus 100%</i></span>
                                    @elseif ($nilai > 100)
                                    <span class="text-warning"> <i>Presentase Bobot harus 100%</i></span>
                                @endif
                                <tbody>
                                    @if (!empty($kriteria))
                                        @foreach ($kriteria as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama_kriteria }}</td>
                                                <td>{{ $data->atribut_kriteria }}</td>
                                                <td class="text-center">
                                                    
                                                        {{ $data->bobot_preferensi }}<br>
                                                    
                                                </td>
                                                <td class="text-center">

                                                    <a href="{{ route('bobot_kriteria.index', ['id' => $data->id_kriteria]) }}"
                                                        class="btn btn-sm btn-info">Bobot kriteria</a>
                                                    <a href="{{ route('kriteria.edit', ['id' => $data->id_kriteria]) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger delete"
                                                        data-id="{{ $data->id_kriteria }}">Hapus</a>

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
            var kriteriaId = $(this).attr('data-id');
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "Apa kamu yakin ingin menghapus data ini",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/lowongan/admin/kriteria/hapus/" + kriteriaId + ""
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
