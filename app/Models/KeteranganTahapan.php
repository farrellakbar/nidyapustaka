<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganTahapan extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function linimasa()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\Linimasa', 'id_keterangan_tahapan', 'id');
    }
}
