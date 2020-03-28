<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class CashflowModel extends Model
{
    protected $table = 't_cashflow';
    protected $fillable = ['amount','oleh','dihapus'];
}
