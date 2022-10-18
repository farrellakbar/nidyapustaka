<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('inventaries')->insert([
            'kode' => 'A01',
            'nama' => 'Mesin X',
            'tanggalPembelian' => NOW()
        ]); 
        \DB::table('inventaries')->insert([
            'kode' => 'A02',
            'nama' => 'Mesin Z',
            'tanggalPembelian' => NOW()
        ]); 
    }
}
