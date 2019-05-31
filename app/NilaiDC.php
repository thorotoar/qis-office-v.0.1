<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiDC extends Model
{
    //"$table" pengenalan table
    protected $table = 'nilai_d_cs';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pesertaDidikDC(){
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id');
    }
}
