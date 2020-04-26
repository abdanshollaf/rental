<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCashflowDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cashflow_delete', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_master_cashflow');
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
