<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    //"$table" pengenalan table
    protected $table = 'agamas';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function p_agama(){
        return $this->hasMany(Pegawai::class);
    }

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class);
    }
}
