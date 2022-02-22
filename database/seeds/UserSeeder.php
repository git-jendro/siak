<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user')->insert([
            'id' => 'USR00000001',
            'username' => 'admin1',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_staff')->insert([
            'id' => 'STF001',
            'nama' => 'Admin',
            'agama_id' => 'AGM1',
            'jabatan_id' => 'JBT01',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => Carbon::parse('05-07-1967'),
            'alamat' => 'Jl. Jalan No. 41',
            'no_telp' => '08668978976',
            'user_id' => 'USR00000001',
        ]);
    }
}
