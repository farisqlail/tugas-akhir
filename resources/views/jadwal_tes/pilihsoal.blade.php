@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Pilih Soal Tes</h2>

                </div>

                <div class="card-body">
                    <div class="row">
                        <form action="" method="POST" class="col-md-12">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Soal</th>
                                            <th class="text-center">File Soal</th>
                                            <th class="text-center">Bobot Soal</th>
                                            <th class="text-center" style="width:30%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($daftarsoal as $data)

                                        <tr>

                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->soal}}</td>
                                            <td><a href="/upload/{{$data->file_soal}}">Download File</a></td>
                                            <td>{{$data->bobot_soal}}</td>

                                            <td class="text-center">
                                                <form action="{{route('jadwal_tes.simpansoal',['id_jadwal_tes' => $jadwaltes->id_jadwal_tes])}}" method="POST">
                                                    @csrf
                                                    <input type="text" name="id_jadwal_tes" class="form-control" value="{{$jadwaltes->id_jadwal_tes}}" hidden>
                                                    <input type="text" name="id_soal" class="form-control" value="{{$data->id_soal}}" hidden>
                                                    <button type="submit" class="btn btn-sm btn-success">Pilih Soal</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <div class="card-header">
                            <h2 class="float-left">Daftar Soal Tes</h2>

                        </div>
                        <div class="table-responsive col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Soal</th>
                                        <th class="text-center">File Soal</th>
                                        <th class="text-center">Bobot Soal</th>
                                        <th class="text-center" style="width:30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soaltes as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->soal}}</td>
                                        <td><a href="/upload/{{$data->file_soal}}">Download File</a></td>
                                        <td>{{$data->bobot_soal}}</td>

                                        <td class="text-center">
                                            <form action="{{route('jadwal_tes.hapussoal',['id_jadwal_tes' => $data->id_jadwal_tes])}}" method="POST">
                                                @csrf
                                                <input type="text" name="id_jadwal_tes" class="form-control" value="{{$data->id_jadwal_tes}}" hidden>
                                                <input type="text" name="id_soal_tes" class="form-control" value="{{$data->id_soal_tes}}" hidden>
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus Soal</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection