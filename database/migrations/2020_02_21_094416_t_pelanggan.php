<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pelanggan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pelanggan');
            $table->string('email');
            $table->string('alamat');
            $table->string('no_telp');
            $table->date('tgl_lahir');
            $table->bigInteger('id_tipe_pelanggan');
            $table->index('id_tipe_pelanggan');
            $table->foreign('id_tipe_pelanggan')->references('id')->on('t_tipe_pelanggan')->onDelete('cascade');
            $table->string('status_order');
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
