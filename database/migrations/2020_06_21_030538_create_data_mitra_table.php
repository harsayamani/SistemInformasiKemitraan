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
            $table->string('no_pk')->primary();
            $table->bigInteger('ktp')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('jenis_kelamin', 1)->nullable();
            $table->integer('tempat_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('no_telp')->nullable();
            $table->longText('alamat_kantor')->nullable();
            $table->longText('lokasi_usaha')->nullable();
            $table->string('ahli_waris')->nullable();
            $table->integer('jumlah_karyawan')->nullable();
            $table->bigInteger('no_rek')->nullable();
            $table->string('bank')->nullable();
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
