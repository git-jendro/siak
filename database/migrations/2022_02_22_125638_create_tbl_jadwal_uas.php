<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblJadwalUas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jadwal_uas', function (Blueprint $table) {
            $table->string('id', 9);
            $table->string('kelas_id', 8);
            $table->string('tahun_akademik_id', 5);
            $table->string('pelajaran_id', 6);
            $table->string('guru_id', 6);
            $table->string('jam', 15);
            $table->string('ruangan_id', 4);
            $table->string('hari', 6);
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
        Schema::dropIfExists('tbl_jadwal_uas');
    }
}
