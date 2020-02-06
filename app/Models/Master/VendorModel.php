<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    protected $table = 't_vendor';
    protected $fillable = ['nama','alamat','penanggungjawab','no_telp'];

}
