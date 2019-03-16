<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    //"$table" pengenalan table
    protected $table = 'jenis_surats';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function suratKeluar(){
        return $this->hasMany(SuratKeluar::class);
    }

    public function lembaga(){
        return $this->belongsTo(Lembaga::class, 'lembaga_id');
    }
}
