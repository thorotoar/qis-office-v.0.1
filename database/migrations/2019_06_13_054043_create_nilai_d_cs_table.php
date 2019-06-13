<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiDCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_d_cs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peserta_id')->unsigned();
            $table->foreign('peserta_id')->references('id')->on('peserta_didiks')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->boolean('isHarian')->default(false);
            $table->boolean('isKonsultasi')->default(false);
            $table->string('tgl_catat')->nullable();
            $table->string('jenis')->nullable();
            $table->string('kode_aspek')->nullable();
            $table->string('instruksi')->nullable();
            $table->string('respon')->nullable();
            $table->string('nilai_hasil')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('nilai_d_cs');
    }
}
