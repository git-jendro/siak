<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_agama')->insert([
            'id' => 'AGM01',
            'nama' => 'Islam',
        ]);
        DB::table('tbl_agama')->insert([
            'id' => 'AGM02',
            'nama' => 'Protestan',
        ]);
        DB::table('tbl_agama')->insert([
            'id' => 'AGM03',
            'nama' => 'Katolik',
        ]);
        DB::table('tbl_agama')->insert([
            'id' => 'AGM04',
            'nama' => 'Hindu',
        ]);
        DB::table('tbl_agama')->insert([
            'id' => 'AGM05',
            'nama' => 'Buddha',
        ]);
        DB::table('tbl_agama')->insert([
            'id' => 'AGM06',
            'nama' => 'Khonghucu',
        ]);
    }
}
