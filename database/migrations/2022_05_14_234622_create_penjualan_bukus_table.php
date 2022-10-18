<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_bukus', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->double('totalHarga',10, 2);
            $table->date('tanggalPenjualan')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->unsignedBigInteger('id_konsumen'); 
            $table->foreign('id_konsumen')->references('id')->on('konsumens');

            $table->date('tanggalPengiriman')->nullable();
            $table->date('tanggalSelesai')->nullable();
            
            $table->string('kode_kendaraan',10)->nullable();; 
            $table->foreign('kode_kendaraan')->references('kode')->on('inventaries');
            
            $table->unsignedBigInteger('id_pengirim1')->nullable();; 
            $table->foreign('id_pengirim1')->references('id')->on('karyawans');
            $table->unsignedBigInteger('id_pengirim2')->nullable();; 
            $table->foreign('id_pengirim2')->references('id')->on('karyawans');
            $table->unsignedBigInteger('id_supervisor'); 
            $table->foreign('id_supervisor')->references('id')->on('karyawans');

            $table->string('status',15); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_bukus');
    }
}
