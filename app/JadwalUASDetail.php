<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalUASDetail extends Model
{
    protected $table = 'tbl_jadwal_uas_detail';

    public $incrementing = false;

    
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
    public function tahun()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    
    public function jadwal()
    {
        return $this->belongsTo(JadwalUTS::class, 'jadwal_uts_id');
    }
}
