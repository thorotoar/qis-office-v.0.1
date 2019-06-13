<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    //"$table" pengenalan table
    protected $table = 'sertifikats';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];
}
