<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiABKsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_a_b_ks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peserta_id')->unsigned();
            $table->foreign('peserta_id')->references('id')->on('peserta_didiks')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->boolean('isMonitoring')->default(false);
            $table->boolean('isEvaluasi')->default(false);
            $table->string('tgl_monitoring')->nullable();
            $table->string('tgl_evaluasi')->nullable();
            $table->string('aktivitas')->nullable();
            $table->string('sub_aktivitas')->nullable();
            $table->string('target')->nullable();
            $table->string('nilai')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('keterangan')->nullable();
            $table->text('evaluasi')->nullable();

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
        Schema::dropIfExists('nilai_a_b_ks');
    }
}
