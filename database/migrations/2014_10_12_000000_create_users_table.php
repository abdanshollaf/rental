<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('t_vendor',function(Blueprint $table){
            $table->bigIncrements('id_vendor');
            $table->string('nama');
            $table->string('alamat');
            $table->string('penanggungjawab');
            $table->string('no_telp');
            $table->timestamps();
        });
        Schema::create('t_pelanggan',function(Blueprint $table){
            $table->bigIncrements('id_customer');
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->string('no_telp');
            $table->date('tgl_lahir');
            $table->timestamps();
        });
        Schema::create('t_mobil',function(Blueprint $table){
            $table->bigIncrements('id_mobil');
            $table->string('id_vendor')->references('id_vendor')->on('t_vendor')->onDelete('cascade');
            $table->string('no_polisi');
            $table->string('merk');
            $table->string('tipe');
            $table->string('vendor');
            $table->string('jumlah_seat');
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
        Schema::dropIfExists('users');
    }
}
