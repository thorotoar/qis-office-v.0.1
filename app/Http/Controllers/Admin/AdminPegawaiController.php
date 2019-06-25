<?php

namespace App\Http\Controllers\Admin;

use App\Agama;
use App\Bank;
use App\Http\Controllers\Controller;
use App\Jabatan;
use App\Jenjang;
use App\JurusanPendidikan;
use App\Kewarganegaraan;
use App\Lembaga;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use PDF;

class AdminPegawaiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $pegawai_view = Pegawai::orderBy('created_at', 'ASC')->get();
        return view('admin.a-pegawai.a-d-p-home', compact('pegawai_view'));
    }

    public function jabatan(){
        $lembaga_id = Input::get('lembaga_id');
        $jabatan = Jabatan::where('lembaga_id', '=', $lembaga_id)->get();
        return response()->json($jabatan);
    }

    public function edit(Request $request){
        $pegawai = Pegawai::find($request->id);

        $jabatan = Jabatan::where('lembaga_id', '!=', 1)->get();
        $kewarganegaraan = Kewarganegaraan::all();
        $agama = Agama::all();
        $bank = Bank::all();
        $lembaga = Lembaga::where('id', '!=', [1])->get();
        $jabaya = Jabatan::where('lembaga_id', '=', 1)->get();
        $jenjang = Jenjang::whereIn('id', [8,9,10,11,12,13,14,15,16,17,18,19,20])->get();
        $jurusan = JurusanPendidikan::all();

        return view('admin.a-pegawai.a-d-p-edit', compact('pegawai', 'rpegawai', 'jabatan', 'kewarganegaraan', 'agama', 'bank', 'lembaga', 'jabaya', 'jenjang', 'jurusan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_telp' => "required|unique:pegawais,telpon,$id",
            'email' => "required|unique:pegawais,email,$id",
            'no_rek' => "nullable|unique:pegawais,no_rek,$id",
        ],[
            'no_telp.required' => 'Nomor Telpon belum anda isi, silahkan isi terlebih dahulu!.',
            'email.required' => 'E-Mail belum anda isi, silahkan isi terlebih dahulu!.',
            'no_telp.unique' => 'Nomor Telpon yang anda tambahkan sudah tersedia, masukan Nomor Telpon lain!.',
            'email.unique' => 'E-Mail yang anda tambahkan sudah tersedia, masukan E-mail lain!.',
            'no_rek.unique' => 'Nomor Rekening yang anda tambahkan sudah tersedia, masukan Nomor Rekening lain!.',
        ]);

        $pegawai = Pegawai::find($id);

        $pegawai->update([
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'foto' => $request->foto,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tanggal_lahir,
            'kelamin' => $request->kelamin,
            'agama_id' => $request->agama,
            'kewarganegaraan_id' => $request->negara,
            'telpon' => $request->no_telp,
            'email' => $request->email,
            'status_pernikahan' => $request->status,
            'nuptk' => $request->nuptk,
            'no_rek' => $request->no_rek,
            'bank_id' => $request->bank,
            'kcp_bank' => $request->kcp_bank,
            'ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'pasangan' => $request->nama_p,
            'pekerjaan_pasangan' => $request->pekerjaan_p,
            'tgl_masuk' => $request->tanggal_masuk,
            'tgl_selesai' => $request->tanggal_selesai,
            'no_sk' => $request->no_sk,
            'jabatan_yayasan_id' => $request->jabatanY,
            'jabatan_id' => $request->jabatan,
            'lembaga_id' => $request->lembaga,
            'status_pekerjaan' => $request->tanggal_selesai == null ? 'aktif' : 'tidak_aktif',
            'jenjang_id' => $request->jenjang,
            'jurusan_id' => $request->jurusan,
            'instansi' => $request->instansi,
            'thn_lulus' => $request->thn_lulus,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        if (Input::has('foto_new')) {

            File::delete($pegawai->foto);
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('foto_new')->getClientOriginalName());
            Input::file('foto_new')->move('images/foto-pegawai/', $file);

            $pegawai->update([
                'foto' => 'images/foto-pegawai/' . $file,
            ]);
        }
        return redirect()->route('ad-pegawai')->with('update_r', 'Data ' . "<b>" . $pegawai->nama . "</b>" . ' berhasil diupdate.');
    }

    public function destroy($id){
        $ser = Pegawai::find($id);
        $file = $ser->foto;
        File::delete($file);
        $ser->delete();

        return back()->with('destroy', 'Data ' . "<b>" . $ser->nama . "</b>" . ' terpilih berhasil dihapus.');
    }
}
