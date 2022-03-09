<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaranDetail extends Model
{
    protected $table = "tbl_jadwal_pelajaran_detail";
    
    public $incrementing = false;

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
