<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->increments('id');
            
            $table->text('barcode_id');
            $table->unsignedInteger('site_id');
            $table->foreign('site_id')->references('id')->on('site')->onDelete('cascade');
            $table->unsignedInteger('jenis_id');
            $table->foreign('jenis_id')->references('id')->on('jenis')->onDelete('cascade');
            $table->unsignedInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->unsignedInteger('pekerjaan_id');
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan')->onDelete('cascade');
            $table->unsignedInteger('project_id');
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            
            $table->unsignedInteger('pengaju_id');
            $table->foreign('pengaju_id')->references('id')->on('user')->onDelete('cascade');
            $table->unsignedInteger('target_id');
            $table->foreign('target_id')->references('id')->on('user')->onDelete('cascade');

            $table->text('deskripsi');
            $table->text('keterangan');

            $table->date('tanggal_pengajuan');
            $table->date('realisasi_pengajuan');

            $table->date('start_penawaran_to_dmt');
            
            $table->char('no_sph');
            $table->bigInteger('nominal_sph'); // surat penawaran harga
            $table->char('no_corr');            
            $table->bigInteger('nominal_corr'); // corrmo
            $table->char('no_po');
            $table->bigInteger('nominal_po'); // payment order
            
            $table->char('no_spk'); // surat perintah kerja

            $table->bigInteger('nominal_pengajuan');

            $table->dateTime('approved_at');
            $table->enum('is_approved', ['0','1'])->default('0');
            $table->dateTime('rejected_at');
            $table->enum('is_rejected', ['0','1'])->default('0');
            $table->dateTime('printed_at');
            $table->enum('is_print', ['0','1'])->default('0');

            $table->enum('is_accepted', ['0','1'])->default('0');

            $table->enum('is_deleted', ['0','1'])->default('0');
            $table->enum('is_completed', ['0','1'])->default('0');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
}
