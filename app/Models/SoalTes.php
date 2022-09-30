<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalTes extends Model
{
    protected $table        = 'soal_tes';
    protected $primaryKey   = 'id_soal_tes';
    protected $fillable     = ['id_soal','id_jadwal_tes'];
    protected $hidden       = ['created_at','updated_at'];

    public function daftar_soal() {
        return $this->belongsTo(DaftarSoal::class,'id_soal', 'id_soal');
    }

    public function jadwal_tes() {
        return $this->belongsTo(JadwalTes::class,'id_jadwal_tes', 'id_jadwal_tes');
    }
    
    public function hasil_tes() {
        return $this->hasMany(HasilTes::class,'id_soal_tes', 'id_soal_tes');
    }
}
