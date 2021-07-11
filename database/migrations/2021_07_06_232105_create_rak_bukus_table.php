<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRakBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rak_bukus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_rak');
            $table->string('lokasi_rak');
            $table->unsignedInteger('id_buku');
            $table->foreign('id_buku')->references('id')->on('bukus');
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
        Schema::dropIfExists('rak_bukus');
    }
}
