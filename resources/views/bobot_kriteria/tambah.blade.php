@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Tambah Bobot Kriteria</h2>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('bobot_kriteria.simpan') }}" method="POST" class="col-md-12">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="id_kriteria" class="form-control"
                                        value="{{ $kriteria->id_kriteria }}" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan_bobot">Keterangan Bobot <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="keterangan_bobot" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai_crip">Nilai Bobot<span class="text-danger">*</span></label>
                                    <input type="number" name="nilai_bobot" class="form-control" min="1" required>
                                </div>
                                <div class="float-right">
                                    <a href="{{ route('bobot_kriteria.index', ['id' => $kriteria->id_kriteria]) }}"
                                        class="btn btn-danger">Batal</a>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
