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

    public function store(Request $request){
        $request->validate([
            'jenis_surat' => "required|unique:jenis_surats,nama_jenis_surat",
        ],[
            'jenis_surat.unique' => 'Jenis surat yang anda tambahkan sudah tersedia, masukan Jenis surat lain!.',
        ]);

        JenisSurat::create([
            'nama_jenis_surat' => $request->jenis_surat,
            'template_surat' => $request->template,
            'lembaga_id' => $request->lembaga,
            'template_konten' => $request->isi,
            'created_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('jsm-home')->with('sukses','Jenis Surat berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $jSurat = JenisSurat::find($request->id);
        return view('admin.j-s-management.m-j-s-edit', compact('jSurat'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'jenis_surat' => "required|unique:jenis_surats,nama_jenis_surat,$id",
        ],[
            'jenis_surat.unique' => 'Jenis surat yang anda tambahkan sudah tersedia, masukan Jenis surat lain!.',
        ]);

        $jSurat = JenisSurat::find($id);
        $jSurat->update([
            'nama_jenis_surat' => $request->jenis_surat,
            'template_surat' => $request->template,
            'lembaga_id' => $request->lembaga,
            'template_konten' => $request->isi,
            'updated_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('jsm-home')->with('edit','Jenis Surat berhasil diubah.');

    }

    public function destroy($id){
        JenisSurat::destroy($id);

        return redirect()->route('jsm-home')->with('hapus','Jenis Surat berhasil dihapus.');

    }
}
