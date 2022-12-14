<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
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
        $data = new Konsumen();
        $data->namaPemesan =  $request->get('namaPemesan');
        $data->alamatPemesan =  $request->get('alamatPemesan');
        $data->namaToko =  $request->get('namaToko');
        $data->alamatToko =  $request->get('alamatToko');
        $data->nomorTelepon =  $request->get('nomorTelepon');
        $data->save();
    
        return redirect()->back()->with('success','Data Konsumen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function show(Konsumen $konsumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function edit(Konsumen $konsumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konsumen $konsumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konsumen $konsumen)
    {
        //
    }
}
