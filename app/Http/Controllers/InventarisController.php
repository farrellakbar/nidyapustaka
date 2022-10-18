<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;



class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data  = DB::select(DB::raw("select * from inventaries"));
        $data = Inventaris::all();

        $data2  = DB::select(DB::raw("select * from inventaries where status = 'Aktif'"));

        $qrRiwayat = DB::select(DB::raw("SELECT *, rp.id as idRiwayat
        FROM (riwayat_perawatans rp INNER JOIN karyawans k
        ON rp.id_karyawan = k.id)
        INNER JOIN inventaries i
        ON rp.kode_inventaris = i.kode"));


        return view('inventaris.index', compact('data','data2' ,'qrRiwayat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user = Auth::user();

            $kota = strtoupper($request->get('kota'));
            $nomor = $request->get('nomor');
            $huruf = strtoupper($request->get('huruf'));

            if(!empty($kota) && !empty($nomor) && ($huruf))
            {
                $platNo = $kota." ".$nomor." ".$huruf;
            }
            else{
                $platNo = null;
            }
            if(!empty($request->file('foto')))
            {
                $file = $request->file('foto');
                $imgFolder = 'images';
                $imgFile = time().'_'.$user->id.".".$file->extension();;
                $file->move($imgFolder, $imgFile);
            }
            else{
                $imgFile = null;
            }
        
            $data = new Inventaris();
            $data->kode =  $request->get('kode');
            $data->nama =  $request->get('nama');
            $data->tahunPembuatan =  $request->get('tahunPembuatan');
            $data->platNomor =  $platNo;
            $data->foto = $imgFile;
        
            $data->save();
        
            return redirect()->route('inventaris.index')->with('statusInventaris','Data Inventaris Berhasil Ditambahkan');
        } catch(\PDOException $e){
            return redirect()->route('inventaris.index')->with('errorInventaris','Data Inventaris Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaris $inventaris)
    {

        // dd($inventaris);

        // return view('inventaris.show', compact('inventaris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaris $inventaris)
    {
        // $inventaris = Inventaris::all();
        // dd($inventaris);

        // $data=$inventaris;
        // return view('inventaris.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        $kota = strtoupper($request->get('kota'));
        $nomor = $request->get('nomor');
        $huruf = strtoupper($request->get('huruf'));

        if(!empty($kota) && !empty($nomor) && ($huruf))
        {
            $platNo = $kota." ".$nomor." ".$huruf;
        }
        else{
            $platNo = null;
        }

        $kode=$request->get('kode');
        // dd($kode);
        // $inventaris = Inventaris::where('kode', $kode)->first();
        $inventaris = Inventaris::find($kode);
        // dd($inventaris);
        $inventaris->nama=$request->get('nama');
        $inventaris->tahunPembuatan=$request->get('tahunPembuatan');
        $inventaris->platNomor=$platNo;
        $inventaris->status =  $request->get('status');


        // $inventaris->tanggalPembelian=$request->get('tanggalPembelian');
        $inventaris->save();
        return redirect()->route('inventaris.index')->with('statusInventaris','Data Inventaris Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaris $inventaris)
    {
        // dd($inventaris);
        // $inventaris = Inventaris::find("A03");
        // $inventaris->delete();
        // return redirect()->route('inventaris.index')->with('statusInventaris','Data Inventaris Berhasil Dihapus');
    }

    public function editFoto(Request $request)
    {
        $kode = $request->kode;
        $user = Auth::user();

        $file = $request->file('foto');
        $imgFolder = 'images';
        $imgFile = time().'_'.$user->id.".".$file->extension();;
        $file->move($imgFolder, $imgFile);

        $inventaris = Inventaris::find($kode);
        $inventaris->foto = $imgFile;
        $inventaris->save();

        return redirect()->route('inventaris.index')->with('statusInventaris','Foto ' .$inventaris->nama. ' berhasil diubah');
    }

    public function deleteData(Request $request)
    {
        try{
            $kode=$request->get('kode');
            // dd($kode);
            $inventaris=Inventaris::find($kode);
            $inventaris->delete();
            return response()->json(array(
                'status'=>'ok',
                'msg'=>'Data Inventaris Berhasil Dihapus'
            ),200);
        } catch(\PDOException $e){
            return response()->json(array(
                'status'=>'error',
                'msg'=>'Inventaris data tidak dapat dihapus, dikarenakan pernah melakukan perawatan.'
            ),200);
        } 
    }

    public function getEditForm(Request $request)
    {
        $kode=$request->get('kode');
        // dd($kode);
        $data=Inventaris::find($kode);
       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('inventaris.getEditForm', compact('data','kode'))->render()
        ),200);  
    }

    // public function getEditForm2(Request $request)
    // {
    //    $kode = $request->get('kode');
    //    $data = Inventaris::find($kode);

    //    return response()->json(array(
    //         'status'=>'oke',
    //         'msg'=>view('inventaris.getEditForm2', compact('data','kode'))->render()
    //     ),200);  
    // }

    // public function saveData(Request $request)
    // {
    //    $kode = $request->get('kode');
    // //    dd($kode);
    //     $inventaris = DB::select('select *
    //     from inventaries 
    //     where kode = ?', [$kode]);

    // //    $inventaris = Inventaris::find('A01');
    //    $inventaris->nama = $request->get("nama");
    //    $inventaris->tahunPembuatan = $request->get("tahunPembuatan");
    //    $inventaris->platNomor = $request->get("platNomor");
    //    $inventaris->foto = $request->get("foto");

    //    return response()->json(array(
    //         'status'=>'ok',
    //         'msg'=>'Sukses Merubah Data'
    //     ),200);  
    // }
}
