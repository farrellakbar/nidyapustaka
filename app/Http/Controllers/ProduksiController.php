<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Buku;
use App\Models\Linimasa;
use App\Models\KeteranganTahapan;
use App\Models\SediaanBahanBaku;
use App\Models\LokasiPenyimpanan;
use Carbon\Carbon;
use DB;


use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Produksi::all();
        $data = Produksi::where('tahap', null)->get();
        // dd($data);
        $data2 = Produksi::where('tahap', "!=", "selesai")
                            ->whereNotNull('tanggalMulai')->get();
        
        $dataBuku = Buku::all();



        return view('produksi.index',compact('data','dataBuku', 'data2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataBuku = Buku::all(); 

        $this->authorize('aksesTambahProduksi-permission');

        return view('produksi.create',compact('dataBuku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Produksi();
        // $data->id =  str_random(3).substr(time(), 6,8).str_random(3);
        $data->jumlah =  $request->get('jumlah');
        $data->id_buku =  $request->get('id_buku');
        $data->tanggalMulai =  now();

        $data->save();
    
        return redirect()->route('produksi.index')->with('status','Data Pra-Produksi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function show(Produksi $produksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Produksi $produksi)
    {
        $this->authorize('aksesSelesaiProduksi-permission');

        $data = $produksi;
        $dataLokasiPenyimpanan  = DB::select(DB::raw("select * from lokasi_penyimpanans where status ='Tersedia' or status = 'Hampir Penuh'"));
        return view('produksi.getDataProduksi',compact('data','dataLokasiPenyimpanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produksi $produksi)
    {
        // $id=$request->get('id');
        // // dd($kode);
        // // $inventaris = Inventaris::where('kode', $kode)->first();
        // $data = Produksi::where('tanggalMulai', null)->get();
        // $produksi = Produksi::find($id);
        // dd($id);
        // if(!$data)
        // {
        //     $produksi->tanggalSelesai=now();
        //     $produksi->save();
        //     return redirect()->route('inventaris.index')->with('status2','Data Produksi Berhasil terselesaikan');
        // }
        // else
        // {
        //     $produksi->tanggalMulai=now();
        //     $produksi->save();
        //     return redirect()->route('inventaris.index')->with('status2','Data Produksi Berhasil Dimulai');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produksi $produksi)
    {
        //
    }
    public function editMulai($id)
    {
        // $id=$request->get('id');
        // dd($kode);
        // $inventaris = Inventaris::where('kode', $kode)->first();
        $data = Produksi::where('tanggalMulai', null)->get();
        $produksi = Produksi::find($id);
        // dd($id);
        if(!$data)
        {
            $produksi->tanggalSelesai=now();
            $produksi->save();

            return redirect()->route('produksi.index')->with('status2','Data Produksi Berhasil terselesaikan');
        }
        else
        {
            $produksi->tahap = "1";
            $produksi->save();

            $linimasa = new Linimasa();
            $linimasa->tanggal = now();
            $linimasa->id_keterangan_tahapan = 1;
            $linimasa->id_proses_produksi = $id;
            $linimasa->save();


            return redirect()->route('produksi.index')->with('status2','Data Produksi mulai dipersiapkan');
        }
    }
    public function linimasa($id)
    {
        $data = Linimasa::where('id_proses_produksi', $id)->get();
        $idProsesProduksi = Produksi::where('id', $id)->get();;
        $keterangans = KeteranganTahapan::where('tahap', 1)->get();
        
// dd($keterangans);
        $dataKetTahapan = KeteranganTahapan::all();

        $sediaan = SediaanBahanBaku::all();


        // dd($id);
        return view('produksi.linimasa',compact('data', 'dataKetTahapan','sediaan','idProsesProduksi'));
    }

    public function tahap()
    {
        $tahapKet = request('tahapKeterangan');

        $keterangans = KeteranganTahapan::where('tahap', $tahapKet)->get();

        return $keterangans;
    }

    public function tahapan()
    {
        $namaTahap = request('tahapKeterangan');
        $value = "";
        if($namaTahap == 1){
            $value = "Pra-Cetak";
        }
        elseif ($namaTahap == 2){
            $value = "Printing Presses";
        }
        elseif ($namaTahap == 3) {
            $value = "Penyusunan Buku";
        }
        elseif ($namaTahap == 4){
            $value = "Binding";
        }
        elseif ($namaTahap == 5) {
            $value = "Pemotongan";
        }
        elseif ($namaTahap == 6) {
            $value = "Finishing"; 
        }
        $option = '<input type="text" value="'.$value.'" name="namaTahap" class="form-control" id="namaTahap"  placeholder="Tahapan" readonly>';

        return $option;
    }

    public function pemakaianSediaan()
    {
        $idSed = request('id_Sediaan');

        $sediaans = SediaanBahanBaku::where('id', $idSed)->get();
        foreach ($sediaans as $sed) {
            $option = '<input type="number" name="jumlah" min="0" class="form-control" id="jumlah" max="'.$sed->jumlahSediaan.'" placeholder="Jumlah" value="" required>';
        }
        return $option;
    }
    public function labelSatuan()
    {
        $idSed = request('id_Sediaan');

        $sediaans = SediaanBahanBaku::where('id', $idSed)->get();
        foreach ($sediaans as $sed) {
            $option = '<input type="text" value="'.$sed->satuan.'" name="satuan" class="form-control" id="satuan"  placeholder="Satuan" readonly>';
        }
        return $option;
    }

    // public function getDataProduksi(Request $request)
    // {
    //     $this->authorize('aksesSelesaiProduksi-permission');

    //     $id=$request->get('id');
    //     // dd($kode);
    //     $data=Produksi::find($id);
    //     // $dataLokasiPenyimpanan=LokasiPenyimpanan::all();
    //     $dataLokasiPenyimpanan  = DB::select(DB::raw("select * from lokasi_penyimpanans"));

    //    return response()->json(array(
    //         'status'=>'oke',
    //         'msg'=>view('produksi.getDataProduksi', compact('data','id','dataLokasiPenyimpanan'))->render()
    //     ),200);  
    // } 

    public function tersedia2(Request $request)
    {
        $kodLokPenyimpanan = $request->get("idLok");
        $jumlahProduksiBuku = $request->get("jumlah");

        $penyimpanans = LokasiPenyimpanan::where('kode', $kodLokPenyimpanan)->get();
        foreach ($penyimpanans as $p) {
            $ruangTersedia = ((int)$p->kapasitasMaksimal- (int)$p->jumlahTerkini);
            $jmlBelumAmbilLok = $jumlahProduksiBuku - $ruangTersedia;

            $detailLok = LokasiPenyimpanan::where('kode', '=', $p->kode)
                                            ->first();

            $option2 = '<input type="text" value="'.$ruangTersedia.'" name="tersedia" class="form-control" id="tersedia" placeholder="tersedia" readonly>';
            $option4 = '<input type="text" value="Gudang '.$detailLok['gudang']." - Lantai ".$detailLok['lantai']." - Posisi ".$detailLok['posisi'].'" name="detail" class="form-control" id="detail" placeholder="Detail" readonly>';

            $option3 = '';
            if($ruangTersedia < $jumlahProduksiBuku)
            {
                $option="kurang";
                $tambahLokTersedia = LokasiPenyimpanan::where(\DB::raw('(kapasitasMaksimal - jumlahTerkini)'), '>=',$jmlBelumAmbilLok)
                                                        ->where('kode', '<>', $p->kode)
                                                        ->first();
                if(isset($tambahLokTersedia))
                {
                    $rTersedia = ((int)$tambahLokTersedia['kapasitasMaksimal']- (int)$tambahLokTersedia['jumlahTerkini']);
                    $tambahLokasi = '<div class="row"><div class="col-md-4"><div class="form-group"><label for="jumlah" class="control-label">Lokasi Penyimpanan</label><div id="tersedia"> <input type="text" value="'.$tambahLokTersedia['kode'].'" name="kode_lokasiPenyimpanan[]" class="form-control" id="kode_lokasiPenyimpanan" readonly></div></div> </div><div class="col-md-4"><div class="form-group"><label for="jumlah" class="control-label">Detail</label><div id="detail"> <input type="text" value="Gudang '.$tambahLokTersedia['gudang']." - Lantai ".$tambahLokTersedia['lantai']." - Posisi ".$tambahLokTersedia['posisi'].'" name="detail[]" class="form-control" id="detail[]" placeholder="Detail" readonly></div>
                    </div> 
                  </div><div class="col-md-4"><div class="form-group"><label for="jumlah" class="control-label">Ruang Tersedia</label><div id="tersedia"> <input type="text" value="'.$rTersedia.'" name="tersedia[]" class="form-control" id="tersedia[]" placeholder="Ruang Tersedia" readonly></div></div> </div></div></div></div>';  
                    $option3 = $tambahLokasi;
                }
                else{
                    $option3 = '<p><span style="color:red">Gudang Penuh, Tunggu hingga gudang tersedia kembali </span></p>';
                }
            }
            else
            {
                $option = 'cukup';
                $option3 = '';
            }
        }
        return response()->json(array(
            'status'=>'ok',
            'msg'=>$option,
            'msg2'=>$option2,
            'msg3'=>$option3,
            'msg4'=>$option4,
        ),200);  
    }

    public function estimasi(Request $request)
    { 
        $jumlahProduksiBuku = $request->get("jumlah");
        //START  ESTIMASI WAKTU
            if(100 <= $jumlahProduksiBuku && $jumlahProduksiBuku <= 500)
            {
                $rataTahapan = DB::select("SELECT ROUND(AVG(p.selisihHari),0) AS rataPraProduksi
                FROM (SELECT datediff(PP.tanggalSelesai,lp.tanggal) AS selisihHari
                FROM proses_produksis pp INNER JOIN 
                (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
                ON lp.id_keterangan_tahapan = kt.id)
                ON pp.id = lp.id_proses_produksi
                WHERE pp.jumlah >= 100 AND pp.jumlah <= 500 AND pp.tahap = 'selesai'
                GROUP BY pp.id) AS p");
            }
            else if($jumlahProduksiBuku > 500){ 
                $rataTahapan = DB::select(DB::raw("SELECT ROUND(AVG(p.selisihHari),0) AS rataPraProduksi
                                    FROM (SELECT datediff(PP.tanggalSelesai,lp.tanggal) AS selisihHari
                                    FROM proses_produksis pp INNER JOIN 
                                    (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
                                    ON lp.id_keterangan_tahapan = kt.id)
                                    ON pp.id = lp.id_proses_produksi
                                    WHERE pp.jumlah >= 500 AND pp.tahap = 'selesai'
                                    GROUP BY pp.id) AS p"));
            }

            $jmlAntrian = DB::select(DB::raw("SELECT COUNT(pp.id) as jumlahAntrian
            FROM proses_produksis pp LEFT JOIN 
            (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
            ON lp.id_keterangan_tahapan = kt.id)
            ON pp.id = lp.id_proses_produksi
            WHERE lp.id IS null"));

            $rataPraProduksi = DB::select(DB::raw("SELECT ROUND(AVG(p.selisihHari),0) AS rataPraProduksi
            FROM (SELECT datediff(lp.tanggal,pp.tanggalMulai) AS selisihHari
            FROM proses_produksis pp INNER JOIN 
            (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
            ON lp.id_keterangan_tahapan = kt.id)
            ON pp.id = lp.id_proses_produksi
            WHERE kt.tahap = '1'
            GROUP BY pp.id) as p"));

            $jumlahAntrian = json_decode(json_encode($jmlAntrian),true);
            $avgPraPro = json_decode(json_encode($rataPraProduksi),true);
            $avgTahapan = json_decode(json_encode($rataTahapan),true);

            if($jumlahAntrian == 0)
            {
                $hariEstimasi = (int)$avgPraPro[0]['rataPraProduksi'] + (int)$avgTahapan[0]['rataPraProduksi'];

            }
            else{
                $hariEstimasi = (int)$avgPraPro[0]['rataPraProduksi'] * $jumlahAntrian[0]['jumlahAntrian'] + (int)$avgTahapan[0]['rataPraProduksi'];
            }
            $hariEstimasiToTanggal = date('d-m-Y',strtotime($hariEstimasi."days", strtotime(now())));
        //END  ESTIMASI WAKTU

        //START  BAHAN BAKU KERTAS
            $dataKertas = DB::select(DB::raw("SELECT AVG(p.perBuku) AS rataPerBuku
                                                FROM (SELECT sum(lp.jumlahPenggunaan)/pp.jumlah as perBuku
                                                FROM (sediaan_bahan_bakus sd INNER JOIN kategori_bahan_bakus kb
                                                    ON sd.id_kategori_bahan_baku = kb.id) 
                                                    INNER JOIN (linimasa_proses_produksis LP INNER JOIN proses_produksis pp
                                                                ON lp.id_proses_produksi  = pp.id)
                                                ON sd.id = lp.id_sediaan_bahan_baku
                                                WHERE lp.id_sediaan_bahan_baku IS NOT NULL AND kb.nama = 'kertas'
                                                GROUP BY lp.id_proses_produksi) AS p"));

            $estimasi = json_decode(json_encode($dataKertas),true);
            $value = $estimasi[0]['rataPerBuku'] * $jumlahProduksiBuku;
            $kertasEstimasi = round($value, 0);
        //END  BAHAN BAKU KERTAS

        $input = '<input type="text" value="'.$hariEstimasiToTanggal.'" name="waktuPengerjaan" class="form-control" id="waktuPengerjaan" readonly>';
        $input2 = '<input type="text" value="'.$kertasEstimasi.'" name="bahanBaku" class="form-control" id="bahanBaku" readonly>';

        return response()->json(array(
            'status'=>'ok',
            'msg'=>$input,
            'msg2'=>$input2
        ),200);  
    }

    public function estimasiIndex(Request $request)
    {
        $jumlahProduksiBuku = $request->get("jumlah");

        if(100 <= $jumlahProduksiBuku && $jumlahProduksiBuku <= 500)
        {
            $rataProProduksi = DB::select(DB::raw("SELECT ROUND(AVG(p.selisihHari),0) AS rataProProduksi
                                FROM (SELECT datediff(lp.tanggal,pp.tanggalMulai) AS selisihHari
                                FROM proses_produksis pp INNER JOIN 
                                (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
                                ON lp.id_keterangan_tahapan = kt.id)
                                ON pp.id = lp.id_proses_produksi
                                WHERE kt.tahap = '1'
                                GROUP BY pp.id) as p"));
            $rataTahapan = DB::select(DB::raw("SELECT ROUND(AVG(p.selisihHari),0) AS rataProProduksi
                                FROM (SELECT datediff(PP.tanggalSelesai,lp.tanggal) AS selisihHari
                                FROM proses_produksis pp INNER JOIN 
                                (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
                                ON lp.id_keterangan_tahapan = kt.id)
                                ON pp.id = lp.id_proses_produksi
                                WHERE pp.jumlah >= 100 AND pp.jumlah <= 500 AND pp.tahap = 'selesai'
                                GROUP BY pp.id) AS p"));

            $avgPraPro = json_decode(json_encode($rataProProduksi),true);
            $avgTahapan = json_decode(json_encode($rataTahapan),true);
        }
        else{
            $rataProProduksi = DB::select(DB::raw("SELECT ROUND(AVG(p.selisihHari),0) AS rataProProduksi
                                FROM (SELECT datediff(lp.tanggal,pp.tanggalMulai) AS selisihHari
                                FROM proses_produksis pp INNER JOIN 
                                (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
                                ON lp.id_keterangan_tahapan = kt.id)
                                ON pp.id = lp.id_proses_produksi
                                WHERE pp.jumlah >= 500 AND kt.tahap = '1'
                                GROUP BY pp.id) as p"));
            $rataTahapan = DB::select(DB::raw("SELECT ROUND(AVG(p.selisihHari),0) AS rataProProduksi
                                FROM (SELECT datediff(PP.tanggalSelesai,lp.tanggal) AS selisihHari
                                FROM proses_produksis pp INNER JOIN 
                                (linimasa_proses_produksis lp INNER JOIN keterangan_tahapans kt
                                ON lp.id_keterangan_tahapan = kt.id)
                                ON pp.id = lp.id_proses_produksi
                                WHERE pp.jumlah >= 500 AND pp.tahap = 'selesai'
                                GROUP BY pp.id) AS p"));

            $avgPraPro = json_decode(json_encode($rataProProduksi),true);
            $avgTahapan = json_decode(json_encode($rataTahapan),true);
        }
        $hariEstimasi = $avgPraPro[0]['rataProProduksi'] + $avgTahapan[0]['rataProProduksi'];
        // $hariEstimasi = $estimasi." Hari";
        $hariEstimasiToTanggal = date('d-m-Y',strtotime($hariEstimasi."days", strtotime(now())));

        return response()->json(array(
            'status'=>'ok',
            'msg'=>$hariEstimasiToTanggal,
        ),200);  
    }
    public function getDataProduksi()
    {
        $produksi = DB::select(DB::raw("SELECT pp.id as idProduksi, b.nama, pp.tahap
        FROM proses_produksis pp INNER JOIN bukus b
        ON pp.id_buku = b.id
        WHERE pp.tahap != 'selesai' 
        OR 
        pp.tahap IS null"));

        return $produksi;
    }
    public function getDataJumlahNotifikasiProduksi()
    {
        $jumlahProduksi = DB::select(DB::raw("SELECT COUNT(id) as jumlahProduksi
        FROM proses_produksis 
        WHERE tahap != 'selesai' 
        OR 
        tahap IS null"));

        return $jumlahProduksi;
    }
    public function getDataJumlahBuku()
    {
        $data2 = DB::table('proses_produksis as  pp')
        ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
        ->rightjoin('bukus as b', 'b.id', '=', 'pp.id_buku')
        ->groupBy('b.id')
        ->select('b.id','b.nama','b.halaman', 'b.lebar','b.panjang','b.kategoris','b.foto','gp.kode_lokPenyimpanan')
        ->having(DB::raw('sum(gp.jumlah)'), '=' ,0)
        ->get();

        return $data2;
    }
    public function getDataJumlahBukuHampirHabis()
    {
        $data2 = DB::table('proses_produksis as  pp')
        ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
        ->rightjoin('bukus as b', 'b.id', '=', 'pp.id_buku')
        ->groupBy('b.id')
        ->select('b.id','b.nama','b.halaman', 'b.lebar','b.panjang','b.kategoris','b.foto','gp.kode_lokPenyimpanan')
        ->having(DB::raw('sum(gp.jumlah)'), '>' ,0)
        ->having(DB::raw('sum(gp.jumlah)'), '<=' ,100)
        ->get();

        return $data2;
    }
    public function getDataJumlahNotifikasiHabis()
    {
  
        $data3 = DB::select(DB::raw("SELECT COUNT(X.id) as jml
        FROM (SELECT b.id
        FROM (proses_produksis pp INNER JOIN bukus b
             ON pp.id_buku = b.id) INNER JOIN gudang_penyimpanans gp
        ON pp.id = gp.id_proProduksi
        GROUP BY b.id
        HAVING SUM(gp.jumlah) > 0
                 AND SUM(gp.jumlah) <= 100) x"));

        $data2 = DB::select(DB::raw("SELECT COUNT(X.id) as jml
        FROM (SELECT b.id
        FROM (proses_produksis pp INNER JOIN bukus b
             ON pp.id_buku = b.id) INNER JOIN gudang_penyimpanans gp
        ON pp.id = gp.id_proProduksi
        GROUP BY b.id
        HAVING SUM(gp.jumlah) = 0) x"));

        $data1 = SediaanBahanBaku::where("jumlahSediaan",0)
        ->select(DB::raw('count(nama) as jml'))
        ->get();

        $data4 = SediaanBahanBaku::where("jumlahSediaan",">",0)
        ->where("jumlahSediaan","<=",10)
        ->select(DB::raw('count(nama) as jml'))
        ->get();

        if(isset($data4[0]->jml))
        {
            $value4 = $data4[0]->jml;
        }
        else
        {
            $value4 = 0;
        }

        if(isset($data3[0]->jml))
        {
            $value3 = $data3[0]->jml;
        }
        else
        {
            $value3 = 0;
        }

        if(isset($data2[0]->jml))
        {
            $value2 = $data2[0]->jml;
        }
        else
        {
            $value2 = 0;
        }

        if(isset($data1[0]->jml))
        {
            $value1 = $data1[0]->jml;
        }
        else
        {
            $value1 = 0;
        }

        $value = $value1 + $value2 + $value3 + $value4;

        return $value;
    }

}
