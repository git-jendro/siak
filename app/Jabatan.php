<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = "tbl_jabatan";
    
    public $incrementing = false;

    protected $fillable = [
        'id', 'nama'
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'jabatan_id');
    }
}
