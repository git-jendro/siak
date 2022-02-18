<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "tbl_siswa";
    
    public $incrementing = false;
}
