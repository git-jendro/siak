<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_jabatan')->insert([
            'id' => 'JBT01',
            'nama' => 'Admin',
            'previlege' => 1,
        ]);
        DB::table('tbl_jabatan')->insert([
            'id' => 'JBT02',
            'nama' => 'Keuangan',
            'previlege' => 2,
        ]);
    }
}
