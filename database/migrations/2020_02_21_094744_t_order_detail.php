<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_order_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_order');
            $table->index('id_order');
            $table->foreign('id_order')->references('id')->on('t_order')->onDelete('cascade');
            $table->bigInteger('id_tipe_pelanggan');
            $table->index('id_tipe_pelanggan');
            $table->foreign('id_tipe_pelanggan')->references('id')->on('t_tipe_pelanggan')->onDelete('cascade');
            $table->bigInteger('id_pelanggan');
            $table->index('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id')->on('t_pelanggan')->onDelete('cascade');
            $table->string('no_telp');
            $table->bigInteger('id_driver');
            $table->index('id_driver');
            $table->foreign('id_driver')->references('id')->on('t_driver')->onDelete('cascade');
            $table->bigInteger('id_mobil');
            $table->index('id_mobil');
            $table->foreign('id_mobil')->references('id')->on('t_mobil')->onDelete('cascade');
            $table->date('start_date');
            $table->date('finish_date');
            $table->string('jemput');
            $table->string('tujuan');
            $table->time('start_time');
            $table->time('finish_time');
            $table->bigInteger('harga_mobil');
            $table->bigInteger('harga_driver');
            $table->bigInteger('uang_jalan');
            $table->bigInteger('bbm');
            $table->bigInteger('tol_parkir');
            $table->bigInteger('makan_inap');
            $table->bigInteger('overtime');
            $table->bigInteger('biaya_titip');
            $table->bigInteger('biaya_lainnya');
            $table->bigInteger('total_harga');
            $table->bigInteger('diskon');
            $table->bigInteger('ppn');
            $table->bigInteger('pph');
            $table->bigInteger('total_tagihan');
            $table->string('by');
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
