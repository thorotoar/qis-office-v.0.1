<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    //"$table" pengenalan table
    protected $table = 'jenjangs';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function jenjang(){
        return $this->hasMany(Pegawai::class);
    }

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class);
    }
}
