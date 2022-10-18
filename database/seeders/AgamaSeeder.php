<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Karena mencari DB Class di namespace diatas, yang tidak lengkap.
// Dibutuhkan salah satu deklarasi seperti dibawah ini: atau bisa langsung di \DB::table('bla')...
//1:
// use Illuminate\Support\Facades\DB;
//2 :
use DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agamas')->insert([
            'nama' => 'Islam',
        ]); 
        DB::table('agamas')->insert([
            'nama' => 'Protestan',
        ]); 
        DB::table('agamas')->insert([
            'nama' => 'Katolik',
        ]); 
        DB::table('agamas')->insert([
            'nama' => 'Hindu',
        ]); 
        DB::table('agamas')->insert([
            'nama' => 'Buddha',
        ]); 
        DB::table('agamas')->insert([
            'nama' => 'Khonghucu',
        ]); 
    }
}
