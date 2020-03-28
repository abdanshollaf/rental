<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use DB;

class CustomerModel extends Model
{
    protected $table = 't_pelanggan';
    protected $fillable = ['nama_pelanggan','email','alamat','no_telp','tgl_lahir','id_tipe_pelanggan','status_order'];
}
