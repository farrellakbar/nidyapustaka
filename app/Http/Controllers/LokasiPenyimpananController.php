<?php

namespace App\Http\Controllers;

use App\Models\LokasiPenyimpanan;
use App\Models\Produksi;
use App\Models\Buku;


use Illuminate\Http\Request;
use DB;


class LokasiPenyimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = DB::select(DB::raw("select * from lokasi_penyimpanans"));
        // $data2  = DB::select(DB::raw("SELECT  pp.id as idProduksi, b.nama as namaBuku, gp.jumlah as jumlahBuku, gp.kode_lokPenyimpanan as tempatPenyimpanan, gp.tanggalMasuk as tanggal
        // FROM gudang_penyimpanans gp INNER JOIN 
        // (proses_produksis pp INNER JOIN bukus b
        //  ON pp.id_buku = b.id)
        // on gp.id_proProduksi = pp.id"));
        // $queryEloquent = Produksi::all();  
        $data2 = DB::table('proses_produksis as pp')
        ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
        ->join('bukus as b', 'b.id', '=', 'pp.id_buku')
        ->select('pp.id', 'gp.jumlah','b.nama' ,'gp.kode_lokPenyimpanan','gp.tanggalMasuk')
        ->where('gp.jumlah', '>=', 1)
        ->get();
        // DD($data2);

        return view('lokasiPenyimpanan.index', compact('data','data2'));
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
        $gudang =  strtoupper($request->get('gudang'));;
        $lantai =  $request->get('lantai');
        $posisi =  strtoupper($request->get('posisi'));;
        $kapasitasMaksimal =  $request->get('kapasitasMaksimal');
        $kode =  $gudang.$lantai."-".$posisi;
        $jmlTerkini = 0;



        $data = new LokasiPenyimpanan();
        $data->kode =  $kode;
        $data->gudang =  $gudang;
        $data->lantai =  $lantai;
        $data->posisi =  $posisi;
        $data->kapasitasMaksimal =  $kapasitasMaksimal;
        $data->jumlahTerkini =  $jmlTerkini;

        $persenStatus = $jmlTerkini/$kapasitasMaksimal*100/100;
        if($persenStatus < 0.7)
        {
            $data->status =  "Tersedia";
        }
        elseif($persenStatus < 1){
            $data->status =  "Hampir Penuh";
        }
        else{
            $data->status =  "Penuh";
        }
        $data->save();
    
        return redirect()->route('lokasiPenyimpanan.index')->with('status2','Data Lokasi Penyimpanan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LokasiPenyimpanan  $lokasiPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiPenyimpanan $lokasiPenyimpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LokasiPenyimpanan  $lokasiPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiPenyimpanan $lokasiPenyimpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LokasiPenyimpanan  $lokasiPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LokasiPenyimpanan $lokasiPenyimpanan)
    {
        $kode=$request->get('kode');
        $lokasiPenyimpanan = LokasiPenyimpanan::find($kode);

        $kapasitasMaksimal = $request->get('kapasitas');
        $jmlTerkini = $lokasiPenyimpanan->jumlahTerkini;

        $lokasiPenyimpanan->kapasitasMaksimal =$kapasitasMaksimal;
        $persenStatus = $jmlTerkini/$kapasitasMaksimal*100/100;

        if($persenStatus < 0.7)
        {
            $lokasiPenyimpanan->status =  "Tersedia";
        }
        elseif($persenStatus < 1){
            $lokasiPenyimpanan->status =  "Hampir Penuh";
        }
        else{
            $lokasiPenyimpanan->status =  "Penuh";
        }
        $lokasiPenyimpanan->save();
        return redirect()->route('lokasiPenyimpanan.index')->with('status2','Data Lokasi Penyimpanan Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LokasiPenyimpanan  $lokasiPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiPenyimpanan $lokasiPenyimpanan)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $kode=$request->get('kode');
        // dd($kode);
        $data=LokasiPenyimpanan::find($kode);
       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lokasiPenyimpanan.getEditForm', compact('data','kode'))->render()
        ),200);  
    }
    public function produksiSelesai(Request $request)
    {
        $idProduksi=$request->get('idProduksi');
        $prosesProduksi = Produksi::find($idProduksi);
        $prosesProduksi->tahap =  "selesai";
        $prosesProduksi->tanggalSelesai =  now();
        $prosesProduksi->save();
        $buku = Buku::find($prosesProduksi->id_buku);

        $idLokasiPenyimpanan = $request->get('kode_lokasiPenyimpanan');
        $jumlah = $request->get('jumlah');
        session()->put('jumlahS', $jumlah);

        $data = LokasiPenyimpanan::whereIn('kode',$idLokasiPenyimpanan)
                                    ->orderBy('jumlahTerkini', 'DESC')
                                    ->get();
        foreach ($data as $p) {
            $jumlahS = session()->get('jumlahS');
            $ruangTersedia = ((int)$p->kapasitasMaksimal- (int)$p->jumlahTerkini);
            if($ruangTersedia < $jumlahS)
            {
                $jmls = $jumlahS - $ruangTersedia;
                $jml = $jumlahS - $jmls;

                $p->jumlahTerkini = $p->jumlahTerkini + $jml;
                session()->put('jumlahS', $jmls);
            }
            else{
                $jml = $jumlahS;
                $p->jumlahTerkini = $p->jumlahTerkini + $jml;
                session()->put('jumlahS', $jml);
            }
            $p->save();
            $persenStatus =  $p->jumlahTerkini/$p->kapasitasMaksimal*100/100;
            if($persenStatus < 0.7)
            {
                $p->status =  "Tersedia";
            }
            elseif($persenStatus < 1){
                $p->status =  "Hampir Penuh";
            }
            else{
                $p->status =  "Penuh";
            }
            $p->save();

            $gudang = session()->get('gudang');
            $gudang[$p->kode]=[
                'idProduksi' => $idProduksi,
                'kodeLokasiPenyimpanan' => $p->kode,
                'jumlah' => $jml,
                'harga' => $buku->harga,
            ];
            session()->put('gudang', $gudang);
        }
        $produksi = Produksi::find($idProduksi);
        $produksi->insertGudangPenyimpanan($gudang);
        session()->forget('gudang');
        session()->forget('jumlahS');
        return redirect()->route('lokasiPenyimpanan.index')->with('status','Data Produksi Buku Berhasil Terselesaikan!');
    }
}
