<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisSuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $jenisSurat = JenisSurat::all();
        return view('admin.j-s-management.m-j-s-home', compact('jenisSurat'));
    }

    public function create(){
        return view('admin.j-s-management.m-j-s-tambah');
    }

    public function show(Request $request){
        $js= JenisSurat::find($request->id);

        return view('admin.j-s-management.m-j-s-show', compact('js'));
    }

    public function store(Request $request){
        $request->validate([
            'kode' => "nullable|unique:jenis_surats,kode_surat",
            'jenis_surat' => "required|unique:jenis_surats,nama_jenis_surat",
            'lembaga' => "required",
            'template' => "required",
        ],[
            'jenis_surat.unique' => 'Jenis surat yang anda tambahkan sudah tersedia, masukan Jenis surat lain!.',
            'kode.unique' => 'Kode surat yang anda tambahkan sudah tersedia, masukan kode surat lain!.',
        ]);

        $js = JenisSurat::create([
            'kode_surat' => $request->kode,
            'nama_jenis_surat' => $request->jenis_surat,
            'template_surat' => $request->template,
            'lembaga_id' => $request->lembaga,
            'template_konten' => $request->isi,
            'created_by' => Auth::user()->pegawai->nama,
        ]);

        return redirect()->route('jsm-home')->with('sukses', "<b>" . $js->nama_jenis_surat . "</b>" .' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $jSurat = JenisSurat::find($request->id);
        return view('admin.j-s-management.m-j-s-edit', compact('jSurat'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'kode' => "nullable|unique:jenis_surats,kode_surat,$id",
            'jenis_surat' => "required|unique:jenis_surats,nama_jenis_surat,$id",
            'lembaga' => "required",
            'template' => "required",
        ],[
            'jenis_surat.unique' => 'Jenis surat yang anda tambahkan sudah tersedia, masukan Jenis surat lain!.',
            'kode.unique' => 'Kode surat yang anda tambahkan sudah tersedia, masukan kode surat lain!.',
        ]);

        $jSurat = JenisSurat::find($id);
        $jSurat->update([
            'kode_surat' => $request->kode,
            'nama_jenis_surat' => $request->jenis_surat,
            'template_surat' => $request->template,
            'lembaga_id' => $request->lembaga,
            'template_konten' => $request->isi,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);
        return redirect()->route('jsm-home')->with('edit', "<b>" . $jSurat->nama_jenis_surat . "</b>" .' berhasil diubah.');

    }

    public function destroy($id){
        $js = JenisSurat::find($id);
        $js->delete();

        return redirect()->route('jsm-home')->with('hapus', "<b>" . $js->nama_jenis_surat . "</b>" . ' berhasil dihapus.');

    }
}
