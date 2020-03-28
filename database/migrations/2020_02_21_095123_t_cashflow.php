<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCashflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cashflow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('t_order');
            $table->unsignedBigInteger('id_master_cashflow');
            $table->foreign('id_master_cashflow')->references('id')->on('t_master_cashflow');
            $table->bigInteger('amount')->nullable();
            $table->string('oleh')->nullable();
            $table->string('dihapus')->nullable();
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
