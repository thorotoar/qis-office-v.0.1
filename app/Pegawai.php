<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //"$table" pengenalan table
    protected $table = 'pegawais';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function jabatanYayasan(){
        return $this->belongsTo(Jabatan::class, 'jabatan_yayasan_id');
    }

    public function agama(){
        return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function kewarganegaraan(){
        return $this->belongsTo(Kewarganegaraan::class, 'kewarganegaraan_id');
    }

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function lembaga(){
        return $this->belongsTo(Lembaga::class, 'lembaga_id');
    }

    public function jenjang(){
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function jurusan(){
        return $this->belongsTo(JurusanPendidikan::class, 'jurusan_id');
    }
}
