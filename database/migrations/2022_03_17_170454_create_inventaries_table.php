<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaries', function (Blueprint $table) {
            // $table->integer('kode')->primary();
            $table->string('kode',10)->primary();
            $table->string('nama',20);
            $table->date('tanggalPembelian')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->year('tahunPembuatan')->nullable();
            $table->string('foto',150)->nullable();
            $table->string('platNomor',15)->nullable();
            $table->enum('status', ['Aktif', 'Rusak', 'Dijual']);  


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
        Schema::dropIfExists('inventaries');
    }
}
