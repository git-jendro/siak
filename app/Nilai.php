<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = "tbl_nilai";
    
    public $incrementing = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailNilai::class, 'nilai_id');
    }
}
