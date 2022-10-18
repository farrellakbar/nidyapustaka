<?php

namespace App\Http\Controllers;

use App\Models\PenjualanBuku;
use App\Models\Inventaris;
use App\Models\Karyawan;
use App\Models\Produksi;
use App\Models\Buku;
use App\Models\Konsumen;
use App\Models\PembelianBahanBaku;
use App\Models\SediaanBahanBaku;
use App\Models\Ekspedisi;
use App\Models\GudangPenyimpanan;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class PenjualanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenjualanBuku  $penjualanBuku
     * @return \Illuminate\Http\Response
     */
    public function show(PenjualanBuku $penjualanBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenjualanBuku  $penjualanBuku
     * @return \Illuminate\Http\Response
     */
    public function edit(PenjualanBuku $penjualanBuku)
    {
        $this->authorize('aksesProsesPenjualan-permission');

        $dataBuku = $penjualanBuku;
        $data = PenjualanBuku::where('id','=', $dataBuku->id)
                                ->first();

        $dataKaryawan = DB::table('karyawans as k')
                        ->join('users as u', 'u.id', '=', 'k.id')
                        ->where('u.role','=','pelaksana')
                        ->get(); 
        $dataEkspedisi = Ekspedisi::all();
        $dataInventaris = Inventaris::whereNotNull('platNomor')
                            ->get();
        $dataPenjualan = PenjualanBuku::all();
        $datas = DB::select("SELECT dp.id_nota_penjualan as idNota,dp.kode_lp ,b.nama, SUM(jumlahPenjualan) as jumlah, ROUND(dp.subTotal/dp.jumlahPenjualan) as harga, dp.subTotal, pb.*
                FROM 
                ((SELECT * 
                FROM detail_penjualan) dp INNER JOIN penjualan_bukus pb
                on dp.id_nota_penjualan = pb.id)
                INNER JOIN 
                ((SELECT * 
                FROM proses_produksis) pp INNER JOIN bukus b
                    ON pp.id_buku = b.id)
                ON dp.id_pp = pp.id
                WHERE dp.id_nota_penjualan = ?
                GROUP BY dp.id_pp", [$dataBuku->id]); 

        return view('pengiriman.proses', compact('data','datas','dataKaryawan','dataEkspedisi','dataInventaris'));

        // $data = PenjualanBuku::where('id', $id)
        //             ->get();
        // $dataKaryawan = Karyawan::all();
        // $dataEkepedisi = Ekspedisi::all();

        // return view('pengiriman.proses', compact('data','dataKaryawan','dataEkepedisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenjualanBuku  $penjualanBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenjualanBuku $penjualanBuku)
    {
        
        $id=$request->get('id');

        $radio = $request->get('optionsRadios');
        $data = PenjualanBuku::find($id);
        if($radio == 'kirim')
        {
            $id_pengirim1 = $request->get('id_pengirim1');
            $id_pengirim2 = $request->get('id_pengirim2');
            if($id_pengirim1 <>  $id_pengirim2)
            {
                $data->tanggalPengiriman = now();
                $data->id_pengirim1 = $id_pengirim1;
                $data->id_pengirim2 = $id_pengirim2;
                $data->kode_kendaraan = $request->get('kode_kendaraan');
                $data->id_ekspedisi = $request->get('id_ekspedisi');
                $data->status = 'pengiriman'; 
                $data->save();
                return redirect()->route('pengiriman.index')->with('success','Data Pengiriman Berhasil DiProses.');
            }
            else if(!$id_pengirim1){
                return redirect()->back()->with('error', 'Pengirim dan kode kendaraan harap diisi.'); 
            }
            else{
                return redirect()->back()->with('error', 'Proses pengiriman gagal, pengirim tidak boleh sama.'); 
            }
            
        }
        else{
            $data->tanggalSelesai = now();
            $data->status = 'selesai';
            $data->save();
            return redirect()->route('penjualanBuku.riwayatPenjualan')->with('success', 'Penjualan buku selesai!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenjualanBuku  $penjualanBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenjualanBuku $penjualanBuku)
    {
        //
    }
    public function tambahKeranjangPenjualan($idBuku)
    {
        $data = DB::table('proses_produksis as  pp')
        ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
        ->join('bukus as b', 'b.id', '=', 'pp.id_buku')
        ->where('b.id','=',$idBuku)
        ->where('gp.jumlah','!=','0')
        ->groupBy('b.nama')
        ->select( 'b.id','b.nama', 'b.halaman', 'b.lebar','b.panjang','b.kategoris','b.foto','gp.kode_lokPenyimpanan', DB::raw('sum(gp.jumlah) as jumlahBuku'), DB::raw('max(gp.harga) as harga'))
        ->first();

        if(!$data){
            abort('404');
        }

        $KeranjangPenjualan = session()->get('KeranjangPenjualan');
        if(!isset($KeranjangPenjualan[$idBuku]))
        {
            $KeranjangPenjualan[$idBuku]=[
                'nama' => $data->nama,
                'jumlahPenjualan' => 100,
                'foto' => $data->foto,
            ];
            $status = "success";
            $msg = " Buku berhasil masuk keranjang!";
        }
        else 
        {
            if($KeranjangPenjualan[$idBuku]['jumlahPenjualan'] < $data->jumlahBuku)
            {
                $KeranjangPenjualan[$idBuku]['jumlahPenjualan'] += 50;
                $status = "success";
                $msg = " Jumlah Buku berhasil ditambah!";
            }
            else{
                $status = "error";
                $msg = " Jumlah Buku gagal ditambah!";
            }
        }
        session()->put('KeranjangPenjualan', $KeranjangPenjualan);

        return redirect()->back()->with($status, $msg);
    }
    public function keranjangPenjualan()
    {
        $this->authorize('aksesKeranjangPenjualan-permission');

        $data = Inventaris::all();
        $data2 = Karyawan::all();
        $data3 = Konsumen::all();

        return view('penjualanBuku.keranjang',compact('data','data2','data3'));
    }
    public function submitcheckout(Request $request)
    {
        try
        {
            $KeranjangPenjualan = session()->get('KeranjangPenjualan');
            $user=Auth::user();
    
            date_default_timezone_set("Asia/Jakarta");
            $nonota = date("dmy").date("His");
    
            $t=new PenjualanBuku;
            $t->id = $nonota;
            $t->totalHarga = 0;
            $t->tanggalPenjualan = now();
            $t->id_supervisor  = $user->id;
            $t->id_konsumen  = $request->get('id_konsumen');
            $t->status  = 'proses';
            $t->save();

            $total = 0;
            // looping buku
            foreach($KeranjangPenjualan as $idBuku => $details)
            {
                session()->forget('jmlSementara');  

                $data2 = DB::table('proses_produksis as  pp')
                ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
                ->where('pp.id_buku','=',$idBuku)
                ->where('gp.jumlah','<>',0)
                ->orderBy('gp.tanggalMasuk')
                ->select('gp.id_proProduksi','gp.kode_lokPenyimpanan','gp.jumlah','gp.harga')
                ->get();
                //START looping gudang penyimpanan id_buku tertentu (buku yg dijual) 
                    foreach($data2 as $key => $p)
                    {    
                        $jumlahSediaanGudang =  $p->jumlah;
                        $jmlBelumAmbil = session()->get('jmlSementara');
                        if(!isset($jmlBelumAmbil)){
                            $jmlPenjualan = $KeranjangPenjualan[$idBuku]['jumlahPenjualan'];
                            if($jumlahSediaanGudang < $jmlPenjualan){
                                $jmlBelumAmbil = $jmlPenjualan - $jumlahSediaanGudang;   
                                $updateJmlSediaanGudang = 0;
                                $jmlAmbil = $jumlahSediaanGudang;
                            }
                            else{
                                $updateJmlSediaanGudang = $jumlahSediaanGudang - $jmlPenjualan;  
                                $jmlBelumAmbil = 0;   
                                $jmlAmbil = $jmlPenjualan;
                            }
                            session()->put('jmlSementara', $jmlBelumAmbil);
                            $idProduksi = $p->id_proProduksi;
                            $kodeLokPenyimpanan = $p->kode_lokPenyimpanan;
                            $update = $updateJmlSediaanGudang;

                            DB::table('detail_penjualan')->insert(
                                array('id_pp' => $idProduksi,
                                      'kode_lp' => $kodeLokPenyimpanan,
                                      'id_nota_penjualan' => $nonota,
                                      'jumlahPenjualan' => $jmlAmbil,
                                      'subTotal' =>  $p->harga * $jmlAmbil)
                            );
                        }
                        else{
                            if($jmlBelumAmbil >= 1)
                            {
                                if($jumlahSediaanGudang < $jmlBelumAmbil){
                                    $jmlBelumAmbil = $jmlBelumAmbil - $jumlahSediaanGudang; 
                                    $updateJmlSediaanGudang = 0;  
                                    $jmlAmbil = $jumlahSediaanGudang;
                                }
                                else{
                                    $updateJmlSediaanGudang = $jumlahSediaanGudang - $jmlBelumAmbil; 
                                    $jmlAmbil = $jmlBelumAmbil;
                                    $jmlBelumAmbil = 0;  
                                }
                                session()->put('jmlSementara', $jmlBelumAmbil);
                                $idProduksi = $p->id_proProduksi;
                                $kodeLokPenyimpanan = $p->kode_lokPenyimpanan;
                                $update = $updateJmlSediaanGudang;

                                DB::table('detail_penjualan')->insert(
                                    array('id_pp' => $idProduksi,
                                          'kode_lp' => $kodeLokPenyimpanan,
                                          'id_nota_penjualan' => $nonota,
                                          'jumlahPenjualan' => $jmlAmbil,
                                          'subTotal' =>  $p->harga * $jmlAmbil)
                                );
                            }
                        }
             
                        DB::update('update gudang_penyimpanans 
                                    set jumlah = '.$update.'
                                    where 
                                    id_proProduksi = ? AND kode_lokPenyimpanan = ?' ,[$idProduksi,$kodeLokPenyimpanan]);
                    }
                //END looping gudang penyimpanan id_buku tertentu (buku yg dijual)
                $total +=  $p->harga * $details['jumlahPenjualan'];
            }

            $t->totalHarga = $total;
            $t->save(); 
            session()->forget('KeranjangPenjualan');  

            return redirect()->route('pengiriman.index')->with('success', 'Penjualan buku sukses ditambahkan!');
        } 
        catch(\PDOException $e){
            return redirect()->route('pengiriman.index')->with('eror', 'Penjualan buku gagal ditambahkan!');
        }
    }
    public function riwayatPenjualan()
    {
        $data = PenjualanBuku::where('status','=','selesai')
                                ->get();

        return view('penjualanBuku.riwayatPenjualan', compact('data'));
    }

    public function pengiriman()
    {
        $data = PenjualanBuku::where('status','=','proses')
                                ->orWhere('status','=','pengiriman')
                                ->get();    
        $dataEkspedisi = Ekspedisi::all();
    
        // $data2 = Karyawan::all();
        // $data3 = Konsumen::all();

        return view('pengiriman.index',compact('data','dataEkspedisi'));
    }

    public function selesai($id)
    {
        $data = PenjualanBuku::find($id);
        $data->tanggalSelesai = now();
        $data->status = 'selesai';

        $data->save();

        return redirect()->route('penjualanBuku.riwayatPenjualan')->with('success', 'Penjualan buku selesai!');
    }
    public function detail($idNota)
    {
        $datas = DB::select("SELECT dp.id_nota_penjualan as idNota,dp.kode_lp ,b.nama, SUM(jumlahPenjualan) as jumlah, ROUND(dp.subTotal/dp.jumlahPenjualan) as harga, dp.subTotal, pb.*
                FROM 
                ((SELECT * 
                FROM detail_penjualan) dp INNER JOIN penjualan_bukus pb
                on dp.id_nota_penjualan = pb.id)
                INNER JOIN 
                ((SELECT * 
                FROM proses_produksis) pp INNER JOIN bukus b
                    ON pp.id_buku = b.id)
                ON dp.id_pp = pp.id
                WHERE dp.id_nota_penjualan = ?
                GROUP BY dp.id_pp", [$idNota]); 

        $dataPb = PenjualanBuku::where('id',$idNota)
                                ->get();
        // dd($datas);
        $dd = PenjualanBuku::find($idNota);
        $datacoba = $dd->gudangPenyimpanans;
        return view('penjualanBuku.getDetailForm', compact('datas','dataPb','datacoba'));
    }

    public function detailGudang(Request $request)
    {
        $idNota = $request->get("idNota");
        $hariEstimasiToTanggal = date('d-m-Y',strtotime($hariEstimasi."days", strtotime(now())));

        return response()->json(array(
            'status'=>'ok',
            'msg'=>$hariEstimasiToTanggal,
        ),200);  
    }

    // public function showGP(Request $request)
    // {
    //     $idNota = $request->get("id");
    //     $datas = DB::select("SELECT * 
    //     FROM penjualan_bukus pp LEFT JOIN detail_penjualan dp
    //     on pp.id = dp.id_nota_penjualan 
    //     where pp.id = ?", [$idNota]); 
    //     $ii = '@foreach($datas as $d)<input type="text" value="" name="waktuPengerjaan" class="form-control" id="waktuPengerjaan" readonly>@endforeach';


    //     return response()->json(array(
    //         'status'=>'ok',
    //         'msg'=>$ii,
    //     ),200);  
    // }
}