<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
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
        $data = new Ekspedisi();
        $data->nama =  $request->get('nama');
        $data->alamat =  $request->get('alamat');
        $data->nomorTelepon =  $request->get('nomorTelepon');
    
        $data->save();
    
        return redirect()->route('pengiriman.index')->with('successEkspedisi','Data Ekspedisi Berhasil Ditambahkan');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function show(Ekspedisi $ekspedisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekspedisi $ekspedisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ekspedisi $ekspedisi)
    {
        $id=$request->get('id');
        
        $data = Ekspedisi::find($id);

        $data->nama = $request->get('nama');
        $data->alamat = $request->get('alamat');
        $data->nomorTelepon = $request->get('nomorTelepon');
        $data->save();
        return redirect()->route('pengiriman.index')->with('successEkspedisi','Data Ekspedisi Berhasil Di edit'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekspedisi $ekspedisi)
    {
        //
    }
    public function getEditForm(Request $request)
    {
        $id=$request->get('id');
        // dd($kode);
        $data=Ekspedisi::find($id);
       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('pengiriman.getEditForm', compact('data','id'))->render()
        ),200);  
    }
    public function deleteData(Request $request)
    {
        try{
            $id=$request->get('id');
            $data=Ekspedisi::find($id);
            $data->delete();
            return response()->json(array(
                'status'=>'ok',
                'msg'=>'Data Ekspedisi Berhasil Dihapus'
            ),200);
        } catch(\PDOException $e){
            return response()->json(array(
                'status'=>'error',
                'msg'=>'Ekspedisi data tidak dapat dihapus, dikarenakan pernah memakai ekspedisi tersebut!'
            ),200);
        } 
    }
}
