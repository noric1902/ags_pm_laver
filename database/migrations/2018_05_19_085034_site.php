<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Site extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('site', function (Blueprint $table) {
            $table->increments('id');
            $table->char('site_id');
            $table->enum('site_type', ['tower', 'telkom']);
            $table->string('site_name');
            $table->string('lokasi');
            $table->text('description');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site');
        //
    }
}
