<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class TahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //<!-- START TAHAP 1-->
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 1,
                'keterangan' => 'Proses produksi mulai berlangsung'
            ]); 
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 1,
                'keterangan' => 'Memeriksa plat'
            ]); 
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 1,
                'keterangan' => 'Plat rusak'
            ]); 
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 1,
                'keterangan' => 'Mempersiapkan file desain'
            ]); 
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 1,
                'keterangan' => 'Proses pembuatan plat'
            ]); 
        //<!-- END TAHAP 1-->
        //<!-- START TAHAP 2-->
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 2,
                'keterangan' => 'Proses pencetakan'
            ]); 
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 2,
                'keterangan' => 'Proses pencetakan telah selesai'
            ]); 
        //<!-- END TAHAP 2-->
        //<!-- START TAHAP 3-->
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 3,
                'keterangan' => 'Proses penyusunan halaman buku'
            ]); 
        //<!-- END TAHAP 3-->
        //<!-- START TAHAP 4-->
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 4,
                'keterangan' => 'Proses menjilid buku'
            ]); 
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 4,
                'keterangan' => 'Proses menjilid buku telah selesai'
            ]); 
        //<!-- END TAHAP 4-->
        //<!-- START TAHAP 5-->
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 5,
                'keterangan' => 'Proses pemotongan atau perapian tepi buku'
            ]); 
        //<!-- END TAHAP 5-->
        //<!-- START TAHAP 6-->
            DB::table('keterangan_tahapans')->insert([
                'tahap' => 6,
                'keterangan' => 'Proses finishing'
            ]); 
        //<!-- END TAHAP 6-->
    }
}
