<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    //"$table" pengenalan table
    protected $table = 'jadwal_pelajarans';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function lembaga_jp(){
        return $this->belongsTo(Lembaga::class, 'lembaga_id');
    }
}
