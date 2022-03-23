<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $table = "tbl_pelajaran";
    
    public $incrementing = false;

    public function kurikulum_detail()
    {
        return $this->hasMany(DetailKurikulum::class, 'pelajaran_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPelajaran::class, 'kategori_id');
    }
}
