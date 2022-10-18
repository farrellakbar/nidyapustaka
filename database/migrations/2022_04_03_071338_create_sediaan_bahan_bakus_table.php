<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSediaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sediaan_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->string('nama',120);
            $table->integer('jumlahSediaan')->nullable();
            $table->string('satuan',15)->nullable();

            $table->unsignedBigInteger('id_kategori_bahan_baku'); 
            $table->foreign('id_kategori_bahan_baku')->references('id')->on('kategori_bahan_bakus');

            $table->double('harga');  

            $table->unsignedBigInteger('id_supplier'); 
            $table->foreign('id_supplier')->references('id')->on('suppliers');

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
        Schema::dropIfExists('sediaan_bahan_bakus');
    }
}
