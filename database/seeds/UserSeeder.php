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
            'id' => 'USR83610644',
            'username' => 'waluyo',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR68368278',
            'username' => 'putri',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR59778286',
            'username' => 'mursinin',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR28192175',
            'username' => 'mumpuni',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR32002879',
            'username' => 'timbul',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR86120441',
            'username' => 'usman',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR80348218',
            'username' => 'astuti',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR48468487',
            'username' => 'pranawa',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR19705330',
            'username' => 'dadap',
            'password' => Hash::make('123123'),
        ]);
        DB::table('tbl_user')->insert([
            'id' => 'USR44454103',
            'username' => 'yance',
            'password' => Hash::make('123123'),
        ]);
    }
}
