<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuanDanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_dana', function (Blueprint $table) {
            $table->string('id_pengajuan_dana')->primary();
            $table->string('no_pk');
            $table->foreign('no_pk')->references('no_pk')->on('data_mitra');
            $table->double('dana_aju');
            $table->integer('status');
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
        Schema::dropIfExists('pengajuan_dana');
    }
}
