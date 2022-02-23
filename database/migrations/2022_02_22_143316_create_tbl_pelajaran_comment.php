<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPelajaranComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pelajaran_comment', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('tbl_pelajaran_thread_id', 10);
            $table->string('siswa_id', 8);
            $table->longText('jawaban')->nullable();
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
        Schema::dropIfExists('tbl_pelajaran_comment');
    }
}
