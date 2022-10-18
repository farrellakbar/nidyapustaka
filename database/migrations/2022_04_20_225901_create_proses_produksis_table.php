<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_produksis', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->integer('jumlah');
            $table->date('tanggalMulai');
            $table->date('tanggalSelesai')->nullable(); 
            $table->string('tahap',10)->nullable();

            $table->unsignedBigInteger('id_buku'); 
            $table->foreign('id_buku')->references('id')->on('bukus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proses_produksis');
    }
}
