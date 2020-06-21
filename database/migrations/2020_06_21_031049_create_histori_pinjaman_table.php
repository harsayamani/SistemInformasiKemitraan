<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriPinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_pinjaman', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string('id_pinjaman');
            $table->foreign('id_pinjaman')->references('id_pinjaman')->on('pinjaman');
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
        Schema::dropIfExists('histori_pinjaman');
    }
}
