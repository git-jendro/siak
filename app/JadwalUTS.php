<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalUTS extends Model
{
    protected $table = "tbl_jadwal_uts";
    
    public $incrementing = false;
    
    public function tahun()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function detail()
    {
        return $this->hasMany(JadwalUTSDetail::class, 'jadwal_uts_id');
    }
}
