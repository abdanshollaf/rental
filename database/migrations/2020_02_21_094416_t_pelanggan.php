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
            $table->string('nama_pelanggan')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->unsignedBigInteger('id_tipe_pelanggan');
            $table->foreign('id_tipe_pelanggan')->references('id')->on('t_tipe_pelanggan');
            $table->string('status_order')->nullable();
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
