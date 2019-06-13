<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiQISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_q_i_s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peserta_id')->unsigned()->nullable();
            $table->foreign('peserta_id')->references('id')->on('peserta_didiks')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('nomor_nilai')->nullable();
            $table->boolean('isLulus')->default(false);
            $table->string('tgl_dicatat')->nullable();
            $table->string('program')->nullable();
            $table->string('nilai_grammar')->nullable();
            $table->string('nilai_comprehension')->nullable();
            $table->string('nilai_conversation')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('attach')->nullable();
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
        Schema::dropIfExists('nilai_q_i_s');
    }
}
