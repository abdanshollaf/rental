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
            $table->string('id_invoice')->nullable();
            $table->unsignedBigInteger('id_tipe_pelanggan');
            $table->foreign('id_tipe_pelanggan')->references('id')->on('t_tipe_pelanggan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id')->on('t_pelanggan');
            $table->string('nama_pelanggan')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('estimated')->default(0);
            $table->bigInteger('actual')->default(0);
            $table->string('status')->nullable();
            $table->bigInteger('dibayar')->nullable();
            $table->string('oleh')->nullable();
            $table->string('dihapus')->nullable();
            $table->text('note')->nullable();
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
