<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Trigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER t_t_order_delete AFTER DELETE ON `t_order` FOR EACH ROW
                BEGIN
                   INSERT INTO `t_order_delete` (`id`,`id_tipe_pelanggan`,`id_pelanggan`,`nama_pelanggan`,
                                                `no_telp`,`email`,`estimated`,`actual`,
                                                `status`,`dibayar`,`oleh`,`dihapus`, `note`,
                                                `created_at`,`updated_at`)
                    VALUES (OLD.id, OLD.id_tipe_pelanggan, OLD.id_pelanggan, OLD.nama_pelanggan,
                                                OLD.no_telp, OLD.email, OLD.estimated, OLD.actual,
                                                OLD.status, OLD.dibayar, OLD.oleh, OLD.dihapus, OLD.note,
                                                OLD.created_at, OLD.updated_at);
                END');

        DB::unprepared('CREATE TRIGGER t_t_order_detail_delete AFTER DELETE ON `t_order_detail` FOR EACH ROW
                BEGIN
                   INSERT INTO `t_order_delete` (`id`,`id_order`,`id_tipe_pelanggan`,`id_pelanggan`,
                                                `no_telp`,`id_driver`,`id_mobil`,`pic`,`hp_pic`,`start_date`,
                                                `finish_date`,`jemput`,`tujuan`,`start_time`,
                                                `finish_time`,`km_awal`,`km_akhir`,`harga_mobil`,`harga_driver`,`uang_jalan`,`bbm`,`tol_parkir`,
                                                `makan_inap`,`overtime`,`biaya_titip`,`biaya_lainnya`, `biaya_claim`,`total_harga`,`diskon`,
                                                `ppn`,`pph`,`total_tagihan`,`by`,`created_at`,`updated_at`)
                    VALUES (OLD.`id`, OLD.`id_order`, OLD.`id_tipe_pelanggan`, OLD.`id_pelanggan`,
                                                OLD.`no_telp`, OLD.`id_driver`, OLD.`id_mobil`, OLD.`pic`,OLD.`hp_pic`, OLD.`start_date`,
                                                OLD.`finish_date`, OLD.`jemput`, OLD.`tujuan`, OLD.`start_time`,
                                                OLD.`finish_time`, OLD.`km_awal`, OLD.`km_akhir`, OLD.`harga_mobil`, OLD.`harga_driver`,
                                                OLD.`uang_jalan`, OLD.`bbm`, OLD.`tol_parkir`, OLD.`makan_inap`,
                                                OLD.`overtime`, OLD.`biaya_titip`, OLD.`biaya_lainnya`, OLD.`biaya_claim`, OLD.`total_harga`, OLD.`diskon`,
                                                OLD.`ppn`, OLD.`pph`, OLD.`total_tagihan`, OLD.`by`, OLD.`created_at`, `OLD.updated_at`);
                END');

                DB::unprepared('CREATE TRIGGER t_t_cashflow_delete AFTER DELETE ON `t_cashflow` FOR EACH ROW
                BEGIN
                   INSERT INTO `t_cashflow_delete` (`id`,`id_order`,`id_master_cashflow`,`amount`,
                                                `oleh`,`dihapus`,
                                                `created_at`,`updated_at`)
                    VALUES (OLD.`id`,OLD.`id_order`,OLD.`id_master_cashflow`,OLD.`amount`,
                                                OLD.`oleh`,OLD.`dihapus`,
                                                OLD.`created_at`,OLD.`updated_at`);
                END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
