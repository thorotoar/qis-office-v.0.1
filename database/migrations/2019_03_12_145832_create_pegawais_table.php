<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('nik');
            $table->string('foto')->nullable()->default(null);
            $table->string('nama');
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('kelamin');
            $table->integer('agama_id')->unsigned()->nullable();
            $table->foreign('agama_id')->references('id')->on('agamas')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('kewarganegaraan_id')->unsigned()->nullable();
            $table->foreign('kewarganegaraan_id')->references('id')->on('kewarganegaraans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('telpon');
            $table->string('email');
            $table->string('status_pernikahan');
            $table->string('nuptk')->nullable();
            $table->string('no_rek')->nullable();
            $table->integer('bank_id')->unsigned()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('kcp_bank')->nullable();
            $table->string('ibu');
            $table->string('nik_ibu');
            $table->string('ayah');
            $table->string('nik_ayah');
            $table->string('pasangan')->nullable();
            $table->string('pekerjaan_pasangan')->nullable();
            $table->string('tgl_masuk');
            $table->string('tgl_selesai')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('no_sk')->nullable();
            $table->integer('lembaga_id')->unsigned()->nullable();
            $table->foreign('lembaga_id')->references('id')->on('lembagas')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('jabatan_yayasan_id')->unsigned()->nullable();
            $table->foreign('jabatan_yayasan_id')->references('id')->on('jabatans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('jabatan_id')->unsigned()->nullable();
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('status_user')->nullable();
            $table->integer('jenjang_id')->unsigned();
            $table->foreign('jenjang_id')->references('id')->on('jenjangs');
            $table->integer('jurusan_id')->unsigned()->nullable();
            $table->foreign('jurusan_id')->references('id')->on('jurusan_pendidikans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('instansi')->nullable();
            $table->string('thn_lulus');
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
        Schema::dropIfExists('pegawais');
    }
}
