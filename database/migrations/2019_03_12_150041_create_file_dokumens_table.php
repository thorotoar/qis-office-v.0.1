<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_dokumens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dokumen_id')->unsigned()->nullable();
            $table->foreign('dokumen_id')->references('id')->on('dokumens')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('title')->nullable();
            $table->text('upload_file')->nullable();
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
        Schema::dropIfExists('file_dokumens');
    }
}
