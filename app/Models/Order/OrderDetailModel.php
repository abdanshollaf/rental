<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use DB;

class OrderDetailModel extends Model
{
    protected $table = 't_order_detail';
    protected $fillable = ['id_order', 'id_tipe_pelanggan', 'id_driver', 'start_date', 'finish_date', 'km_awal', 'km_akhir', 'start_time', 'finish_time', 'id_mobil', 'harga_mobil', 'harga_driver', 'uang_jalan', 'bbm', 'tol_parkir', 'makan_inap', 'overtime', 'biaya_titip', 'biaya_lainnya', 'biaya_claim', 'total_harga', 'diskon', 'ppn', 'pph', 'total_tagihan', 'by','pic','hp_pic'];

    protected static function getbyOrder($id)
    {
        $sql = "select * from t_order_detail where id_order = '".$id."'";
        return DB::select($sql);
    }
}