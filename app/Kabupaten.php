<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    //"$table" pengenalan table
    protected $table = 'kabupatens';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class);
    }

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class);
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
