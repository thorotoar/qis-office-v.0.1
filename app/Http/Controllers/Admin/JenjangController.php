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
            'jenjang.required' => 'Kolom ' . "<b>" . 'nama jenjang' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'jenjang.unique' => 'Jenjang yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan jenjang lain!.',
        ]);

        $j = Jenjang::create([
            'nama_jenjang' => $request->jenjang,
            'created_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('jen-home')->with('sukses','Jenjang ' . "<b>" . $j->nama_jenjang . "</b>" . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $jenjang = Jenjang::find($request->id);
        return view('admin.jen-management.jen-edit', compact('jenjang'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'jenjang' => "required|unique:jenjangs,nama_jenjang,$id",
        ],[
            'jenjang.required' => 'Kolom ' . "<b>" . 'nama jenjang' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'jenjang.unique' => 'Jenjang yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan jenjang lain!.',
        ]);

        $jSurat = Jenjang::find($id);
        $jSurat->update([
            'nama_jenjang' => $request->jenjang,
            'updated_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('jen-home')->with('edit','Jenjang ' . "<b>" . $jSurat->nama_jenjang . "</b>" . ' berhasil diubah.');

    }

    public function destroy($id){
        $j = Jenjang::find($id);
        $j->delete();

        return redirect()->route('jen-home')->with('hapus','Jenjang ' . "<b>" . $j->nama_jenjang . "</b>" . ' berhasil dihapus.');

    }
}
