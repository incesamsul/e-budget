<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_anggaran', function (Blueprint $table) {
            $table->increments('id_jenis_anggaran');
            $table->unsignedInteger('id_tahun_akademik');
            $table->string('kode_anggaran');
            $table->string('nama_anggaran');
            $table->integer('jumlah_anggaran');
            $table->timestamps();
            $table->foreign('id_tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_anggaran');
    }
}
