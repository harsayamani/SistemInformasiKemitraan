<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataMitraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mitra', function (Blueprint $table) {
            $table->integer('no_pk')->primary();
            $table->string('nama_pk');
            $table->string('usaha');
            $table->string('pemilik');
            $table->bigInteger('ktp');
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('no_telp');
            $table->longText('alamat_kantor');
            $table->longText('lokasi_usaha');
            $table->string('ahli_waris');
            $table->integer('jumlah_karyawan');
            $table->bigInteger('no_rek');
            $table->string('username');
            $table->foreign('username')->references('username')->on('users');
            $table->integer('no_jaminan');
            $table->foreign('no_jaminan')->references('no_jaminan')->on('jaminan');
            $table->integer('no_proposal');
            $table->foreign('no_proposal')->references('no_proposal')->on('data_proposal');
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
        Schema::dropIfExists('data_mitra');
    }
}
