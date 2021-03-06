<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TOrderDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_order_delete', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('id_invoice')->nullable();
            $table->unsignedBigInteger('id_tipe_pelanggan');
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('nama_pelanggan')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('estimated')->default(0);
            $table->bigInteger('actual')->default(0);
            $table->string('status')->nullable();
            $table->bigInteger('dibayar')->nullable();
            $table->string('oleh')->nullable();
            $table->string('dihapus')->nullable();
            $table->string('note')->nullable();
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
