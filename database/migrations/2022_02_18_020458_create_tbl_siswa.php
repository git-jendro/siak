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
            $table->string('id', 8)->primary();
            $table->bigInteger('nisn');
            $table->string('nama', 100);
            $table->string('agama_id', 5);
            $table->string('jenis_kelamin', 5);
            $table->string('tempat_lahir', 30);
            $table->string('tanggal_lahir', 10);
            $table->longText('alamat');
            $table->boolean('status');
            $table->string('kelas_id', 8);
            $table->string('jurusan_id', 5);
            $table->string('no_telp', 15);
            $table->string('foto')->default('sb-admin/img/student.jpg')->nullable();
            $table->string('user_id',11);
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
