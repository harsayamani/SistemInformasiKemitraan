<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriAngsuranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_angsuran', function (Blueprint $table) {
            $table->string('id_bayar')->primary();
            $table->string('id_angsuran');
            $table->foreign('id_angsuran')->references('id_angsuran')->on('angsuran');
            $table->double('bayar_angsuran');
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
        Schema::dropIfExists('histori_angsuran');
    }
}
