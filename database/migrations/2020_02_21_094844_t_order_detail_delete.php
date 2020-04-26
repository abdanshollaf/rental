<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TOrderDetailDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_order_detail_delete', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_tipe_pelanggan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('no_telp');
            $table->unsignedBigInteger('id_driver');
            $table->unsignedBigInteger('id_mobil');
            $table->date('pic')->nullable();
            $table->date('hp_pic')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->string('jemput')->nullable();
            $table->string('tujuan')->nullable();
            $table->time('start_time')->nullable();
            $table->time('finish_time')->nullable();
            $table->bigInteger('km_awal')->default(0);
            $table->bigInteger('km_akhir')->default(0);
            $table->bigInteger('harga_mobil')->default(0);
            $table->bigInteger('harga_driver')->default(0);
            $table->bigInteger('uang_jalan')->default(0);
            $table->bigInteger('bbm')->default(0);
            $table->bigInteger('tol_parkir')->default(0);
            $table->bigInteger('makan_inap')->default(0);
            $table->bigInteger('overtime')->default(0);
            $table->bigInteger('biaya_titip')->default(0);
            $table->bigInteger('biaya_lainnya')->default(0);
            $table->bigInteger('biaya_claim')->default(0);
            $table->bigInteger('total_harga')->default(0);
            $table->bigInteger('diskon')->default(0);
            $table->bigInteger('ppn')->default(0);
            $table->bigInteger('pph')->default(0);
            $table->bigInteger('total_tagihan')->default(0);
            $table->string('by')->nullable();
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