<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->string('id', 8);
            $table->bigInteger('nisn');
            $table->string('nama', 100);
            $table->string('agama_id', 5);
            $table->string('jenis_kelamin', 5);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->longText('alamat');
            $table->boolean('status');
            $table->string('kelas_id', 8);
            $table->string('jurusan', 20);
            $table->bigInteger('no_telp');
            $table->string('foto')->nullable();
            $table->string('username', 10);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_siswa');
    }
}
