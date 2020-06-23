<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_proposal', function (Blueprint $table) {
            $table->integer('no_proposal')->primary();
            $table->string('kegiatan');
            $table->string('nama_pengaju');
            $table->string('tgl_pengajuan');
            $table->string('unit_usaha');
            $table->double('dana_aju');
            $table->string('email');
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
        Schema::dropIfExists('data_proposal');
    }
}
