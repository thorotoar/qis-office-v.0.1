<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jadwal_id')->unsigned()->nullable();
            $table->foreign('jadwal_id')->references('id')->on('jadwal_pelajarans')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('hari')->nullable();
            $table->string('waktu_mulai')->nullable();
            $table->string('waktu_akhir')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('jadwals');
    }
}
