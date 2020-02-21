<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterCashflowModel extends Model
{
    protected $table = 't_master_cashflow';
    protected $fillable = ['nama','keterangan'];
}
