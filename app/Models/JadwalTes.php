<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalTes extends Model
{
    protected $table        = 'jadwal_tes';
    protected $primaryKey   = 'id_jadwal_tes';
    protected $fillable     = ['tanggal','durasi_tes','id_lowongan'];
    protected $hidden       = ['created_at','updated_at'];

    public function lowongan() {
        return $this->belongsTo(lowongan::class,'id_lowongan', 'id_lowongan');
    }
    
    public function soal_tes() {
        return $this->hasMany(DaftarSoal::class,'id_jadwal_tes', 'id_jadwal_tes');
    }

    public function pelamar(){

        return $this->belongsTo(Pelamar::class);
    }
}
