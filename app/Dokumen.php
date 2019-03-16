<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    //"$table" pengenalan table
    protected $table = 'dokumens';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function file_dokumen(){
        return $this->hasMany(FileDokumen::class);
    }
}
