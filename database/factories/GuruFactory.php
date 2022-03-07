<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Guru;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Guru::class, function (Faker $faker) {
    return [
        'id' => $faker->numerify('GRU####'),
        'nama' => $faker->name,
        'nuptk' => $faker->numerify('################'),
        'status' => 1,
        'agama_id' => 'AGM01',
        'jenis_kelamin' => 'L',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '01-01-1978',
        'alamat' => $faker->address,
        'pendidikan' => 'Sarjana',
        'jurusan' => 'Pendidikan',
        'no_telp' => $faker->numerify('############'),
        'user_id' => $faker->numerify('USR########'),
    ];
});
