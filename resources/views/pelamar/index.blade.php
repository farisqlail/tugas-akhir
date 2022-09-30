@extends('admin.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Pelamar</h2>
                    {{-- <div class="float-right">
                        @if(Auth()->user()->role == "admin")
                        <a href="{{route('lowongan.tambah')}}" class="btn btn-success">Tambah</a>
                        @endif
                    </div> --}}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Posisi Lowongan</th>
                                    <th class="text-center">Nama Pelamar</th>
                                    <th class="text-center">Tanggal Lahir</th>
                                    <th class="text-center">No Telepon</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Pas Foto</th>
                                    <th class="text-center">CV</th>
                                    <th class="text-center">Ijazah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($pelamar))
                                @foreach($pelamar as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->lowongan->posisi_lowongan}}</td>
                                    <td>{{$data->nama_pelamar}}</td>
                                    <td>{{$data->tanggal_lahir}}</td>
                                    <td>{{$data->no_telepon}}</td>
                                    <td>{{$data->jenis_kelamin}}</td>
                                    <td><img src="{{ asset('storage/images/pas_foto/'.$data->pas_foto) }}" height="128" alt=""></td>

                                    <td><a href="{{ asset('storage/file/cv/'.$data->cv) }}" class="btn btn-sm btn-info" target="blank" download="{{ $data->cv }}">Download CV</a></td>
                                    <td><a href="{{ asset('storage/file/ijazah/'.$data->ijazah) }}" class="btn btn-sm btn-info" target="blank" download="{{ $data->ijazah }}">Download Ijazah</a></td>

                                    <td class="text-center">
                                        <form action="{{route('pelamar.hapus',['id' => $data->id_pelamar])}}" method="POST">
                                            @csrf
                                            @if(Auth()->user()->role == "admin")
                                            {{-- <a href="{{route('kriteria.index',['id' => $data->id_pelamar])}}" class="btn btn-sm btn-info">Kriteria</a>
                                            <a href="{{route('lowongan.edit',['id' => $data->id_pelamar])}}" class="btn btn-sm btn-warning">Edit</a> --}}
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            @endif
                                        </form>
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