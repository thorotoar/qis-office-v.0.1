<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileDokumen extends Model
{
    //"$table" pengenalan table
    protected $table = 'file_dokumens';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function dokumen(){
        return $this->belongsTo(Dokumen::class, 'dokumen_id');
    }
}
