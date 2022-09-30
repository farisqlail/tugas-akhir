<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table        = 'kriteria';
    protected $primaryKey   = 'id_kriteria';
    protected $fillable     = ['nama_kriteria','atribut_kriteria','bobot_preferensi','id_lowongan'];
    protected $hidden       = ['created_at','updated_at'];

    public function lowongan() {
        return $this->belongsTo(lowongan::class,'id_lowongan', 'id_lowongan');
    }
    
    public function bobot_kriteria() {
        return $this->hasMany(BobotKriteria::class,'id_bobot_kriteria', 'id_bobot_kriteria');
    }

    public function pelamar() {
        return $this->belongsTo(Pelamar::class,'id_pelamar', 'id_pelamar');
    }
}
