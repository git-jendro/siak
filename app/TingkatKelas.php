<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TingkatKelas extends Model
{
    protected $table = "tbl_tingkat_kelas";
    
    public $incrementing = false;

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }
}
