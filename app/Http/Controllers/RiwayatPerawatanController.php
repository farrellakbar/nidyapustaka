<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPerawatan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

class RiwayatPerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $kode = $request->get('kode_inventaris');

        $data = DB::select('select *
        from riwayat_perawatans
        where tanggalSelesai is null
        and
        kode_inventaris = ?', [$kode]);

        if(!$data)
        {
            $user = Auth::user();

            $data = new RiwayatPerawatan();
            $data->tanggalMulai =  now();
            $data->kendala =  $request->get('kendala');
            $data->kode_inventaris =  $request->get('kode_inventaris');
            $data->id_karyawan =  $user->id;
            $data->save();
            return redirect()->route('inventaris.index')->with('status','Data Perawatan Berhasil Ditambahkan');
        }
        else{
            return redirect()->route('inventaris.index')->with('error','Data Perawatan Gagal Ditambahkan, inventaris masih dalam proses perawatan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiwayatPerawatan  $riwayatPerawatan
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPerawatan $riwayatPerawatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPerawatan  $riwayatPerawatan
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPerawatan $riwayatPerawatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPerawatan  $riwayatPerawatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPerawatan $riwayatPerawatan)
    {
        // $riwayatPerawatan->kendala= "Telah Diperbaiki";
        $riwayatPerawatan->catatan= $request->get('catatan');
        $riwayatPerawatan->tanggalSelesai= now();
        $riwayatPerawatan->save();
        return redirect()->route('inventaris.index')->with('status','Data Perawatan Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPerawatan  $riwayatPerawatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPerawatan $riwayatPerawatan)
    {
        //
    }

    public function getEditPerawatan(Request $request)
    {
        $id=$request->get('id');
        $data = RiwayatPerawatan::find($id);

       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('riwayatPerawatan.getEditPerawatan', compact('data'))->render()
        ),200);  
    }
}
