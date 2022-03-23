<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kategori_pelajaran')->insert([
            'id' => 'KGP01',
            'nama' => 'Muatan Nasional'
        ]);
        DB::table('tbl_kategori_pelajaran')->insert([
            'id' => 'KGP02',
            'nama' => 'Muatan Lokal'
        ]);
        DB::table('tbl_kategori_pelajaran')->insert([
            'id' => 'KGP03',
            'nama' => 'Muatan Peminatan Kejuruan'
        ]);
    }
}
