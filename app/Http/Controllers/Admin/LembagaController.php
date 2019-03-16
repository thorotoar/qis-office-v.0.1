<?php

namespace App\Http\Controllers\Admin;

use App\Lembaga;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LembagaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $lembaga = Lembaga::all();
        return view('admin.lem-management.lem-home', compact('lembaga'));
    }

    public function create(){
        return view('admin.lem-management.lem-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'lembaga' => "required|unique:lembagas,nama_lembaga",
        ],[
            'lembaga.unique' => 'Lembaga yang anda tambahkan sudah tersedia, masukan lembaga lain!.',
        ]);

        Lembaga::create([
            'nama_lembaga' => $request->lembaga,
        ]);

        return redirect()->route('lem-home')->with('sukses','Lembaga berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $lembaga = Lembaga::find($request->id);
        return view('admin.lem-management.lem-edit', compact('lembaga'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'lembaga' => "required|unique:lembagas,nama_lembaga,$id",
        ],[
            'lembaga.unique' => 'Lembaga yang anda tambahkan sudah tersedia, masukan lembaga lain!.',
        ]);

        $lembaga = Lembaga::find($id);
        $lembaga->update([
            'nama_lembaga' => $request->lembaga,
        ]);
        return redirect()->route('lem-home')->with('edit','Lembaga berhasil diubah.');

    }

    public function destroy($id){
        Lembaga::destroy($id);

        return redirect()->route('lem-home')->with('hapus','Lembaga berhasil dihapus.');

    }
}
