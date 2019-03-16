<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaDidik extends Model
{
    //"$table" pengenalan table
    protected $table = 'peserta_didiks';

    //"$primaryKey" kolom pengenalan primary key tabel
    protected $primaryKey = 'id';

    //"$guarded" kolom yang tidak dapat diisi secara manual
    protected $guarded = ['id'];

    public function lembaga(){
        return $this->belongsTo(Lembaga::class, 'lembaga_id');
    }

    public function transportasiPD(){
        return $this->belongsTo(Transportasi::class, 'transportasi_id');
    }

    public function kebutuhanKhusus(){
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_id');
    }

    public function kebutuhanKhususA(){
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_ayah_id');
    }

    public function kebutuhanKhususI(){
        return $this->belongsTo(KebutuhanKhusus::class, 'kebutuhan_ibu_id');
    }

    public function agama(){
        return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function kewarganegaraan(){
        return $this->belongsTo(Kewarganegaraan::class, 'kewarganegaraan_id');
    }

    public function jenjangPendidikan(){
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }

    public function jenjangPendidikanA(){
        return $this->belongsTo(Jenjang::class, 'jenjang_ayah_id');
    }

    public function jenjangPendidikanI(){
        return $this->belongsTo(Jenjang::class, 'jenjang_ibu_id');
    }

    public function jenjangPendidikanW(){
        return $this->belongsTo(Jenjang::class, 'jenjang_wali_id');
    }

    public function penghasilan(){
        return $this->belongsTo(Penghasilan::class, 'penghasilan_id');
    }

    public function penghasilanA(){
        return $this->belongsTo(Penghasilan::class, 'penghasilan_ayah_id');
    }

    public function penghasilanI(){
        return $this->belongsTo(Penghasilan::class, 'penghasilan_ibu_id');
    }

    public function penghasilanW(){
        return $this->belongsTo(Penghasilan::class, 'penghasilan_wali_id');
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function nilaiQIS(){
        return $this->hasOne(NilaiQIS::class);
    }

    public function nilaiDC(){
        return $this->hasOne(NilaiDC::class);
    }

    public function nilaiABK(){
        return $this->hasOne(NilaiABK::class);
    }

    public function isiSurat(){
        return $this->hasMany(IsiSurat::class);
    }

    public function suratKeluar(){
        return $this->belongsTo(SuratKeluar::class, 'peserta_id');
    }
}
