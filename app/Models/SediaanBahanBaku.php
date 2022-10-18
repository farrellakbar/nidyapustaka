<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SediaanBahanBaku extends Model
{
    use HasFactory;
    public $timestamps = false;

    // public function sediaanBahanBaku()
    // {
    //     // model Kelamin   nama field di karyawwans
    //     return $this->belongsTo('App\models\SediaanBahanBaku', 'id');
    // }

    public function supplier()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Supplier', 'id_supplier');
    }

    public function kategoriBahanBaku()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\KategoriBahanBaku', 'id_kategori_bahan_baku'); 
    }
    public function linimasas()
    {
        return $this->hasMany('App\models\Linimasa', 'id_sediaan_bahan_baku', 'id');
    }
}
