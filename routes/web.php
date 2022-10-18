<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\InventarisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/layout', function () {
    return view('layout.conquer');
});

Route::resource('/','LayoutController');


// Route::get('/inventaris/{kode}', [App\Http\Controllers\InventarisController::class, 'update1']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){
    Route::post('/inventaris/deleteData','InventarisController@deleteData')->name('inventaris.deleteData');
    Route::post('/inventaris/getEditForm','InventarisController@getEditForm')->name('inventaris.getEditForm');
    Route::post('/inventaris/getEditForm2','InventarisController@getEditForm2')->name('inventaris.getEditForm2');
    Route::post('/inventaris/saveData','InventarisController@saveData')->name('inventaris.saveData');
    Route::post('/inventaris/editFoto','InventarisController@editFoto')->name('inventaris.editFoto');

    Route::resource('inventaris',InventarisController::class);
    // Route::resource('inventaris','InventarisController');

    // Route::get('/inventaris', [\App\Http\Controllers\InventarisController::class, 'index'])->name('inventaris.index');
    // Route::post('/inventaris', [\App\Http\Controllers\InventarisController::class, 'store'])->name('inventaris.store');;
    // Route::get('/inventaris/create', [\App\Http\Controllers\InventarisController::class, 'create'])->name('inventaris.create');;
    // Route::get('/inventaris/{inventaris}/edit',[\App\Http\Controllers\InventarisController::class, 'edit'])->name('inventaris.edit');
    // Route::patch('/inventaris/{inventaris}',[\App\Http\Controllers\InventarisController::class, 'edit'])->name('inventaris.update');
    // Route::get('/inventaris/{inventaris}',[\App\Http\Controllers\InventarisController::class, 'delete'])->name('inventaris.destroy');
    // Route::delete('/inventaris/{inventaris}', [\App\Http\Controllers\InventarisController::class, 'delete'])->name('inventaris.destroy');
    Route::post('/riwayatPerawatan/getEditPerawatan','RiwayatPerawatanController@getEditPerawatan')->name('riwayatPerawatan.getEditPerawatan');
    Route::resource('riwayatPerawatan','RiwayatPerawatanController');

    Route::post('/sediaanBahanBaku/getBeliSediaan','SediaanBahanBakuController@getBeliSediaan')->name('sediaanBahanBaku.getBeliSediaan');
    Route::post('/sediaanBahanBaku/getEditForm','SediaanBahanBakuController@getEditForm')->name('sediaanBahanBaku.getEditForm');
    Route::resource('sediaanBahanBaku','SediaanBahanBakuController');

    Route::resource('supplier','SupplierController');
    Route::get('pembelianBahanBaku/{id}','SupplierController@detail')->name('pb');
    // Route::get('pB/{show}','SupplierController@showSupplier ')->name('pb.show');

    // Route::get('pembelianBahanBaku','PembelianBahanBakuController');
    // Route::get('/pembelianBahanBaku/detail/{bahanBaku}', 'PembelianBahanBakuController@detail')->name('show-bahanBaku');;
    // Route::get('/pembelianBahanBaku', PembelianBahanBakuController::class, );
    // Route::get('pembelianBahanBaku', 'PembelianBahanBakuController')->name('pembelianBahanBaku.show');


    // Route::get('/karyawan/create', function () { 
    //     return view('karyawan.create');
    // });
    // Route::post('karyawan/create','KaryawanController@index')->name('karyawan.create');
    Route::post('/karyawan/editFoto','KaryawanController@editFoto')->name('karyawan.editFoto');
    Route::post('/karyawan/buatAkun','KaryawanController@buatAkun')->name('karyawan.buatAkun');
    Route::get('karyawan/daftar','KaryawanController@daftar')->name('karyawan.daftar');
    Route::post('/karyawan/getEditForm','KaryawanController@getEditForm')->name('karyawan.getEditForm');
    Route::put('/editRole','KaryawanController@editRole')->name('karyawan.editRole');


    Route::resource('karyawan','KaryawanController');

    Route::resource('konsumen','KonsumenController');


    Route::get('tambahKeranjang/{idSupplier}/{idSediaan}', 'PembelianBahanBakuController@tambahKeranjang');
    Route::get('keranjang', 'PembelianBahanBakuController@keranjang');
    Route::get('/submitcheckout','PembelianBahanBakuController@submitcheckout')->name('pembelianBahanBaku.submitcheckout');
    Route::post('/keranjangBahanBaku','PembelianBahanBakuController@keranjangBahanBaku')->name('pembelianBahanBaku.keranjangBahanBaku');
    Route::get('/riwayatPembelian','PembelianBahanBakuController@riwayatPembelian')->name('pembelianBahanBaku.riwayatPembelian');
    Route::get('riwayatPembelian/{idNota}','PembelianBahanBakuController@detail')->name('notaPembelian');

    Route::resource('pembelianBahanBaku','PembelianBahanBakuController');

    Route::get('tambahKeranjangPenjualan/{idBuku}', 'PenjualanBukuController@tambahKeranjangPenjualan');
    Route::get('/buku/keranjangPenjualan', 'PenjualanBukuController@keranjangPenjualan')->name('penjualanBuku.checkout');;
    Route::post('/submitcheckout','PenjualanBukuController@submitcheckout')->name('penjualanBuku.submitcheckout');
    Route::get('/riwayatPenjualan','PenjualanBukuController@riwayatPenjualan')->name('penjualanBuku.riwayatPenjualan');
    Route::get('riwayatPenjualan/{id}','PenjualanBukuController@detail')->name('notaPenjualan');
    Route::post('/riwayatPenjualan/detailGudang','PenjualanBukuController@detailGudang')->name('notaPenjualan.detailGudang');


    Route::get('/pengiriman','PenjualanBukuController@pengiriman')->name('pengiriman.index');
    // Route::get('/pengiriman/{id}','PenjualanBukuController@proses')->name('pengiriman.proses');
    Route::get('/pengiriman/selesai/{id}','PenjualanBukuController@selesai')->name('pengiriman.selesai');
    // Route::post('/pengiriman/proses/radioButton','PenjualanBukuController@radioButton')->name('pengiriman.radioButton');
    // Route::post('/pengiriman/showGP','PenjualanBukuController@showGP')->name('pengiriman.showGP');
    Route::resource('penjualanBuku','PenjualanBukuController');

    Route::post('/ekspedisi/deleteData','EkspedisiController@deleteData')->name('ekspedisi.deleteData');
    Route::post('/ekspedisi/getEditForm','EkspedisiController@getEditForm')->name('ekspedisi.getEditForm');
    Route::resource('ekspedisi','EkspedisiController');


    Route::resource('produksi','ProduksiController');

    Route::get('produksi/editMulai/{id}','ProduksiController@editMulai')->name('produksi.editMulai');
    Route::post('/produksi/gudangPenyimpanan','ProduksiController@getDataProduksi')->name('produksi.getDataProduksi');
    Route::get('produksi/linimasa/{id}','ProduksiController@linimasa')->name('produksi.linimasa');
    Route::get('/tahap','ProduksiController@tahap')->name('produksi.tahap');
    Route::get('/tahapan','ProduksiController@tahapan')->name('produksi.tahapan');
    Route::get('/pemakaianSediaan','ProduksiController@pemakaianSediaan')->name('produksi.pemakaianSediaan');
    Route::get('/labelSatuan','ProduksiController@labelSatuan')->name('produksi.labelSatuan');
    Route::post('/produksi/tersedia','ProduksiController@tersedia2')->name('produksi.tersedia2');
    Route::post('/produksi/estimasi','ProduksiController@estimasi')->name('produksi.estimasi');
    Route::post('/produksi/estimasiIndex','ProduksiController@estimasiIndex')->name('produksi.estimasiIndex');

    Route::post('/keranjangBuku','LinimasaTahapanController@keranjangBuku')->name('linimasa.keranjangBuku');
    Route::resource('linimasaTahapan','LinimasaTahapanController');

    Route::resource('keteranganTahapan','KeteranganTahapanController');

    Route::post('/lokasiPenyimpanan/produksiSelesai','LokasiPenyimpananController@produksiSelesai')->name('lokasiPenyimpanan.produksiSelesai');
    Route::post('/lokasiPenyimpanan/getEditForm','LokasiPenyimpananController@getEditForm')->name('lokasiPenyimpanan.getEditForm');
    Route::resource('lokasiPenyimpanan','LokasiPenyimpananController');


    Route::get('/beranda', function () {
        return view('beranda');
    });

    Route::post('/buku/getEditForm','BukuController@getEditForm')->name('buku.getEditForm');
    Route::post('/buku/desain','BukuController@desain')->name('buku.desain');
    Route::resource('buku','BukuController');
});
