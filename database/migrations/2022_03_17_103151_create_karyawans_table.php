<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('id')->primary();
            $table->foreign('id')->references('id')->on('users');

            $table->string('namaDepan',15);
            $table->string('namaBelakang',15);
            $table->date('tanggalLahir');
            $table->string('tempatLahir',20);
            $table->string('alamat',60);
            $table->double('nomorHP',13,0)->nullable();
            $table->string('foto', 150)->nullable();
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
        Schema::dropIfExists('karyawans');
    }
}
