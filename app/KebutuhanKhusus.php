<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KebutuhanKhusus extends Model
{
    //"$table" pengenalan table
    protected $table = 'kebutuhan_khususes';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function pesertaDidik(){
        return $this->hasMany(PesertaDidik::class);
    }
}
