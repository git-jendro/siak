<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_guru', function (Blueprint $table) {
            $table->string('id',7)->primary();
            $table->bigInteger('nuptk');
            $table->string('nama', 100);
            $table->string('agama_id', 5);
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->longText('alamat');
            $table->boolean('status');
            $table->string('pendidikan', 30);
            $table->string('jurusan', 50);
            $table->string('no_telp', 15);
            $table->string('foto')->default('sb-admin/img/teacher.jpg')->nullable();
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
        Schema::dropIfExists('tbl_guru');
    }
}
