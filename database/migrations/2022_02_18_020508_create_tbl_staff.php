<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_staff', function (Blueprint $table) {
            $table->string('id',7)->primary();
            $table->string('nama', 100);
            $table->string('agama_id', 4);
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->longText('alamat');
            $table->string('jabatan_id', 5);
            $table->bigInteger('no_telp');
            $table->string('foto')->nullable();
            $table->string('username', 10);
            $table->string('password');
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
        Schema::dropIfExists('tbl_staff');
    }
}
