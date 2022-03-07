<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    protected $table = 'petugas';
    public $timestamps = false;

    protected $fillable=['id_petugas','nama_petugas','username','password','level'];
}
