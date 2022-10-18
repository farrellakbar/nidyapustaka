<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AgamaSeeder::class,
            KelaminSeeder::class,
            InventarisSeeder::class,
            SupplierSeeder::class,
            KategoriBahanBakuSeeder::class,
            TahapanSeeder::class,
            LokasiPenyimpananSeeder::class,
        ]);

    }
}
