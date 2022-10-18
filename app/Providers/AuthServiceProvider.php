<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //START KARYAWAN
            Gate::define('aksesDaftar-permission','App\Policies\KaryawanPolicy@aksesDaftar');
            Gate::define('aksesCrete-permission','App\Policies\KaryawanPolicy@aksesCrete');
            Gate::define('aksesIndex-permission','App\Policies\KaryawanPolicy@aksesIndex');
        //END KARYAWAN
        //START KERANJANG PEMBELIAN
            Gate::define('aksesKeranjang-permission','App\Policies\PembelianBahanBakuPolicy@aksesKeranjang');
        //END KERANJANG PEMBELIAN
        //START PRODUKSI
           Gate::define('aksesTambahProduksi-permission','App\Policies\ProduksiPolicy@aksesTambahProduksi');
           Gate::define('aksesSelesaiProduksi-permission','App\Policies\ProduksiPolicy@aksesSelesaiProduksi');

           Gate::define('aksesTambahKeteranganTahapan-permission','App\Policies\ProduksiPolicy@aksesTambahKeteranganTahapan');
        ///END PRODUKSI
        //START PENJUALAN BUKU
            Gate::define('aksesKeranjangPenjualan-permission','App\Policies\PenjualanBukuPolicy@aksesKeranjangPenjualan');
            Gate::define('aksesProsesPenjualan-permission','App\Policies\PenjualanBukuPolicy@aksesProsesPenjualan');

        //END PENJUALAN BUKU
    }
}
