@extends('admin.app')

@section('content')
<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Edit Lowongan</h2>
                    </form>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form enctype="multipart/form-data" action="{{route('lowongan.update',$lowongan->id_lowongan)}}" method="POST" class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Posisi Lowongan <span class="text-danger">*</span></label>
                                <input type="text" name="posisi" required class="form-control" value="{{$lowongan->posisi_lowongan}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Berlaku Sampai <span class="text-danger">*</span></label>
                                <input type="date" name="berlaku" required class="form-control" value="{{$lowongan->berlaku_sampai}}">
                            </div>

                            <div class="form-group">
                                <label for="nama">Deskripsi Pekerjaan<span class="text-danger">*</span></label><br>
                                <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" class="form-control">{!! $lowongan->deskripsi_pekerjaan !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="nama">Deskripsi Persyaratan<span class="text-danger">*</span></label><br>
                                <textarea name="deskripsi_persyaratan" id="deskripsi_persyaratan" class="form-control">{!! $lowongan->deskripsi_persyaratan !!}</textarea>
                            </div>


                            <div class="float-right">
                                <a href="{{ route('lowongan.index') }}" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-success">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('deskripsi_pekerjaan');
    CKEDITOR.replace('deskripsi_persyaratan');
</script>
@endsection