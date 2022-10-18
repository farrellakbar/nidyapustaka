<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('suppliers')->insert([
            'nama' => 'Toko Barokah',
            'alamat' => 'Wiyung',
            'kota' => 'Surabaya'

        ]); 
        \DB::table('suppliers')->insert([
            'nama' => 'Toko Basmalah',
            'alamat' => 'Sedati',
            'kota' => 'Sidoarjo'
        ]); 
    }
}
