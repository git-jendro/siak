<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblJadwalPelajaranDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jadwal_pelajaran_detail', function (Blueprint $table) {
            $table->string('id', 9)->primary();
            $table->string('jadwal_pelajaran_id', 8);
            $table->string('pelajaran_id', 6);
            $table->string('guru_id', 6);
            $table->string('jam', 15);
            $table->string('ruangan_id', 4);
            $table->string('hari', 6);
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
        Schema::dropIfExists('tbl_jadwal_pelajaran_detail');
    }
}
