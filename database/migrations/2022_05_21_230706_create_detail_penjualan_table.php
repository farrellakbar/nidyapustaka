<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->unsignedBigInteger('id_pp'); 
            $table->foreign('id_pp')->references('id_proProduksi')->on('gudang_penyimpanans');

            $table->string('kode_lp'); 
            $table->foreign('kode_lp')->references('kode_lokPenyimpanan')->on('gudang_penyimpanans');

            $table->unsignedBigInteger('id_nota_penjualan'); 
            $table->foreign('id_nota_penjualan')->references('id')->on('penjualan_bukus');

            $table->integer('jumlahPenjualan');
            $table->double('subTotal',10, 2);
            $table->primary(['id_pp', 'kode_lp','id_nota_penjualan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
}
