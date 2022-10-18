<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function prosesProduksi()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\Produksi', 'id_buku', 'id');
    }
}
