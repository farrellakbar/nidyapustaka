<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelamin extends Model
{
    use HasFactory;
    public $timestamps = false; 

    public function karyawans()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\Karyawan', 'id_kelamin', 'id');
    }
}
