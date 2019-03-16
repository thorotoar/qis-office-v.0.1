<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //"$table" pengenalan table
    protected $table = 'provinsis';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function kabupaten(){
        return $this->hasMany(Kabupaten::class);
    }

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class);
    }
}
