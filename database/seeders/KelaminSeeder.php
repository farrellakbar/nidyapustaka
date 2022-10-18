<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
// use DB;

class KelaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('kelamins')->insert([
            'jenisKelamin' => 'Laki-laki',
        ]); 
        \DB::table('kelamins')->insert([
            'jenisKelamin' => 'Perempuan',
        ]); 
    }
}
