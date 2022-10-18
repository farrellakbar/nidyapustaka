<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBahanBaku extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function sediaanBahanBakus()
    {
        return $this->hasMany('App\models\SediaanBahanBaku', 'id_kategori_bahan_baku', 'id');
    }
}
