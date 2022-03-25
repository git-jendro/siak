<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatKelas extends Model
{
    protected $table = "tbl_riwayat_kelas";
    
    public $incrementing = false;

    public function siswa()
    {
        return $this->hasMany(RiwayatKelasSiswa::class, 'riwayat_kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }
}
