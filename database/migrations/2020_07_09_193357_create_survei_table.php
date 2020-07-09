<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survei', function (Blueprint $table) {
            $table->integer('no_survei')->primary();
            $table->string('no_pk');
            $table->foreign('no_pk')->references('no_pk')->on('data_mitra');
            $table->string('id_pengajuan_dana');
            $table->foreign('id_pengajuan_dana')->references('id_pengajuan_dana')->on('pengajuan_dana');
            $table->string('kepemilikan_rumah');
            $table->integer('lama_tempati_rumah');
            $table->integer('lama_jalani_usaha');
            $table->double('modal');
            $table->string('tempat_usaha');
            $table->string('lokasi_usaha');
            $table->string('pinjaman_lain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survei');
    }
}
