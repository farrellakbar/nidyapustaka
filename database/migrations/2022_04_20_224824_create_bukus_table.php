<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            // $table->timestamps();
            $table->string('nama',60);
            $table->double('panjang',10,2);
            $table->double('lebar',10,2);
            $table->integer('halaman');
            $table->double('harga');  
            $table->enum('kategoris', ['Pelajaran', 'Umum', 'Kamus', 'Agama','Custom', 'Lain-lain']);  
            $table->string('foto',150)->nullable();
            $table->string('desainBuku',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
