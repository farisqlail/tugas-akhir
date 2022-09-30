@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Edit Soal</h2>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <form enctype="multipart/form-data" action="{{route('daftar_soal.update',$daftar_soal->id_soal)}}" method="POST" class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label for="soal">Soal<span class="text-danger">*</span></label>
                                <input type="text" name="soal" required class="form-control" value="{{$daftar_soal->soal}}">
                            </div>
                            <div class="form-group">
                                <label for="bobot">Bobot Soal<span class="text-danger">*</span></label>
                                <input type="number" name="bobot" required class="form-control" max="100" value="{{$daftar_soal->bobot_soal}}">
                            </div>
                            <div class="form-group">
                                <label for="file_soal">File Soal<span class="text-danger">*</span></label>
                            </div>
                            <input name="file_soal" class="form-control" type="file"/>
                            <br>
                            <div class="float-right">
                                <a href="{{ route('daftar_soal.index', ['id' => $daftar_soal->id_jadwal_tes]) }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-success">Edit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection