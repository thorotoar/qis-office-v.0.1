<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //"$table" pengenalan table
    protected $table = 'jabatans';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    //protected $fillable = ['nama_jabatan'];

    public function p_jabatan(){
        return $this->hasMany(Pegawai::class);
    }

    public function lembaga(){
        return $this->belongsTo(Lembaga::class);
    }
}
