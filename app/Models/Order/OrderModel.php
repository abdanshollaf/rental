<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 't_order';
    protected $fillable = ['id_tipe_pelanggan','id_invoice','id_pelanggan','nama_pelanggan','no_telp','email','estimated','actual','dibayar','oleh','note','dihapus'];
}