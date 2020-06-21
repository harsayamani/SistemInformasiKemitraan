<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->string('id_pinjaman')->primary();
            $table->integer('no_pk');
            $table->foreign('no_pk')->references('no_pk')->on('data_mitra');
            $table->string('tgl_cair');
            $table->double('jumlah_pinjaman');
            $table->double('bunga');
            $table->double('total_pinjaman');
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
        Schema::dropIfExists('pinjaman');
    }
}
