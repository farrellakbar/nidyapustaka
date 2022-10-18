<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('aksesIndex-permission');
        $user = Auth::user();

        // $data = Karyawan::All();

        $data = Karyawan::where('id', '=', $user->id)
                            ->get();

        $dataAgama  = DB::select(DB::raw("select * from agamas"));
        $dataKelamin  = DB::select(DB::raw("select * from kelamins"));

        return view('karyawan.index', compact('data', 'dataAgama','dataKelamin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('aksesCrete-permission');

        $user = Auth::user();

        $data = Karyawan::where('id', '=', $user->id)
                            ->get();

        $dataAgama  = DB::select(DB::raw("select * from agamas"));
        $dataKelamin  = DB::select(DB::raw("select * from kelamins"));

        return view('karyawan.create', compact('data', 'dataAgama','dataKelamin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        // $user = Auth::user();

        // if ($request->hasFile('foto')) {
        //     $file = $request->file('foto');
        //     $imgFolder = 'images/karyawan';
        //     $imgFile = time().'_'.$request->get('namaDepan').$request->get('namaBelakang').".".$file->extension();
        //     $file->move($imgFolder, $imgFile);
        // } else {
        //     $imgFile = $data->foto;
        // }


        $dataUser = new User();
        $dataUser->username =  $request->get('username');
        $dataUser->email =  $request->get('email');
        $dataUser->password =  Hash::make($request->get('password'));
        $dataUser->role =  $request->get('role');
        $dataUser->save();
        return redirect()->route('karyawan.daftar')->with('status','Data Karyawan Berhasil Dirubah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        // $id_user=$request->input('id_user');
        
        // $karyawan = Karyawan::where('id_user', $id_user)->first();
        // $karyawan = Karyawan::find($id);
        // dd("hore");
        $karyawan->namaDepan =  ucwords($request->get('namaDepan'));
        $karyawan->namaBelakang =  ucwords($request->get('namaBelakang'));
        $karyawan->tanggalLahir =  ucwords($request->get('tanggalLahir'));
        $karyawan->tempatLahir =  ucwords($request->get('tempatLahir'));
        $karyawan->id_kelamin =  ucwords($request->get('id_kelamin'));
        $karyawan->id_agama =  ucwords($request->get('id_agama'));
        $karyawan->alamat =  ucwords($request->get('alamat'));
        $karyawan->nomorHP =  $request->get('nomorHandPhone');

        $karyawan->save();
        return redirect()->route('karyawan.index')->with('status','Data Karyawan Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }

    public function editFoto(Request $request)
    {
        $user = Auth::user();
        $karyawan = Karyawan::find($user->id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imgFolder = 'images/karyawan';
            $imgFile = time().'_'.$karyawan->namaDepan.$karyawan->namaBelakang.".".$file->extension();
            $file->move($imgFolder, $imgFile);
        } else {
            $imgFile = $karyawan->foto;
        }

        $karyawan->foto = $imgFile;
        $karyawan->save();

        return redirect()->route('karyawan.index')->with('status','Foto ' .$karyawan->namaDepan." ".$karyawan->namaBelakang. ' berhasil diubah');
    }
    // public function indexC()
    // {
    //     // $data  = DB::select(DB::raw("select * from karyawans"));
    //     $user = Auth::user();

    //     // $data = Karyawan::All();

    //     $dataKaryawan = Karyawan::where('id', '=', $user->id)
    //                         ->get();
    //     return view('layout.conquer', compact('dataKaryawan'));
    // }
    public function daftar()
    {
        // $data  = DB::select(DB::raw("select * from karyawans"));
        // $data = Karyawan::All();
        $this->authorize('aksesDaftar-permission');
        $data = Karyawan::all();

        $dataAgama  = DB::select(DB::raw("select * from agamas"));
        $dataKelamin  = DB::select(DB::raw("select * from kelamins"));

        return view('karyawan.daftar', compact('data', 'dataAgama','dataKelamin'));
    }

    public function buatAkun(Request $request)
    {
        try{
            $dataUser = new User();
            $dataUser->username =  $request->get('username');
            $dataUser->email =  $request->get('email');
            $dataUser->password =  Hash::make($request->get('password'));
            $dataUser->role =  $request->get('role');
            $dataUser->save();

            $data = new Karyawan();
            $data->id =  $dataUser->id;

            $data->namaDepan =  ucwords($request->get('namaDepan'));
            $data->namaBelakang =  ucwords($request->get('namaBelakang'));
            $data->tanggalLahir =  ucwords($request->get('tanggalLahir'));
            $data->tempatLahir =  ucwords($request->get('tempatLahir'));
            $data->id_kelamin =  ucwords($request->get('id_kelamin'));
            $data->id_agama =  ucwords($request->get('id_agama'));
            $data->alamat =  ucwords($request->get('alamat'));
            $data->nomorHP =  $request->get('nomorHandPhone');
            $data->save();

            return response()->json(array(
                'status'=>'ok',
                'msg'=> 'Pembuatan Akun Sukses!!'
            ),200);  
        } catch(\PDOException $e){
            return response()->json(array(
                'status'=>'error',
                'msg'=>'Pembuatan Akun Gagal, email sudah pernah terpakai !!'
            ),200);
        }
    }
    public function getEditForm(Request $request)
    {
        $id=$request->get('id');
        // dd($kode);
        $data=User::find($id);
        $data2=Karyawan::find($id);
       return response()->json(array(
            'status'=>'oke',
            'msg'=>view('karyawan.getEditForm', compact('data','id','data2'))->render()
        ),200);  
    }
    public function editRole(Request $request)
    {
        $user = User::find($request->get('id'));
        $user->role = $request->get('roles');
        // dd($request->get('roles'));
        $user->save();

        return redirect()->route('karyawan.daftar')->with('status','Role berhasil diubah!');
    }
}
