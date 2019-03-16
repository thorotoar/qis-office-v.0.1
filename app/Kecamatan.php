<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //"$table" pengenalan table
    protected $table = 'kecamatans';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class);
    }

    public function kabupaten(){
        return $this->belongsTo(Provinsi::class, 'kabupaten_id');
    }
}
