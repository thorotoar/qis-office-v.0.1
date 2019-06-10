<?php

namespace App\Http\Controllers\Admin;

use App\Agama;
use App\Jenjang;
use App\Kabupaten;
use App\KebutuhanKhusus;
use App\Kecamatan;
use App\Kewarganegaraan;
use App\Lembaga;
use App\NilaiQIS;
use App\Penghasilan;
use App\PesertaDidik;
use App\Provinsi;
use App\Transportasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use PDF;
use Mail;

class AdminPesertaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $pesertaDidik = PesertaDidik::orderBy('created_at')->get();

        return view('admin.a-peserta.ap-home', compact('pesertaDidik'));
    }

    public function kabupaten(){
        $provinsi_id = Input::get('provinsi_id');
        $provinsi = Kabupaten::where('provinsi_id', '=', $provinsi_id)->get();
        return response()->json($provinsi);
    }

    public function kecamatan(){
        $kabupaten_id = Input::get('kabupaten_id');
        $kabupaten = Kecamatan::where('kabupaten_id', '=', $kabupaten_id)->get();
        return response()->json($kabupaten);
    }

    public function edit(Request $request){
        $peserta = PesertaDidik::find($request->id);

        $penghasilan = Penghasilan::all();
        $jenjang = Jenjang::all();
        $kebutuhan = KebutuhanKhusus::all();
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $negara = Kewarganegaraan::all();
        $agama = Agama::all();
        $transportasi = Transportasi::all();
        $lembaga = Lembaga::all();

        return view('admin.a-peserta.ap-edit', compact('penghasilan', 'jenjang', 'kebutuhan', 'provinsi', 'negara', 'agama', 'transportasi', 'lembaga', 'peserta', 'kabupaten', 'kecamatan'));
    }


    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'transportasi' => 'required',
            'kps' => 'required',
            'pip' => 'required',
            'kip' => 'required',
            'lembaga' => 'required',
            'nama_ibu' => 'required',
        ], [
            'nama.required' => 'Nama peserta didik belum anda isi, silahkan isi terlebih dahulu!.',
            'kelamin.required' => 'Jenis kelamin belum anda isi, silahkan isi terlebih dahulu!.',
            'tempat_lahir.required' => 'Tempat lahir belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_lahir.required' => 'Tanggal lahir belum anda isi, silahkan isi terlebih dahulu!.',
            'agama.required' => 'Agama belum anda isi, silahkan isi terlebih dahulu!.',
            'kewarganegaraan.required' => 'Kewarganegaraaan belum anda isi, silahkan isi terlebih dahulu!.',
            'alamat.required' => 'Alamat belum anda isi, silahkan isi terlebih dahulu!.',
            'desa.required' => 'Desa/kelurahan belum anda isi, silahkan isi terlebih dahulu!.',
            'provinsi.required' => 'Provinsi belum anda isi, silahkan isi terlebih dahulu!.',
            'kabupaten.required' => 'Kabupaten belum anda isi, silahkan isi terlebih dahulu!.',
            'kecamatan.required' => 'Kecamatan belum anda isi, silahkan isi terlebih dahulu!.',
            'transportasi.required' => 'Alat transportasi belum anda isi, silahkan isi terlebih dahulu!.',
            'kps.required' => 'Penerima KPS belum anda isi, silahkan isi terlebih dahulu!.',
            'pip.required' => 'Layak PIP belum anda isi, silahkan isi terlebih dahulu!.',
            'kip.required' => 'Penerima KIP belum anda isi, silahkan isi terlebih dahulu!.',
            'lembaga.required' => 'Lembaga belum anda isi, silahkan isi terlebih dahulu!.',
            'nama_ibu.required' => 'Nama ibu belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $peserta = PesertaDidik::find($id);

        $peserta->update([
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'kelamin' => $request->kelamin,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama_id' => $request->agama,
            'kewarganegaraan_id' => $request->kewarganegaraan,
            'kebutuhan_id' => $request->kebutuhan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'nama_dusun' => $request->nama_dusun,
            'desa' => $request->desa,
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'jenis_tinggal' => $request->jenis_tinggal,
            'transportasi_id' => $request->transportasi,
            'anak_ke' => $request->anak_ke,
            'telpon_rumah' => $request->telpon_rumah,
            'telpon_selular' => $request->telpon_selular,
            'email' => $request->email,
            'kps' => $request->kps,
            'no_kps' => $request->no_kps,
            'pip' => $request->pip,
            'kip' => $request->kip,
            'no_kks' => $request->no_kks,
            'reg_akta' => $request->reg_akta,
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
            'jenjang_ayah_id' => $request->jenjang_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah_id' => $request->penghasilan_ayah,
            'kebutuhan_ayah_id' => $request->kebutuhan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
            'jenjang_ibu_id' => $request->jenjang_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu_id' => $request->penghasilan_ibu,
            'kebutuhan_ibu_id' => $request->kebutuhan_ibu,
            'nama_wali' => $request->nama_wali,
            'nik_wali' => $request->nik_wali,
            'tahun_lahir_wali' => $request->tahun_lahir_wali,
            'jenjang_wali_id' => $request->jenjang_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'penghasilan_wali_id' => $request->penghasilan_wali,
            'tgl_masuk' => $request->tgl_masuk,
            'status' => $request->status,
            'lembaga_id' => $request->lembaga,
            'created_by' => Auth::user()->nama_user,

        ]);

        if (Input::has('foto_new')) {

            File::delete($peserta->foto);
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('foto_new')->getClientOriginalName());
            Input::file('foto_new')->move('images/foto-peserta/', $file);

            $peserta->update([
                'foto' => 'images/foto-peserta/' . $file,
            ]);
        }
        $nama = $request->nama;

        return redirect()->route('ap-home')->with('edit', 'Data Peserta Didik ' . "<b>" . $nama . "</b>" . ' berhasil diubah.');
    }

    public function destroy($id){
        $ser = PesertaDidik::find($id);
        $nilai = NilaiQIS::where('peserta_id', $ser->id)->first();

        $file = $ser->foto;

        if (!$nilai){
            File::delete($file);
        }else{
            File::delete($file);
            File::delete('file-sertifikat/'.$nilai->attach);
        }

        $ser->delete();

        return back()->with('destroy', 'Data ' . "<b>" . $ser->nama . "</b>" . ' berhasil dihapus.');
    }
}
