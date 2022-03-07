<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = "tbl_guru";
    
    public $incrementing = false;

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }
}
