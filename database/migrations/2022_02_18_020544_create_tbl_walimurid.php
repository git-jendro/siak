<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblWalimurid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_walimurid', function (Blueprint $table) {
            $table->string('id', 8)->primary();
            $table->string('siswa_id', 8);
            $table->string('nama', 100);
            $table->string('agama_id', 5);
            $table->string('jenis_kelamin', 5);
            $table->longText('alamat');
            $table->string('no_telp', 15);
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
        Schema::dropIfExists('tbl_walimurid');
    }
}
