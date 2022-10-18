<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSupplier  = DB::select(DB::raw("select * from suppliers"));

        return view('supplier.index', compact('dataSupplier'));
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
        $data = new Supplier();
        $data->nama =  ucwords($request->get('nama'));
        $data->alamat =  ucwords($request->get('alamat'));
        $data->kota =  ucwords($request->get('kota'));
        $data->nomorTelepon =  $request->get('nomorTelepon'); 

        $data->save(); 

        return redirect()->route('supplier.index')->with('statusSediaan',' Supplier Berhasil Ditambahkan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        // $data  = DB::table('suppliers as s')
        // ->join('sediaan_bahan_bakus as sd', 's.id', '=', 'sd.id_supplier')
        // ->where('s.id',  $supplier->id )
        // ->get();
        // // dd($queryBuilder); 
        // return view('pembelianBahanBaku.show', compact('data'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }

    public function detail($id)
    {

        // $data  = DB::table(DB::raw("select s.nama as sup, sd.nama as sed, bk.nama as kat
        //                                 from (sediaan_bahan_bakus as sd inner join kategori_bahan_bakus bk
        //                                         on sd.id_kategori_bahan_baku=bk.id)
        //                                 inner join suppliers s
        //                                 on sd.id_supplier = s.id "))
        //         ->where('s.id',  $id );


        // $data  = DB::table('sediaan_bahan_bakus as sd')
        // ->join('suppliers as s', 'sd.id_supplier', '=', 's.id')
        // ->join('kategori_bahan_bakus as kb', 'sd.id_kategori_bahan_baku', '=', 'kb.id')
        // ->where('s.id',  $id )
        // ->get();

        $data = DB::select('select sd.id, s.id as idSupplier ,s.nama as sup, sd.nama as sed, bk.nama as kat, sd.jumlahSediaan, sd.satuan, sd.harga
                            from (sediaan_bahan_bakus sd inner join kategori_bahan_bakus bk
                                    on sd.id_kategori_bahan_baku=bk.id)
                            inner join suppliers s
                            on sd.id_supplier = s.id 
                            where s.id = ?', [$id]);

        // $data = DB::table('suppliers')
        //         ->where('id',$id )
        //         ->get();

        // dd($data); 

        $cekValue = DB::table('suppliers')
        ->where('id', $id)
        ->count();

        if($cekValue <= 0){
            echo "Kategori tidak ditemukan";
        } else { 
            $namaSup = Supplier::where('id', $id)
                        ->first();
            $dataKategori  = DB::select(DB::raw("select * from kategori_bahan_bakus"));

            // foreach($namaSup as $s)
            // {
            //     $namaSupplier = $s->nama;
            // }
            return view('pembelianBahanBaku.show', compact('data', 'namaSup','dataKategori'));
        }
    }
}
