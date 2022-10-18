<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    public $timestamps = false; 
    // protected $primaryKey = 'id_user';


    public function agama()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Agama', 'id_agama');
    }
    public function kelamin()
    {
        // model Kelamin   nama field di karyawwans
        return $this->belongsTo('App\models\Kelamin', 'id_kelamin');
    }
    public function user()
    {
        // model Kelamin   nama field di karyawwans
        return $this->belongsTo('App\models\User', 'id');
    }

    public function pembelianBahanBakus()
    {
        // model Karyawan   nama field di pembelianBahanBakus
        return $this->hasMany('App\models\PembelianBahanBaku', 'id_karyawan', 'id');
    }

    public function penjualanBukus()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\PenjualanBuku', 'id_supervisor', 'id');
    }
}
