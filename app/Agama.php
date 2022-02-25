<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = "tbl_agama";

    public $incrementing = false;

    protected $fillable = [
        'id', 'nama'
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class, 'agama_id');
    }
}
