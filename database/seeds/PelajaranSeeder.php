<?php

use App\Pelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelajaran = [
            'Pendidikan Agama dan Budi Pekerti', 'Pendidikan Pancasila dan Kewarganegaraan', 'Bahasa Indonesia', 'Matematika', 'Sejarah Indonesia', 'Bahasa Inggris			', 'Seni Budaya', 'Prakarya dan Kewirausahaan', 'Pendidikan Jasmani', 'Olah Raga & Kesehatan', 'Simulasi Digital', 'Fisika', 'Sistem Komputer', 'Sistem Operasi', 'Jaringan Dasar', 'Perakitan Komputer', 'Pemrograman WEB', 'Pemrograman Dasar', 'Sistem Operasi Jaringan', 'Rancang Bangun Jaringan', 'Administrasi Server', 'Komunikasi Data ', 'Komputer Terapan', 'Kerja Proyek TKJ', 'Jaringan Nirkabel', 'Keamanan Jaringan ', 'Troubleshooting Jaringan', 'Kimia', 'Bahasa Mandarin'
        ];
        $faker = Faker\Factory::create();
        foreach ($pelajaran as $value) {
            $data = new Pelajaran();
            $data->id = 'MPJ' . sprintf('%03u', $data->count() + 1);
            $data->nama = $value;
            $data->kkm = 75;
            $data->slug = Str::slug($value);
            $data->save();
        }
    }
}
