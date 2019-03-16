<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //"$table" pengenalan table
    protected $table = 'banks';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pegawai(){
        return $this->hasMany(Pegawai::class);
    }
}
