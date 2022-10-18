<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGudangPenyimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang_penyimpanans', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->unsignedBigInteger('id_proProduksi'); 
            $table->foreign('id_proProduksi')->references('id')->on('proses_produksis');

            $table->string('kode_lokPenyimpanan'); 
            $table->foreign('kode_lokPenyimpanan')->references('kode')->on('lokasi_penyimpanans');

            $table->date('tanggalMasuk');
            $table->integer('jumlah');
            $table->double('harga',10, 2);

            $table->primary(['id_proProduksi','kode_lokPenyimpanan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gudang_penyimpanans');
    }
}
