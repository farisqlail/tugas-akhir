@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="float-left">Tambah Jadwal Tes</h2>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('jadwal_tes.simpan') }}" method="POST" class="col-md-12">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Pilih Lowongan<span class="text-danger">*</span></label>
                                    <select name="id_lowongan" class="form-control" required>
                                        <option value="">-</option>
                                        @foreach ($lowongan as $data)
                                            <option value="{{ $data->id_lowongan }}">{{ $data->posisi_lowongan }}</option>
                                        @endforeach

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Notif <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="tanggal_notif" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="tanggal" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="batas">Batas Pengumpulan <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="batas" class="form-control">
                                </div>



                                <div class="float-right">
                                    <a href="{{ route('jadwal_tes.index') }}" class="btn btn-danger">Batal</a>
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
