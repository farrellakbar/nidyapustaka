<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class RiwayatPerawatan extends Model
{
    public $timestamps = false;
    protected $table="riwayat_perawatans";
    use HasFactory;
    public function inventaris()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Inventaris', 'kode_inventaris');
    }

}
