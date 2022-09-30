<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    protected $table        = 'hasil_tes';
    protected $primaryKey   = 'id_hasil_tes';
    protected $fillable     = ['jawaban_tes','nilai_tes','id_soal_tes','id_pelamar'];
    protected $hidden       = ['created_at','updated_at'];

    public function daftar_soal() {
        return $this->belongsTo(DaftarSoal::class,'id_soal_tes', 'id_soal');
    }
    
    public function pelamar() {
        return $this->belongsTo(Pelamar::class,'id_pelamar', 'id_pelamar');
    }
   
}
