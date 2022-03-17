<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailNilai extends Model
{
    protected $table = "tbl_detail_nilai";

    public $incrementing = false;

    protected $fillable = [
        'id', ' nama', ' agama_id', ' jenis_kelamin', ' tempat_lahir', ' tanggal_lahir', ' alamat', ' jabatan_id', ' no_telp', ' foto', ' user_id'
    ];

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'nilai_id');
    }
}
