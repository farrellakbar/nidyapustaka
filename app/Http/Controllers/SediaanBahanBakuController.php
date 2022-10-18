<?php

namespace App\Http\Controllers;

use App\Models\SediaanBahanBaku;
use App\Models\PembelianBahanBaku;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class SediaanBahanBakuController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataKategori  = DB::select(DB::raw("select * from kategori_bahan_bakus"));
        $dataSupplier  = DB::select(DB::raw("select * from suppliers"));
        $data = SediaanBahanBaku::all();
        // $data = DB::select(DB::raw("SELECT *,sd.id as idBk, s.id as idSupplier ,k.nama as namaKategori, s.nama as namaSupplier, sd.nama as namaSediaan
        // FROM (sediaan_bahan_bakus sd INNER JOIN kategori_bahan_bakus k
        // ON sd.id_kategori_bahan_baku = k.id) 
        // INNER JOIN suppliers s
        // ON sd.id_supplier = s.id")); 

        return view('sediaanBahanBaku.index', compact('dataKategori','dataSupplier','data'));
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
        $user = Auth::user(); 

        $data = new SediaanBahanBaku();
        $data->nama =  $request->get('nama');
        $data->id_supplier =  $request->get('id_supplier');
        $data->id_kategori_bahan_baku =  $request->get('id_kategori');
        $data->harga =  $request->get('harga');
        $data->jumlahSediaan =  0;
        $data->satuan =  $request->get('satuan'); 

        $data->save(); 

        // dd($nonota);
        return redirect()->back()->with('statusSediaan',' Bahan Baku Berhasil Ditambahkan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SediaanBahanBaku  $sediaanBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function show(SediaanBahanBaku $sediaanBahanBaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SediaanBahanBaku  $sediaanBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function edit(SediaanBahanBaku $sediaanBahanBaku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SediaanBahanBaku  $sediaanBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SediaanBahanBaku $sediaanBahanBaku)
    {
        $id=$request->get('id');
        $data = SediaanBahanBaku::find($id);

        $data->nama =  $request->get('nama');
        $data->id_supplier =  $request->get('id_supplier');
        $data->id_kategori_bahan_baku =  $request->get('id_kategori');
        $data->harga =  $request->get('harga');
        $data->satuan =  $request->get('satuan'); 

        $data->save();
        return redirect()->route('sediaanBahanBaku.index')->with('statusSediaan','Data Sediaan Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SediaanBahanBaku  $sediaanBahanBaku
     * @return \Illuminate\Http\Response
     */
    public function destroy(SediaanBahanBaku $sediaanBahanBaku)
    {
        //
    }

    public function getBeliSediaan(Request $request)
    {
        $id=$request->get('id');
        $data = SediaanBahanBaku::find($id);
        $dataKategori  = DB::select(DB::raw("select * from kategori_bahan_bakus"));
        $dataSupplier  = DB::select(DB::raw("select * from suppliers"));

       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sediaanBahanBaku.getBeliSediaan', compact('data'))->render()
        ),200);  
    }

    public function getEditForm(Request $request)
    {
        $id=$request->get('id');
        // dd($id);
        $data=SediaanBahanBaku::find($id);
        $dataKategori  = DB::select(DB::raw("select * from kategori_bahan_bakus"));
        $dataSupplier  = DB::select(DB::raw("select * from suppliers"));
       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('sediaanBahanBaku.getEditForm', compact('data','id', 'dataKategori','dataSupplier'))->render()
        ),200);  
    }
    public function getDataSediaan()
    {
        $data = SediaanBahanBaku::where("jumlahSediaan",0)
                                    ->select("nama")
                                    ->get();
        return $data;
    }

    public function getDataSediaanHampirHabis()
    {
        $data1 = SediaanBahanBaku::where("jumlahSediaan",">",0)
                                    ->where("jumlahSediaan","<=",10)
                                    ->select("nama")
                                    ->get();
        return $data1;
    }
}
