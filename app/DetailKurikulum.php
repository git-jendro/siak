<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKurikulum extends Model
{
    protected $table = "tbl_detail_kurikulum";
    
    public $incrementing = false;

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }

    public function pelarajan()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
}
