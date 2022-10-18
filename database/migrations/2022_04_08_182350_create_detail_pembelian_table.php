<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->unsignedBigInteger('id_sediaan_bahanBaku'); 
            $table->foreign('id_sediaan_bahanBaku')->references('id')->on('sediaan_bahan_bakus');

            $table->unsignedBigInteger('id_nota_pembelian'); 
            $table->foreign('id_nota_pembelian')->references('id')->on('pembelian_bahan_bakus');

            $table->integer('jumlahPembelian');
            $table->double('subTotal',10, 2);
            $table->primary(['id_sediaan_bahanBaku', 'id_nota_pembelian']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelian');
    }
}
