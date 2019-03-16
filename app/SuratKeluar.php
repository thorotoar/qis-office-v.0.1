<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    //"$table" pengenalan table
    protected $table = 'surat_keluars';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function jenisSurat(){
        return $this->belongsTo(JenisSurat::class, 'jenis_id');
    }

    public function pesertaDidik(){
        return $this->hasOne(PesertaDidik::class);
    }

    public function isiSurat(){
        return $this->hasOne(IsiSurat::class);
    }
}
