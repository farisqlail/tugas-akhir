<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    protected $table        = 'nilai_alternatif';
    protected $fillable     = ['id_bobot_kriteria','id_pelamar'];
    protected $hidden       = ['created_at','updated_at'];

    public function bobot_kriteria() {
        return $this->belongsTo(BobotKriteria::class,'id_bobot_kriteria', 'id_bobot_kriteria');
    }
    
    public function pelamar() {
        return $this->belongsTo(Pelamar::class,'id_pelamar', 'id_pelamar');
    }

    public function lowongan() {
        return $this->belongsTo(Lowongan::class,'id_lowongan', 'id_lowongan');
    }
}
