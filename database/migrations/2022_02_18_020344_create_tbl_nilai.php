<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nilai', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('jadwal_peljaran_id', 8);
            $table->integer('tugas_1');
            $table->integer('tugas_2');
            $table->integer('tugas_3');
            $table->integer('tugas_4');
            $table->integer('tugas_5');
            $table->integer('uts');
            $table->integer('uas');
            $table->float('nilai');
            $table->string('grade',2);
            $table->string('status', 15);
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
        Schema::dropIfExists('tbl_nilai');
    }
}
