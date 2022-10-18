<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPerawatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_perawatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggalMulai');
            $table->date('tanggalSelesai')->nullable();
            $table->string('kendala',60)->nullable();
            $table->string('catatan',160)->nullable();

            $table->string('kode_inventaris',10); 
            $table->foreign('kode_inventaris')->references('kode')->on('inventaries');
            $table->unsignedBigInteger('id_karyawan'); 
            $table->foreign('id_karyawan')->references('id')->on('karyawans');
            
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
        Schema::dropIfExists('riwayat_perawatans');
    }
}
