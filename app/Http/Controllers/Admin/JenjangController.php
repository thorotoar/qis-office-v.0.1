<?php

namespace App\Http\Controllers\Admin;

use App\Jenjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JenjangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $jenjang = Jenjang::all();
        return view('admin.jen-management.jen-home', compact('jenjang'));
    }

    public function create(){
        return view('admin.jen-management.jen-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'jenjang' => "required|unique:jenjangs,nama_jenjang",
        ],[
            'jenjang.unique' => 'Jenjang yang anda tambahkan sudah tersedia, masukan jenjang lain!.',
        ]);

        $j = Jenjang::create([
            'nama_jenjang' => $request->jenjang,
            'created_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('jen-home')->with('sukses','Jenjang ' . $j->nama_jenjang . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $jenjang = Jenjang::find($request->id);
        return view('admin.jen-management.jen-edit', compact('jenjang'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'jenjang' => "required|unique:jenjangs,nama_jenjang,$id",
        ],[
            'jenjang.unique' => 'Jenjang yang anda tambahkan sudah tersedia, masukan jenjang lain!.',
        ]);

        $jSurat = Jenjang::find($id);
        $jSurat->update([
            'nama_jenjang' => $request->jenjang,
            'updated_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('jen-home')->with('edit','Jenjang ' . $jSurat->nama_jenjang . ' berhasil diubah.');

    }

    public function destroy($id){
        $j = Jenjang::destroy($id);

        return redirect()->route('jen-home')->with('hapus','Jenjang ' . $j->nama_jenjang . ' berhasil dihapus.');

    }
}
