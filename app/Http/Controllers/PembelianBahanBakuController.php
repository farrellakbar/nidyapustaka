<?php

namespace App\Http\Controllers;

use App\Models\PembelianBahanBaku;
use App\Models\SediaanBahanBaku;
use App\Models\KategoriBahanBaku;
use App\Models\Supplier;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

class PembelianBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $dataSupplier  = DB::select(DB::raw("select * from suppliers"));

        return view('pembelianBahanBaku.index', compact('dataSupplier'));
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
        // $data = new SediaanBahanBaku();
        // $data->nama =  $request->get('nama');
        // $data->id_supplier =  $request->get('id_supplier');
        // $data->id_kategori_bahan_baku =  $request->get('id_kategori');
        // $data->harga =  $request->get('harga');
        // $data->jumlahSediaan =  $request->get('jumlah');
        // $data->satuan =  $request->get('satuan'); 

        // $data->save();

        // return redirect()->route('sediaanBahanBaku.index')->with('statusSediaan','Beli Baru Sediaan Bahan Baku Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembelianBahanBaku  $pembelianBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function show(PembelianBahanBaku $pembelianBahanBaku)
    {
        dd($pembelianBahanBaku);
        return view('pembelianBahanBaku.show', compact('dataSupplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembelianBahanBaku  $pembelianBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function edit(PembelianBahanBaku $pembelianBahanBaku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembelianBahanBaku  $pembelianBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembelianBahanBaku $pembelianBahanBaku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembelianBahanBaku  $pembelianBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembelianBahanBaku $pembelianBahanBaku)
    {
        //
    }

    public function tambahKeranjang($idSupplier, $id)
    {
        $keranjang = session()->get('keranjang');
        if(isset($keranjang))
        {
            foreach($keranjang as $id_produk => $details)
            {
                $idSupKeranjang = $details['idSupplier'];
                if($idSupKeranjang==$idSupplier)
                {
                    $bahanBaku = SediaanBahanBaku::find($id);
                    $kategori = KategoriBahanBaku::find($bahanBaku->id_kategori_bahan_baku);
                    $supplier = Supplier::find($bahanBaku->id_supplier);

                    if(!$bahanBaku){
                        abort('404');
                    }

                    $keranjang = session()->get('keranjang');
                    if(!isset($keranjang[$id])) 
                    {
                        $keranjang[$id]=[
                            'idSediaan' => $bahanBaku->id,
                            'nama' => $bahanBaku->nama,
                            'jumlahSediaan' => 1,
                            'kategori' => $kategori->nama,
                            'idKategori' => $bahanBaku->id_kategori_bahan_baku,
                            'supplier' => $supplier->nama,
                            'idSupplier' => $bahanBaku->id_supplier,
                            'satuan' => $bahanBaku->satuan,
                            'harga' =>$bahanBaku->harga
                        ];
                    }
                    else
                    {
                        $keranjang[$id]['jumlahSediaan']++;
                    }
                    session()->put('keranjang', $keranjang);
                    return redirect()->route('pb',$bahanBaku->id_supplier)->with('success', 'Sediaan bahan baku berhasil masuk keranjang!');
                }
                else
                {
                    session()->forget('keranjang');
                    
                    $bahanBaku = SediaanBahanBaku::find($id);
                    $kategori = KategoriBahanBaku::find($bahanBaku->id_kategori_bahan_baku);
                    $supplier = Supplier::find($bahanBaku->id_supplier);

                    if(!$bahanBaku){
                        abort('404');
                    }

                    $keranjang = session()->get('keranjang');
                    if(!isset($keranjang[$id])) 
                    {
                        $keranjang[$id]=[
                            'idSediaan' => $bahanBaku->id,
                            'nama' => $bahanBaku->nama,
                            'jumlahSediaan' => 1,
                            'kategori' => $kategori->nama,
                            'idKategori' => $bahanBaku->id_kategori_bahan_baku,
                            'supplier' => $supplier->nama,
                            'idSupplier' => $bahanBaku->id_supplier,
                            'satuan' => $bahanBaku->satuan,
                            'harga' =>$bahanBaku->harga
                        ];
                    }
                    else
                    {
                        $keranjang[$id]['jumlahSediaan']++;
                    }
                    session()->put('keranjang', $keranjang);
                    return redirect()->route('pb',$bahanBaku->id_supplier)->with('success', 'Sediaan bahan baku berhasil masuk keranjang!');
                }
            }
        }
        else
        {
            $bahanBaku = SediaanBahanBaku::find($id);
            $kategori = KategoriBahanBaku::find($bahanBaku->id_kategori_bahan_baku);
            $supplier = Supplier::find($bahanBaku->id_supplier);

            if(!$bahanBaku){
                abort('404');
            }

            $keranjang = session()->get('keranjang');
            if(!isset($keranjang[$id])) 
            {
                $keranjang[$id]=[
                    'idSediaan' => $bahanBaku->id,
                    'nama' => $bahanBaku->nama,
                    'jumlahSediaan' => 1,
                    'kategori' => $kategori->nama,
                    'idKategori' => $bahanBaku->id_kategori_bahan_baku,
                    'supplier' => $supplier->nama,
                    'idSupplier' => $bahanBaku->id_supplier,
                    'satuan' => $bahanBaku->satuan,
                    'harga' =>$bahanBaku->harga
                ];
            }
            else
            {
                $keranjang[$id]['jumlahSediaan']++;
            }
            session()->put('keranjang', $keranjang);
            return redirect()->route('pb',$bahanBaku->id_supplier)->with('success', 'Sediaan bahan baku berhasil masuk keranjang!');
        }

        
    }
    public function keranjang()
    {
        $this->authorize('aksesKeranjang-permission');
           
        return view('pembelianBahanBaku.keranjang');
    }
    public function submitcheckout(PembelianBahanBaku $pembelianBahanBaku)
    {
        try
        {
            $keranjang = session()->get('keranjang');
            $user=Auth::user();
    
            date_default_timezone_set("Asia/Jakarta");
            $nonota = date("dmy").date("His");
    
            $t=new PembelianBahanBaku;
            $t->id = $nonota;
            $t->totalHarga = 0;
            $t->tanggalPembelian = now();
            $t->id_karyawan = $user->id;
            $t->save();
    
            $subTotal = $t->insertBahanBaku($keranjang);
            $t->totalHarga = $subTotal;
            $t->save();
    
            foreach($keranjang as $id_produk => $details)
            {
                $sediaan = SediaanBahanBaku::find($details['idSediaan']);
                $sediaan->jumlahSediaan = $sediaan->jumlahSediaan + $details['jumlahSediaan'];
                $sediaan->save();
            }
    
            session()->forget('keranjang');
            $dataSupplier  = DB::select(DB::raw("select * from suppliers"));
            return redirect()->route('pembelianBahanBaku.riwayatPembelian')->with('success', 'Sediaan bahan baku berhasil di beli!');    
        } catch(\PDOException $e){
            return redirect()->route('pembelianBahanBaku.riwayatPembelian')->with('eror', 'Sediaan bahan baku gagal di beli!');
        }
    }

    public function riwayatPembelian()
    {
        // $data  = DB::select(DB::raw("select * from pembelian_bahan_bakus"));
        $data = PembelianBahanBaku::all();
        $data2 = SediaanBahanBaku::all();

        // $data = DB::table('Pembelian_bahan_bakus')
        // ->get(); 
        // foreach($datas as $key => $user)
        // {
        //     $id = $user['id'];
        //     dd($id);
        // }
        $data = DB::select("SELECT pb.id as idNota, s.nama as namaSupplier, pb.tanggalPembelian, k.namaDepan as namaDepan, k.namaBelakang as namaBelakang  , pb.totalHarga as totalHarga
                                    FROM (`sediaan_bahan_bakus` sd INNER JOIN suppliers s 
                                    ON sd.id_supplier = s.id) INNER JOIN (detail_pembelian dp INNER JOIN 
                                                                        (pembelian_bahan_bakus pb  INNER JOIN karyawans k
                                                                        ON pb.id_karyawan = k.id)
                                        ON dp.id_nota_pembelian = pb.id) 
                                            ON sd.id = dp.id_sediaan_bahanBaku
                                            GROUP BY pb.id");    
        return view('pembelianBahanBaku.riwayatPembelian', compact('data'));
    }
    
    public function detail($idNota)
    {
        $datas = DB::select("SELECT pb.id as idNota, kat.nama as namaKategori, sd.nama as namaSediaan, 
                                dp.jumlahPembelian as jumlahPembelian, sd.harga as harga, dp.subTotal as subTotal, 
                                pb.totalHarga as totalHarga, pb.tanggalPembelian as tanggalPembelian, s.nama as namaSupplier, 
                                s.alamat as alamatSupplier, s.kota as kota, s.nomorTelepon as noTelepon, k.namaDepan as namaDepan, 
                                k.namaBelakang as namaBelakang, k.id as idKaryawan
        FROM ((sediaan_bahan_bakus sd INNER JOIN kategori_bahan_bakus kat
               ON sd.id_kategori_bahan_baku  = kat.id)
        INNER JOIN suppliers s 
        ON sd.id_supplier = s.id) INNER JOIN (detail_pembelian dp INNER JOIN 
                                            (pembelian_bahan_bakus pb  INNER JOIN karyawans k
                                            ON pb.id_karyawan = k.id)
            ON dp.id_nota_pembelian = pb.id) 
                ON sd.id = dp.id_sediaan_bahanBaku
                WHERE pb.id = ?",[$idNota]);

            return view('pembelianBahanBaku.getDetailForm', compact('datas'));

    }

    public function keranjangBahanBaku()
    {
        $idBahanBaku = request('idBahanBaku');
        $jumlahBahanBaku = request('jumlahBahanBaku');

        $keranjang = session()->get('keranjang');
       
        $keranjang[$idBahanBaku]['jumlahSediaan'] = $jumlahBahanBaku;
  
        session()->put('keranjang', $keranjang);

        $option = '<input type="number" value="'.$jumlahBahanBaku.'" name="jumlahBahanBaku" class="form-control" id="jumlahBahanBaku" placeholder="Jumlah" required>';
        return $option;
    }
}
