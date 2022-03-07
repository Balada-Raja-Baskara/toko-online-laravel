<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    protected $table = 'detail_transaksi';
    public $timestamps = false;

    protected $fillable = ['id_transaksi','id_produk','qty','subtotal'];
}
