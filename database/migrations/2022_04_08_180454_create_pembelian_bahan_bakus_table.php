<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->double('totalHarga',10, 2);
            $table->date('tanggalPembelian')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->unsignedBigInteger('id_karyawan'); 
            $table->foreign('id_karyawan')->references('id')->on('karyawans');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_bahan_bakus');
    }
}
