<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JurusanPendidikan extends Model
{
    //"$table" pengenalan table
    protected $table = 'jurusan_pendidikans';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function jurusan(){
        return $this->hasMany(Pegawai::class);
    }
}
