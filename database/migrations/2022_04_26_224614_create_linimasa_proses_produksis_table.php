<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinimasaProsesProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linimasa_proses_produksis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');

            $table->unsignedBigInteger('id_keterangan_tahapan'); 
            $table->foreign('id_keterangan_tahapan')->references('id')->on('keterangan_tahapans');

            $table->unsignedBigInteger('id_sediaan_bahan_baku')->nullable(); 
            $table->foreign('id_sediaan_bahan_baku')->references('id')->on('sediaan_bahan_bakus');

            $table->integer('jumlahPenggunaan')->nullable();

            $table->unsignedBigInteger('id_proses_produksi'); 
            $table->foreign('id_proses_produksi')->references('id')->on('proses_produksis');
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
        Schema::dropIfExists('linimasa_proses_produksis');
    }
}
