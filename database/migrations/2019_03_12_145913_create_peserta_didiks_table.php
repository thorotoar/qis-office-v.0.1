<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaDidiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_didiks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('foto')->nullable()->default(null);
            $table->string('nama')->nullable();
            $table->string('kelamin')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->integer('agama_id')->unsigned()->nullable();
            $table->foreign('agama_id')->references('id')->on('agamas');
            $table->integer('kewarganegaraan_id')->unsigned()->nullable();
            $table->foreign('kewarganegaraan_id')->references('id')->on('kewarganegaraans');
            $table->integer('kebutuhan_id')->unsigned()->nullable();
            $table->foreign('kebutuhan_id')->references('id')->on('kebutuhan_khususes')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('nama_dusun')->nullable();
            $table->string('desa')->nullable();
            $table->integer('provinsi_id')->unsigned()->nullable();
            $table->foreign('provinsi_id')->references('id')->on('provinsis')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('kabupaten_id')->unsigned()->nullable();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('kecamatan_id')->unsigned()->nullable();
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('kode_pos')->nullable();
            $table->string('jenis_tinggal')->nullable();
            $table->integer('transportasi_id')->unsigned()->nullable();
            $table->foreign('transportasi_id')->references('id')->on('transportasis')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('anak_ke')->nullable();
            $table->string('telpon_rumah')->nullable();
            $table->string('telpon_selular')->nullable();
            $table->string('email')->nullable();
            $table->string('kps')->nullable();
            $table->string('no_kps')->nullable();
            $table->string('pip')->nullable();
            $table->string('kip')->nullable();
            $table->string('no_kks')->nullable();
            $table->string('reg_akta')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->string('tahun_lahir_ayah')->nullable();
            $table->integer('jenjang_ayah_id')->unsigned()->nullable();
            $table->foreign('jenjang_ayah_id')->references('id')->on('jenjangs')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('pekerjaan_ayah')->nullable();
            $table->integer('penghasilan_ayah_id')->unsigned()->nullable();
            $table->foreign('penghasilan_ayah_id')->references('id')->on('penghasilans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('kebutuhan_ayah_id')->unsigned()->nullable();
            $table->foreign('kebutuhan_ayah_id')->references('id')->on('kebutuhan_khususes')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('tahun_lahir_ibu')->nullable();
            $table->integer('jenjang_ibu_id')->unsigned()->nullable();
            $table->foreign('jenjang_ibu_id')->references('id')->on('jenjangs')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('pekerjaan_ibu')->nullable();
            $table->integer('penghasilan_ibu_id')->unsigned()->nullable();
            $table->foreign('penghasilan_ibu_id')->references('id')->on('penghasilans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->integer('kebutuhan_ibu_id')->unsigned()->nullable();
            $table->foreign('kebutuhan_ibu_id')->references('id')->on('kebutuhan_khususes')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('nama_wali')->nullable();
            $table->string('nik_wali')->nullable();
            $table->string('tahun_lahir_wali')->nullable();
            $table->integer('jenjang_wali_id')->unsigned()->nullable();
            $table->foreign('jenjang_wali_id')->references('id')->on('jenjangs')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('pekerjaan_wali')->nullable();
            $table->integer('penghasilan_wali_id')->unsigned()->nullable();
            $table->foreign('penghasilan_wali_id')->references('id')->on('penghasilans')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->string('tgl_masuk')->nullable();
            $table->string('status')->nullable();
            $table->integer('lembaga_id')->unsigned()->nullable();
            $table->foreign('lembaga_id')->references('id')->on('lembagas')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('peserta_didiks');
    }
}
