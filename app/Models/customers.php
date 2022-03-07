<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'customers';
    public $timestamps = false;

    protected $fillable = ['id_pelanggan','nama_pelanggan','alamat','telp','username','password'];
}
