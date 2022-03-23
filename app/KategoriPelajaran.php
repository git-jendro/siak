<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPelajaran extends Model
{
    protected $table = 'tbl_kategori_pelajaran';

    public $incrementing = false;
    
    protected $fillable = [
        'id', 'nama'
    ];

    public function pelajaran()
    {
        return $this->hasMany(Pelajaran::class, 'kategori_id');
    }
}
