<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatKelas extends Model
{
    protected $table = "tbl_riwayat_kelas";
    
    public $incrementing = false;

    public function siswa()
    {
        return $this->hasMany(RiwayatKelasSiswa::class, 'riwaya_kelas_id');
    }
}
