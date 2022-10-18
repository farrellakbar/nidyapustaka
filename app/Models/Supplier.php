<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function sediaanBahanBakus()
    {
        // model Karyawan   nama field di Sediaans
        return $this->hasMany('App\models\SediaanBahanBaku', 'id_supplier', 'id');
    }
}
