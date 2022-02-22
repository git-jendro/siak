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
            $table->string('id',6)->primary();
            $table->string('nama', 100);
            $table->string('agama_id', 5);
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->longText('alamat');
            $table->string('jabatan_id', 5);
            $table->string('no_telp', 15);
            $table->string('foto')->default('sb-admin/img/staff.jpg')->nullable();
            $table->string('user_id',11);
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
