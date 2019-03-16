<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiABK extends Model
{
    //"$table" pengenalan table
    protected $table = 'nilai_a_b_ks';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pesertaDidik_abk(){
        return $this->belongsTo(PesertaDidik::class, 'peserta_didik_id');
    }
}
