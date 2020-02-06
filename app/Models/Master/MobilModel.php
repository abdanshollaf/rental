<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MobilModel extends Model
{
    protected $table = 't_mobil';
    protected $fillable = ['id_vendor','no_polisi','merk','tipe','vendor','jumlah_seat'];

}
