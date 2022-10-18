<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="proses_produksis";  
    public function buku()
    {
        // model Agama   nama field di karyawwans
        return $this->belongsTo('App\models\Buku', 'id_buku');
    }
    public function linimasa()
    {
        // model Karyawan   nama field di karyawans
        return $this->hasMany('App\models\Linimasa', 'id_proses_produksi', 'id');
    }
    public function lokasiPenyimpanans(){
        return $this->belongsToMany('App\Models\LokasiPenyimpanan',
                                    'gudang_penyimpanans',
                                    'id_proProduksi',
                                    'kode_lokPenyimpanan')->withPivot('tanggalMasuk','jumlah','harga');
    }

    public function insertGudangPenyimpanan($gudang)
    {
        $pesan = "sukses";
        foreach($gudang as $id_lok => $details)
        {
             $this->lokasiPenyimpanans()->attach($id_lok,
                                    ['id_proProduksi'=>$details['idProduksi'],
                                     'kode_lokPenyimpanan'=>$details['kodeLokasiPenyimpanan'],
                                     'tanggalMasuk'=>now(),
                                     'jumlah'=>$details['jumlah'],
                                     'harga'=>$details['harga'],
                                    ]);
        }
        return $pesan;
    }
    // public function updateGudangPenyimpanan($gudang)
    // {
    //     $pesan = "sukses";
    //     foreach((array)$gudang as $id_lok => $details)
    //     {
    //         $this->lokasiPenyimpanans()->sync([$id_lok =>['jumlah'=>$details['update'],
    //                                                         'kode_lokPenyimpanan'=>$details['kodeLokPeny'],
    //                                                         'id_proProduksi'=>$details['idProduksi']
    //                                                     ]
    //                                             ]);
    //     }
    //     return $pesan;
    // }
}
