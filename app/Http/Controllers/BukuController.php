<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Konsumen;

use Illuminate\Http\Request;
use DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buku::all();
        $data3 = Konsumen::all();
        $data2 = DB::table('proses_produksis as  pp')
        ->join('gudang_penyimpanans as gp', 'gp.id_proProduksi', '=', 'pp.id')
        ->join('bukus as b', 'b.id', '=', 'pp.id_buku')
        ->groupBy('b.id')
        ->select( 'b.id','b.nama','b.halaman', 'b.lebar','b.panjang','b.kategoris','b.foto','gp.kode_lokPenyimpanan', DB::raw('sum(gp.jumlah) as jumlahBuku'), DB::raw('max(gp.harga) as harga'))
        // ->where('gp.jumlah','!=','0')
        ->get(); 

        return view('buku.index',compact('data','data2','data3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data3 = Konsumen::all();

        return view('buku.create', compact('data3'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imgFolder = 'images';
            $imgFile = time().'_'.$request->get('nama').".".$file->extension();
            $file->move($imgFolder, $imgFile);
        } else {
            $imgFile = null;
        }


        if ($request->hasFile('desainBuku')) {
            $file = $request->file('desainBuku');
            $desainFolder = 'desainBuku';
            $desainFile = time().'_'.$request->get('nama').".".$file->extension();
            $file->move($desainFolder, $desainFile);
        } else {
            $desainFile = null;
        }

        $data = new Buku();
        $data->id =  $request->get('kodeBuku');
        $data->nama =  $request->get('nama');
        $data->lebar =  $request->get('lebar');
        $data->panjang =  $request->get('panjang');
        $data->halaman =  $request->get('halaman');
        $data->harga =  $request->get('harga');
        $data->kategoris =  $request->get('kategoris');
        $data->foto = $imgFile;
        $data->desainBuku = $desainFile;
        $data->id_konsumen = $request->get('id_konsumen');

        $data->save();
    
        return redirect()->route('buku.index')->with('status','Data Buku Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $id=$request->get('id');
        $data = $buku;
        // dd($buku);

        // if ($request->hasFile('foto')) {
        //     $file = $request->file('foto');
        //     $imgFolder = 'images';
        //     $imgFile = time().'_'.$request->get('nama').".".$file->extension();
        //     $file->move($imgFolder, $imgFile);
        // } else {
        //     $imgFile = $data->foto;
        // }


        // if ($request->hasFile('desainBuku')) {
        //     $file = $request->file('desainBuku');
        //     $desainFolder = 'desainBuku';
        //     $desainFile = time().'_'.$request->get('nama').".".$file->extension();
        //     $file->move($desainFolder, $desainFile);
        // } else {
        //     $desainFile = $data->desainBuku;
        // }
        $data->nama =  $request->get('namaBuku');
        $data->lebar =  $request->get('lebar');
        $data->panjang =  $request->get('panjang');
        $data->halaman =  $request->get('halaman');
        $data->harga =  $request->get('harga');
        // $data->kategoris =  $request->get('kategoris');
        // $data->foto = $imgFile;
        // $data->desainBuku = $desainFile;

        $data->save();
        return redirect()->route('buku.index')->with('status','Data Buku Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id=$request->get('id');
        // dd($id);
        $data=Buku::find($id);
        $data3 = Konsumen::all();
       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('buku.getEditForm', compact('data','id','data3'))->render()
        ),200);  
    }

    public function desain(Request $request)
    {
        $id = $request->id;
        $buku = Buku::find($id);

        $file = $request->file('desainBuku2');
        $desainFolder = 'desainBuku';
        $desainFile = time().'_'.$buku->nama.".".$file->getClientOriginalExtension();
        $file->move($desainFolder, $desainFile);

        $buku->desainBuku = $desainFile;
        $buku->save();

        return redirect()->route('buku.index')->with('success','Desain ' .$buku->nama. ' berhasil ditambah');
    }
}
