<?php

namespace App\Http\Controllers\Admin;

use App\JurusanPendidikan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $jurusan = JurusanPendidikan::all();
        return view('admin.jur-management.jur-home', compact('jurusan'));
    }

    public function create(){
        return view('admin.jur-management.jur-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'jurusan' => "required|unique:jurusan_pendidikans,nama_jurusan_pendidikan",
        ],[
            'jurusan.required' => 'Kolom ' . "<b>" . 'nama jurusan' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'jurusan.unique' => 'Jurusan yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan jurusan lain!.',
        ]);

        $jp = JurusanPendidikan::create([
            'nama_jurusan_pendidikan' => $request->jurusan,
            'created_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('jur-home')->with('sukses','Jurusan ' . "<b>" . $jp->nama_jurusan_pendidikan . "</b>" . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $jurusan = JurusanPendidikan::find($request->id);
        return view('admin.jur-management.jur-edit', compact('jurusan'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'jurusan' => "required|unique:jurusan_pendidikans,nama_jurusan_pendidikan,$id",
        ],[
            'jurusan.required' => 'Kolom ' . "<b>" . 'nama jurusan' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'jurusan.unique' => 'Jurusan yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan jurusan lain!.',
        ]);

        $jurusan = JurusanPendidikan::find($id);
        $jurusan->update([
            'nama_jurusan_pendidikan' => $request->jurusan,
            'updated_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('jur-home')->with('edit','Jurusan ' . "<b>" . $jurusan->nama_jurusan_pendidikan . "</b>" . ' berhasil diubah.');

    }

    public function destroy($id){
        $jp = JurusanPendidikan::find($id);
        $jp->delete();

        return redirect()->route('jur-home')->with('hapus','Jurusan ' . "<b>" . $jp->nama_jurusan_pendidikan . "</b>" . ' berhasil dihapus.');

    }
}
