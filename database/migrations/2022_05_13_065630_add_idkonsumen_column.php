<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdkonsumenColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_konsumen')->nullable(); 
            $table->foreign('id_konsumen')->references('id')->on('konsumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bukus', function (Blueprint $table) { 
            $table->dropForeign(['id_konsumen']);
            $table->dropColumn('id_konsumen'); 
        });
    }
}
