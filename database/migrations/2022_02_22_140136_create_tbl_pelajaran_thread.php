<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPelajaranThread extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pelajaran_thread', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('riwaya_kelas_pelajaran_id', 10);
            $table->string('name', 100);
            $table->longText('soal')->nullable();
            $table->string('lampiran')->nullable();
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
        Schema::dropIfExists('tbl_pelajaran_thread');
    }
}
