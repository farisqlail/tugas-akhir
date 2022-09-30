<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    protected $table        = 'bobot_kriteria';
    protected $primaryKey   = 'id_bobot_kriteria';
    protected $fillable     = ['nama_bobot','jumlah_bobot','id_kriteria'];
    protected $hidden       = ['created_at','updated_at'];

    public function kriteria() {
        return $this->belongsTo(Kriteria::class,'id_kriteria', 'id_kriteria');
    }

    public function pelamar() {
        return $this->belongsToMany(Pelamar::class, 'nilai_alternatif','id_pelamar', 'id_bobot_kriteria');
    }
    
    public function nilai_alternatif() {
        return $this->hasMany(NilaiAlternatif::class,'id_bobot_kriteria', 'id_bobot_kriteria');
    }

    public function pelamar2(){

        return $this->belongsTo(Pelamar::class, 'id_bobot_kriteria', 'id_bobot_kriteria');
    }
}
