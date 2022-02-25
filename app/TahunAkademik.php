<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    protected $table = "tbl_tahun_akademik";

    protected $fillable = [
        'id', 'nama', 'semester', 'status'
    ];
    
    public $incrementing = false;

    public const semester = [
        [
            'id' => '1',
            'nama' => 'Ganjil'
        ],
        [
            'id' => '2',
            'nama' => 'Genap'
        ]
    ];
}
