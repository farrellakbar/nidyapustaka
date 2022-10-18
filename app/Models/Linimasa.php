<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linimasa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="linimasa_proses_produksis";  
    public function prosesProduksi()
    {
        return $this->belongsTo('App\models\Produksi', 'id_proses_produksi');
    }
    public function keteranganTahapan()
    {
        return $this->belongsTo('App\models\KeteranganTahapan', 'id_keterangan_tahapan');
    }
    public function sediaanBahanBaku()
    {
        return $this->belongsTo('App\models\SediaanBahanBaku', 'id_sediaan_bahan_baku');
    }
}
