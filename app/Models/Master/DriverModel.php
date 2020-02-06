<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DriverModel extends Model
{
    protected $table = 't_driver';
    protected $fillable = ['nama','no_telp'];
}
