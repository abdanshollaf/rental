<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    protected $table = 't_order_detail';
    protected $fillable = ['id_order','id_tipe_pelanggan','id_driver','start_date','finish_date','start_time','finish_time','id_mobil','harga_mobil','harga_driver','uang_jalan','bbm','tol_parkir','makan_inap','overtime','biaya_titip','biaya_lainnya','total_harga','diskon','ppn','pph','total_tagihan '];
}
