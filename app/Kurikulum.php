<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = "tbl_kurikulum";
    
    public $incrementing = false;

    public function kurikulum_detail()
    {
        return $this->hasMany(DetailKurikulum::class, 'kurikulum_id');
    }
}
