<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblRiwayatKelasSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_riwayat_kelas_siswa', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('riwaya_kelas_id', 8);
            $table->string('siswa_id', 8);
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
        Schema::dropIfExists('tbl_riwayat_kelas_siswa');
    }
}
