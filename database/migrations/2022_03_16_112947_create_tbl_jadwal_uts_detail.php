<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblJadwalUtsDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jadwal_uts_detail', function (Blueprint $table) {
            $table->string('id', 9)->primary();
            $table->string('jadwal_uts_id', 8);
            $table->string('pelajaran_id', 6);
            $table->string('guru_id', 7)->nullable();
            $table->time('mulai')->nullable();
            $table->time('jam')->nullable();
            $table->string('ruangan_id', 6)->nullable();
            $table->string('hari', 6)->nullable();
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
        Schema::dropIfExists('tbl_jadwal_uts_detail');
    }
}
