<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJaminanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jaminan', function (Blueprint $table) {
            $table->integer('no_jaminan')->primary();
            $table->string('jaminan')->nullable();
            $table->string('pemilik_jaminan')->nullable();
            $table->string('sertifikat_jaminan')->nullable();
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
        Schema::dropIfExists('jaminan');
    }
}
