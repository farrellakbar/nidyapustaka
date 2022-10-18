<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBuku extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function konsumen()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Konsumen', 'id_konsumen');
    }
    public function karyawan()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Karyawan', 'id_supervisor');
    }
    public function gudangPenyimpanans()
    {
        return $this->belongsToMany('App\Models\GudangPenyimpanan', 
                                    'detail_penjualan', 
                                    'id_nota_penjualan',
                                    'id_pp', 
                                    'kode_lp')->withPivot('jumlahPenjualan', 'subTotal');
    }
    // public function bukus(){
    //     return $this->belongsToMany('App\Models\Buku',
    //                                 'detail_penjualan',
    //                                 'id_nota_penjualan',
    //                                 'id_buku')->withPivot('jumlahPenjualan','subTotal');
    // }
 
    // public function gudangPenyimpanan()
    // {
        
    //     return $total; 
    // } 
}
