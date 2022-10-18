<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function karyawans()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\Karyawan', 'id_agama', 'id');
    }
}
