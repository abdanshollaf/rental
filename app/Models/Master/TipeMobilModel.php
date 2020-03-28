<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class TipeMobilModel extends Model
{
    protected $table = 't_tipe_mobil';
    protected $fillable = ['nama_tipe'];
}
