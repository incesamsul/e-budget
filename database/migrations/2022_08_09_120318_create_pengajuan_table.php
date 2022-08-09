<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->unsignedBigInteger('id_pengaju');
            $table->unsignedInteger('id_jenis_anggaran');
            $table->integer('jumlah_anggaran');
            $table->enum('status_verifikasi', ['0', '1', '2', '3', '4']); // 0: antrian , 1 : acc bendahara , 2 : acc ketua, 3: dcc bendahara, 4: dcc ketua
            $table->timestamps();
            $table->foreign('id_jenis_anggaran')->references('id_jenis_anggaran')->on('jenis_anggaran')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_pengaju')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
}
