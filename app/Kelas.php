<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "tbl_kelas";
    
    public $incrementing = false;

    public function tingkat()
    {
        return $this->belongsTo(TingkatKelas::class, 'tingkat_kelas_id');
    }

    public function sub()
    {
        return $this->belongsTo(SubKelas::class, 'sub_kelas_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}
