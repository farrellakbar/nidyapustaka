<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LokasiPenyimpananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('lokasi_penyimpanans')->insert([
            'kode' => 'B1-AA',
            'gudang' => 'B',
            'lantai' => 1,
            'posisi' => 'AA',
            'kapasitasMaksimal' => 1000,
            'status' => 'Tersedia',
            'jumlahTerkini' => 0
        ]); 
        \DB::table('lokasi_penyimpanans')->insert([
            'kode' => 'B1-BB',
            'gudang' => 'B',
            'lantai' => 1,
            'posisi' => 'BB',
            'kapasitasMaksimal' => 1000,
            'status' => 'Tersedia',
            'jumlahTerkini' => 0
        ]); 
    }
}
