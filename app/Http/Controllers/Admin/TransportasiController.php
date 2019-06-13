<?php

namespace App\Http\Controllers\Admin;

use App\Transportasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransportasiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $tran = Transportasi::orderBy('id', 'ASC')->get();
        return view('admin.tran-management.tran-home', compact('tran'));
    }

    public function create(){
        return view('admin.tran-management.tran-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'transportasi' => 'required|unique:transportasis,nama_transportasi',
        ],[
            'transportasi.required' => 'Kolom ' . "<b>" . 'jenis transportasi' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'transportasi.unique' => 'Jenis transportasi yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan jenis transportasi lain!.',
        ]);

        $tran = Transportasi::create([
            'nama_transportasi' => $request->transportasi,
            'created_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('tran-home')->with('sukses', 'Jenis tranportasi ' . "<b>" . $tran->nama_transportasi . "</b>" . ' berhasil ditambahkan.');
    }

    public function show($id){
        $tran = Transportasi::find($id);
        return view('admin.tran-management.tran-show', compact('tran'));
    }

    public function edit(Request $request){
        $tran = Transportasi::find($request->id);
        return view('admin.tran-management.tran-edit', compact('tran'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'transportasi' => "required|unique:transportasis,nama_transportasi,$id",
        ],[
            'transportasi.required' => 'Kolom ' . "<b>" . 'jenis transportasi' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'transportasi.unique' => 'Jenis transportasi yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan jenis transportasi lain!.',
        ]);

        $tran = Transportasi::find($id);
        $tran->update([
            'nama_transportasi' => $request->transportasi,
            'updated_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('tran-home')->with('edit','Jenis tranportasi ' . "<b>" . $tran->nama_transportasi . "</b>" . ' berhasil diubah.');
    }

    public function destroy($id){
        $tran = Transportasi::find($id);
        $tran->delete();

        return redirect()->route('tran-home')->with('hapus','Jenis tranportasi ' . "<b>" . $tran->nama_transportasi . "</b>" . ' berhasil dihapus.');
    }
}
