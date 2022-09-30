
{{-- <div class="modal fade" id="unggah-jawaban" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">  
                <h5 class="modal-title" id="exampleModalLabel">Unggah Jawaban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jawaban.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}


                    <input type="number" name="id_soal_tes" value="{{ $daftarsoal->id_soal }}" hidden>
                    <input type="number" name="id_pelamar" value="{{ $pelamarGet }}" hidden>
                    <input type="number" name="id_lowongan" value="{{ $pelamar[0]->id_lowongan }}" hidden>
                    <div class="form-group">
                        <span class="text-danger">Unggah jawabanmu disini, pastikan jawaban yang kamu unggah sesuai soal!</span><br>
                        <input type="file" class="btn btn-warning mt-3" name="jawaban" value="Unggah Jawaban">
                    </div><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div> --}}
