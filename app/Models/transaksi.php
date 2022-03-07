<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;

    protected $fillable = ['id_transaksi','id_petugas','id_pelanggan','tgl_transaksi'];
}
