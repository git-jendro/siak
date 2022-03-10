<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDetailNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_detail_nilai', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('nilai_id', 8);
            $table->string('pelajaran_id', 6);
            $table->integer('tugas_1')->default(0);
            $table->integer('tugas_2')->default(0);
            $table->integer('tugas_3')->default(0);
            $table->integer('tugas_4')->default(0);
            $table->integer('tugas_5')->default(0);
            $table->integer('uts')->default(0);
            $table->integer('uas')->default(0);
            $table->float('nilai')->default(0);
            $table->string('grade',2)->default('-');
            $table->string('status', 15)->default('Tidak Lulus');
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
        Schema::dropIfExists('tbl_detail_nilai');
    }
}
