<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBahanBaku extends Model
{
    use HasFactory;
    public $timestamps = false;

    // public function pembelianBahanBaku()
    // {
    //     // model Kelamin   nama field di karyawwans
    //     return $this->belongsTo('App\models\PembelianBahanBaku', 'id');
    // }

    public function karyawan()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Karyawan', 'id_karyawan');
    }

    public function sediaanBahanBakus(){
        return $this->belongsToMany('App\Models\SediaanBahanBaku',
                                    'detail_pembelian',
                                    'id_nota_pembelian',
                                    'id_sediaan_bahanBaku')->withPivot('jumlahPembelian','subTotal');
    }

    public function insertBahanBaku($keranjang)
    {
        $total = 0;
        // $id_produk dapat dari array atau key produk dari details
        foreach($keranjang as $id_produk => $details)
        {
            $total += $details['harga'] * $details['jumlahSediaan'];
            $this->sediaanBahanBakus()->attach($id_produk,
                                    ['jumlahPembelian'=>$details['jumlahSediaan'],
                                     'subTotal'=>$details['harga'] * $details['jumlahSediaan']
                                    ]);
        }
        return $total;
    }
} 