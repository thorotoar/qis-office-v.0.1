<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiQIS extends Model
{
    //"$table" pengenalan table
    protected $table = 'nilai_q_i_s';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pesertaDidikQIS(){
        return $this->belongsTo(PesertaDidik::class, 'peserta_id');
    }
}
