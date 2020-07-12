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
            $table->string('lama_tempati_rumah');
            $table->string('lama_jalani_usaha');
            $table->double('modal');
            $table->string('tempat_usaha');
            $table->string('lokasi_usaha');
            $table->string('pinjaman_lain');
            $table->string('ijin_usaha');
            $table->string('kepemilikan_usaha');
            $table->string('rekening_bank');
            $table->string('penghasilan_diluar_usaha');
            $table->string('surat_ijin_usaha');
            $table->string('dokumen_hasil_survei');
            $table->string('surat_berita_acara');
            $table->string('foto_pemilik');
            $table->string('foto_tempat_usaha');
            $table->string('anggota_tim1');
            $table->string('anggota_tim2')->nullable();
            $table->string('anggota_tim3')->nullable();
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
