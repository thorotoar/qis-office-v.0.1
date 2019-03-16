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
            'jurusan.unique' => 'Jurusan yang anda tambahkan sudah tersedia, masukan jurusan lain!.',
        ]);

        JurusanPendidikan::create([
            'nama_jurusan_pendidikan' => $request->jurusan,
            'created_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('jur-home')->with('sukses','Jurusan berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $jurusan = JurusanPendidikan::find($request->id);
        return view('admin.jur-management.jur-edit', compact('jurusan'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'jurusan' => "required|unique:jurusan_pendidikans,nama_jurusan_pendidikan,$id",
        ],[
            'jurusan.unique' => 'Jurusan yang anda tambahkan sudah tersedia, masukan jurusan lain!.',
        ]);

        $jurusan = JurusanPendidikan::find($id);
        $jurusan->update([
            'nama_jurusan_pendidikan' => $request->jurusan,
            'updated_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('jur-home')->with('edit','Jurusan berhasil diubah.');

    }

    public function destroy($id){
        JurusanPendidikan::destroy($id);

        return redirect()->route('jur-home')->with('hapus','Jurusan berhasil dihapus.');

    }
}
