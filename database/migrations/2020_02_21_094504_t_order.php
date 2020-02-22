<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_tipe_pelanggan');
            $table->index('id_tipe_pelanggan');
            $table->foreign('id_tipe_pelanggan')->references('id')->on('t_tipe_pelanggan')->onDelete('cascade');
            $table->bigInteger('id_pelanggan');
            $table->index('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id')->on('t_pelanggan')->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->string('no_telp');
            $table->string('email');
            $table->bigInteger('estimated');
            $table->bigInteger('actual');
            $table->string('status');
            $table->bigInteger('dibayar');
            $table->string('oleh');
            $table->string('dihapus');
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
