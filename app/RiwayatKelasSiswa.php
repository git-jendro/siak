<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatKelasSiswa extends Model
{
    protected $table = "tbl_riwayat_kelas_siswa";
    
    public $incrementing = false;

    public $fillable = [
        'id', 'riwayat_kelas_id', 'siswa_id'
    ];

    public function riwayat()
    {
        return $this->belongsTo(RiwayatKelas::class, 'riwayat_kelas_id');
    }
}
