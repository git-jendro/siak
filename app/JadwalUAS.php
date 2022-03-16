<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalUAS extends Model
{
    protected $table = "tbl_jadwal_uas";
    
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
        return $this->hasMany(JadwalUASDetail::class, 'jadwal_uas_id');
    }
}
