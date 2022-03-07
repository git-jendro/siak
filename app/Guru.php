<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = "tbl_guru";
    
    public $incrementing = false;

    public $fillable = [
        'id', 'nuptk', 'nama', 'agama_id', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'status', 'pendidikan', 'jurusan', 'no_telp', 'foto', 'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }
}
