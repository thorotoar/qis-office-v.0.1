<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    //"$table" pengenalan table
    protected $table = 'lembagas';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class, 'lembaga_id');
    }

    public function jadwalPelajaran(){
        return $this->hasMany(JadwalPelajaran::class);
    }

    public function pegawai(){
        return $this->hasMany(Pegawai::class);
    }

    public function jabatan(){
        return $this->hasMany(Jabatan::class);
    }

    public function jenisSurat(){
        return $this->hasMany(JenisSurat::class);
    }
}
