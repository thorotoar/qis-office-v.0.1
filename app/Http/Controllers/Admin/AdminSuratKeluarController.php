<?php

namespace App\Http\Controllers\Admin;

Use App\JenisSurat;
use App\SuratKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use PDF;
use DB;

class AdminSuratKeluarController extends Controller
{
    public function __construct(){
    $this->middleware('auth');
    }

    public function index(){
        $keluarView = SuratKeluar::orderBy('created_at', 'ASC')->get();
        $jenisSurat = JenisSurat::all();
        return view('admin.a-surat-keluar.ak-home', compact('keluarView', 'jenisSurat'));
    }

    public function edit(Request $request){
        $sk = SuratKeluar::find($request->id);
        $jenis = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $no_urut = str_pad(SuratKeluar::count() + 1, 3, 0, STR_PAD_LEFT);

        return view('admin.a-surat-keluar.ak-edit', compact('sk','jenis', 'no_urut'));
    }

    public function update(Request $request){
        $sk = SuratKeluar::find($request->id);
        $jenisur = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $sk->update([
            'no_surat' => $request->no_surat,
            'lampiran' => $request->lampiran,
            'perihal' => $request->perihal,
            'tempat' => $request->tempat,
            'tgl_keluar' => $request->tgl_keluar,
            'tgl_dicatat' => $request->tgl_dicatat,
            'isi_surat' => $request->isi,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        if (input::has('isi')){
            File::delete('file-surat/'.$sk->attach);
            $filename = $jenisur->nama_jenis_surat.substr($sk->no_surat, 0, 3);
            $name = str_replace(' ', '_', str_random(2) . '' . $filename);

            $pdf = PDF::loadView("admin.a-surat-keluar.ak-print", compact('sk'));
            $pdf->setPaper('Legal', 'portrait');
            $pdf->save('file-surat/'. $name .'.pdf');

            $sk->update([
                'attach' => $name.'.pdf',
            ]);
        }

        return redirect()->route('a-surk-home')->with('sukses', "<b>" . $jenisur->nama_jenis_surat.'_'.substr($sk->no_surat, 0, 3). "</b>" . ' berhasil ditambahkan.');
    }

    public  function print(Request $request){
        $sk = SuratKeluar::find($request->id);
        $jenis = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $no = substr($sk->no_surat, 0, 3);

        $pdf = PDF::setOptions(['font' => 'calibri', 'images' => true]);
        $pdf->setPaper('Legal', 'portrait');
        $pdf->loadView("admin.a-surat-keluar.ak-print", compact('sk', 'jenis'));
        return $pdf->stream(str_replace(' ', '_', str_random(2) . '' . $jenis->nama_jenis_surat.$no).'.pdf');
    }

    public function destroy($id){
        $surK = SuratKeluar::find($id);
        File::delete('file-surat/'.$surK->attach);
        $surK->delete();

        $jenis = JenisSurat::where('id', $surK->jenis_id)->firstOrFail();

        return redirect()->route('a-surk-home')->with('hapus', 'Data ' . "<b>" . $jenis['nama_jenis_surat'] . '_' . substr($surK->no_surat, 0, 3) . "</b>" . ' terpilih berhasil dihapus.');
    }
}
