<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    protected $table = "tbl_walikelas";
    
    public $incrementing = false;

    public $fillable = [
        'id', 'guru_id', 'kelas_id'
    ];

    public function guru()
    {
        return $this-> belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
        return $this-> belongsTo(Kelas::class, 'kelas_id');
    }
}
