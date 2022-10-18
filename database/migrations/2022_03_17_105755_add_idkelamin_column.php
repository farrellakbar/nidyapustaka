<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdkelaminColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelamin'); 
            $table->foreign('id_kelamin')->references('id')->on('kelamins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawans', function (Blueprint $table) { 
            $table->dropForeign(['id_kelamin']);
            $table->dropColumn('id_kelamin'); 
        });
    }
}
