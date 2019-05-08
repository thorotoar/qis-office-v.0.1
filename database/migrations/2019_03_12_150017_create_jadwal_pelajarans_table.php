<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('siswa_id')->unsigned()->nullable();
            $table->foreign('siswa_id')->references('id')->on('peserta_didiks');
            $table->string('waktu_mulai');
            $table->string('waktu_akhir');
            $table->string('kegiatan');
            $table->string('ruangan');
            $table->string('keterangan');
            $table->string('thn_jadwal')->nullable();
            $table->string('tgl_dicatat');
            $table->integer('lembaga_id')->unsigned();
            $table->foreign('lembaga_id')->references('id')->on('lembagas');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('jadwal_pelajarans');
    }
}
