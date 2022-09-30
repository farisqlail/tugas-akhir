<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lowongan extends Model
{
    protected $table        = 'lowongan';
    protected $primaryKey   = 'id_lowongan';
    protected $fillable     = ['posisi_lowongan','berlaku_sampai','deskripsi_pekerjaan', 'deskripsi_persyaratan'];
    protected $hidden       = ['created_at','updated_at'];

    public function pelamar() {
        return $this->hasMany(Pelamar::class,'id_lowongan', 'id_lowongan');
    }

    public function kriteria() {
        return $this->hasMany(Kriteria::class,'id_lowongan', 'id_lowongan');
    }
    
    public function jadwal_tes() {
        return $this->hasMany(JadwalTes::class,'id_lowongan', 'id_lowongan');
    }

    public function nilaiAlternatif() {
        return $this->hasMany(NilaiAlternatif::class,'id_nilai_alternatif', 'id_nilai_alternatif');
    }
}
