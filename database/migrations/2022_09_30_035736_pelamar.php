<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_lowongan');
            $table->string('nama_pelamar');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->string('jenis_kelamin');
            $table->string('cv');
            $table->string('ijazah');
            $table->string('pas_foto');
            $table->string('seleksi_satu');
            $table->string('seleksi_dua');
            $table->string('status_wawancara');
            $table->string('status_dokumen');
            $table->integer('nilai_tes');
            $table->longText('hasil_wawancara');
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
        Schema::dropIfExists('pelamar');
    }
};
