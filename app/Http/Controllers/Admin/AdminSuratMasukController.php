<?php

namespace App\Http\Controllers\Admin;

use App\SuratMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use PDF;

class AdminSuratMasukController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $smasukView = SuratMasuk::orderBy('created_at', 'ASC')->get();
        return view('admin.a-surat-masuk.am-home', compact('smasukView'));
    }

    public function edit(Request $request){
        $suratM = SuratMasuk::find($request->id);

        return view('admin.a-surat-masuk.am-edit', compact('suratM'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_surat' => 'required',
            'tgl_diterima' => 'required',
            'tgl_dicatat' => 'required',
            'pengirim' => 'required',
            'penerima' => 'required',
            'prihal' => 'nullable',
        ],[
            'no_surat.required' => 'Nomor surat belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_diterima.required' => 'Tanggal diterima belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_dicatat.required' => 'Tanggal dicatat belum anda isi, silahkan isi terlebih dahulu!.',
            'pengirim.required' => 'Pengirim belum anda isi, silahkan isi terlebih dahulu!.',
            'penerima.required' => 'Penerima belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $suratM = SuratMasuk::find($id);

        $suratM->update([
            'no_surat' => $request->no_surat,
            'tgl_diterima' => $request->tgl_diterima,
            'tgl_dicatat' => $request->tgl_dicatat,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'perihal' => $request->prihal,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        if (Input::has('upload_file_new')) {

            File::delete($suratM->upload_file);
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('upload_file_new')->getClientOriginalName());
            Input::file('upload_file_new')->move('file-surat-masuk/', $file);

            $suratM->update([
                'upload_file' => 'file-surat-masuk/' . $file,
            ]);
        }

        return redirect()->route('a-surm-home')->with('edit', 'Surat masuk ' . "<b>" . $suratM->no_surat . "</b>" . ' berhasil diubah.');
    }

    public function destroy($id){

        $surM = SuratMasuk::find($id);
        $file = $surM->upload_file;
        File::delete($file);
        $surM->delete();

        return back()->with('hapus', 'Surat masuk ' . "<b>" . $surM->no_surat . "</b>" . ' berhasil dihapus.');
    }
}
