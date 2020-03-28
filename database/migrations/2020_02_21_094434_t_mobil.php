<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TMobil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tipe_mobil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tipe')->nullable();
            $table->timestamps();
        });


        Schema::create('t_mobil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_vendor');
            $table->foreign('id_vendor')->references('id')->on('t_vendor');
            $table->unsignedBigInteger('id_tipe_mobil');
            $table->foreign('id_tipe_mobil')->references('id')->on('t_tipe_mobil');
            $table->string('no_polisi')->nullable();
            $table->date('stnk')->nullable();
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('vendor')->nullable();
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
        //
    }
}
