<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function penjualanBukus()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\PenjualanBuku', 'id_konsumen', 'id');
    }
}
 