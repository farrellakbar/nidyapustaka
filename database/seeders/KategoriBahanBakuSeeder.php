<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategoriBahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('kategori_bahan_bakus')->insert([
            'nama' => 'Kertas',
        ]); 
        \DB::table('kategori_bahan_bakus')->insert([
            'nama' => 'Lem',
        ]); 
        \DB::table('kategori_bahan_bakus')->insert([
            'nama' => 'Tinta',
        ]); 
        \DB::table('kategori_bahan_bakus')->insert([
            'nama' => 'Lainnya',
        ]); 
    }
}
