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
        Schema::create('t_mobil', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_vendor');
            $table->index('id_vendor');
            $table->foreign('id_vendor')->references('id')->on('t_vendor')->onDelete('cascade');
            $table->string('no_polisi');
            $table->string('merk');
            $table->string('tipe');
            $table->string('vendor');
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
