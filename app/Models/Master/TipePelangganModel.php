<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class TipePelangganModel extends Model
{
    protected $table = 't_tipe_pelanggan';
    protected $fillable = ['nama_tipe_pelanggan'];
}
