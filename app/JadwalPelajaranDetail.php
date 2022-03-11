<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaranDetail extends Model
{
    protected $table = "tbl_jadwal_pelajaran_detail";
    
    public $incrementing = false;

    public const HARI = [
        [
            'id' => '1',
            'hari' => 'Senin',
        ],
        [
            'id' => '2',
            'hari' => 'Selasa',
        ],
        [
            'id' => '3',
            'hari' => 'Rabu',
        ],
        [
            'id' => '4',
            'hari' => 'Kamis',
        ],
        [
            'id' => '5',
            'hari' => 'Jumat',
        ],
    ];

    public const JAM = [
        [
            'id' => '06:30:00',
            'jam' => '06:30',
        ],
        [
            'id' => '07:10:00',
            'jam' => '07:10',
        ],
        [
            'id' => '07:50:00',
            'jam' => '07:50',
        ],
        [
            'id' => '08:30:00',
            'jam' => '08:30',
        ],
        [
            'id' => '09:10:00',
            'jam' => '09:10',
        ],
        [
            'id' => '09:50:00',
            'jam' => '09:50',
        ],
        [
            'id' => '10:30:00',
            'jam' => '10:30',
        ],
        [
            'id' => '11:10:00',
            'jam' => '11:10',
        ],
        [
            'id' => '11:50:00',
            'jam' => '11:50',
        ],
        [
            'id' => '12:30:00',
            'jam' => '12:30',
        ],
        [
            'id' => '13:10:00',
            'jam' => '13:10',
        ],
        [
            'id' => '14:50:00',
            'jam' => '14:50',
        ],
    ];

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPelajaran::class, 'jadwal_pelajaran_id');
    }
}
