<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jenis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('jenis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_pengajuan');
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kategori_pengajuan');
            $table->unsignedInteger('jenis_id');
            $table->foreign('jenis_id')->references('id')->on('jenis')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis');
        Schema::dropIfExists('kategori');
    }
}
