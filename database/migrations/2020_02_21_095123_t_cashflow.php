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
            $table->bigInteger('id_order');
            $table->index('id_order');
            $table->foreign('id_order')->references('id')->on('t_order')->onDelete('cascade');
            $table->bigInteger('id_master_cashflow');
            $table->index('id_master_cashflow');
            $table->foreign('id_master_cashflow')->references('id')->on('t_master_cashflow')->onDelete('cascade');
            $table->bigInteger('amount');
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
