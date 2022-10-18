<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdekspedisiColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan_bukus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ekspedisi')->nullable(); 
            $table->foreign('id_ekspedisi')->references('id')->on('ekspedisis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan_bukus', function (Blueprint $table) { 
            $table->dropForeign(['id_ekspedisi']);
            $table->dropColumn('id_ekspedisi'); 
        });
    }
}
