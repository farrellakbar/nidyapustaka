<?php

namespace App\Http\Controllers;

use App\Models\Linimasa;
use App\Models\Produksi;
use App\Models\KeteranganTahapan;
use App\Models\SediaanBahanBaku;
use DB;


use Illuminate\Http\Request;

class LinimasaTahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Linimasa::where("id_proses_produksi");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Linimasa();
        // $data->id =  str_random(3).substr(time(), 6,8).str_random(3);
        $id = $request->get('id_Produksi');
        $idKet = $request->get('id_keterangan');
        $idSediaan = $request->get('id_sediaan');
        $jmlPenggunaan = $request->get('jumlah');


        $data->tanggal =  now(); 
        $data->id_keterangan_tahapan =  $idKet;
        $data->id_sediaan_bahan_baku  =  $idSediaan;
        $data->jumlahPenggunaan =  $jmlPenggunaan;
        $data->id_proses_produksi  =  $id;
        $data->save();

        $idProduksi = KeteranganTahapan::select('tahap')
                           ->where('id', '=', $idKet)
                           ->get();

        $produksi = Produksi::find($id);
        $produksi->tahap  = $idProduksi[0]->tahap;
        $produksi->save();
        // dd($idProduksi);
 
        if (isset($idSediaan)) {
            $sediaan = SediaanBahanBaku::find($idSediaan);
            $stokSebelum = $sediaan->jumlahSediaan;
            $stokSesudah = $stokSebelum - $jmlPenggunaan;
            $sediaan->jumlahSediaan = $stokSesudah;
            $sediaan->save();
        }

        return redirect()->back()->with('status','Data Produksi Pada Linimasa Berhasil Di update');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function show(Linimasa $linimasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function edit(Linimasa $linimasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Linimasa $linimasa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Linimasa  $linimasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Linimasa $linimasa)
    {
        // 
    }

    public function keranjangBuku()
    {
        $idBuku = request('idBuku');
        $jumlahBuku = request('jumlahBuku');

        $data = DB::table('proses_produksis as  pp')
        ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
        ->join('bukus as b', 'b.id', '=', 'pp.id_buku')
        ->where('b.id','=',$idBuku)
        ->where('gp.jumlah','!=','0')
        ->groupBy('b.nama')
        ->select( 'b.id','b.nama', 'b.halaman', 'b.lebar','b.panjang','b.kategoris','b.foto','gp.kode_lokPenyimpanan', DB::raw('sum(gp.jumlah) as jumlahBuku'), DB::raw('max(gp.harga) as harga'))
        ->first();

        $KeranjangPenjualan = session()->get('KeranjangPenjualan');
        if($KeranjangPenjualan[$idBuku]['jumlahPenjualan'] < $data->jumlahBuku)
        {
            $KeranjangPenjualan[$idBuku]['jumlahPenjualan'] = $jumlahBuku;
        }
        session()->put('KeranjangPenjualan', $KeranjangPenjualan);

        $option = '<input type="number" value="'.$jumlahBuku.'" name="jumlahBuku" min="100" step="50" class="form-control" id="jumlahBuku" placeholder="Jumlah" required>';
        return $option;
    }
}
