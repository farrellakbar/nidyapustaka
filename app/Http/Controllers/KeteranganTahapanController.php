<?php

namespace App\Http\Controllers;

use App\Models\KeteranganTahapan;
use Illuminate\Http\Request;

class KeteranganTahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KeteranganTahapan::all();
        $this->authorize('aksesTambahKeteranganTahapan-permission');

        return view('keteranganTahapan.index',compact('data'));
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
        $data = new KeteranganTahapan();
        $data->tahap = $request->get('tahap');
        $data->keterangan  = $request->get('keterangan');
        $data->save();
        return redirect()->back()->with('status','Data Keterangan Tahapan Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KeteranganTahapan  $keteranganTahapan
     * @return \Illuminate\Http\Response
     */
    public function show(KeteranganTahapan $keteranganTahapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KeteranganTahapan  $keteranganTahapan
     * @return \Illuminate\Http\Response
     */
    public function edit(KeteranganTahapan $keteranganTahapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KeteranganTahapan  $keteranganTahapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeteranganTahapan $keteranganTahapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KeteranganTahapan  $keteranganTahapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KeteranganTahapan $keteranganTahapan)
    {
        //
    }
}
