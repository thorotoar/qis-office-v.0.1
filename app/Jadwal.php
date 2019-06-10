<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    //"$table" pengenalan table
    protected $table = 'jadwals';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function jadwalPelajaran(){
        return $this->belongsTo(JadwalPelajaran::class, 'jadwal_id');
    }
}
