@extends('admin.app')

@section('content')

    {{-- @include('jawaban.nilai', [$hasilTes[0]->id_hasil_tes]) --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Hasil Tes {{$pelamar->nama_pelamar}}</h2>
                        <div class="float-right">
                            <a href="{{ route('jawaban.index', ['id' => $pelamar->id_lowongan]) }}" class="btn btn-danger">Kembali</a>
                           
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Soal Tes</th>
                                        <th class="text-center">Jawaban</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center" style="width:40%">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($hasilTes))
                                        @foreach ($hasilTes as $data)
                                            <div class="modal fade" id="nilaiJawaban{{ $data->id_hasil_tes }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Nilai Jawaban
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form enctype="multipart/form-data"
                                                                action="{{ route('jawaban.nilai.update', [$data->id_hasil_tes]) }}"
                                                                method="POST" class="col-md-12" id="form-nilaiJawaban">
                                                                @csrf
                                                                {{ method_field('PATCH') }}
                                                                <div class="form-group">
                                                                    <label for="soal">Nilai<span
                                                                            class="text-danger">*</span></label><br>
                                                                    <input type="number" name="nilai" required
                                                                        class="form-control" @if (!empty($data->nilai))
                                                                    value={{ $data->nilai }}
                                                                @else
                                                                    placeholder="Nilai 0 ...."
                                        @endif>


                                        <div class="modal-footer" style="border:none;">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Nilai</button>
                                        </div>
                                        </form>
                        </div>
                    </div>
                </div>

                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->daftar_soal->soal }}</td>
                    <td align="center">
                        <a href="{{ asset('storage/file/jawaban/' . $data->jawaban) }}" target="blank"
                            class="btn btn-primary" download><i class="fas fa-download"></i> &nbsp;Unduh Jawaban</a>
                    </td>
                    <td class="text-center">
                        @if (!empty($data->nilai))
                            {{ $data->nilai }}
                        @else
                            0
                        @endif
                    </td>
                    <td class="text-center">
                        {{-- <a href="{{ route('jawaban.detail', $data) }}" class="btn btn-success">Detail Jawaban</a> --}}
                        <a href="{{ route('jawaban.nilai', $data->id_hasil_tes) }}"
                            data-toggle="modal" data-target="#nilaiJawaban{{ $data->id_hasil_tes }}" class="btn btn-info">Nilai Jawaban</a>
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
