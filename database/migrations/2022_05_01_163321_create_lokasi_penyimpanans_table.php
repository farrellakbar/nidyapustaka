<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiPenyimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_penyimpanans', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->string('kode',10)->primary();
            $table->string('gudang',15);
            $table->integer('lantai');
            $table->string('posisi',15);
            $table->integer('kapasitasMaksimal');
            $table->string('status',15);  
            $table->integer('jumlahTerkini')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi_penyimpanans');
    }
}
