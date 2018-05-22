<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project');
        });

        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pekerjaan');
            $table->unsignedInteger('site_id');
            $table->foreign('site_id')->references('id')->on('site')->onDelete('cascade');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
        Schema::dropIfExists('pekerjaan');
    }
}
