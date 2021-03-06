<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRiwayatKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_riwayat_kelas', function (Blueprint $table) {
            $table->string('id', 8)->primary();
            $table->string('tahun_akademik_id', 5)->nullable();
            $table->string('kelas', 15)->nullable();
            $table->string('guru_id', 7)->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('tbl_riwayat_kelas');
    }
}
