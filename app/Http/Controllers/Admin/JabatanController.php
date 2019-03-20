<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jabatan = Jabatan::orderBy('id', 'ASC')->get();
        return view('admin.j-management.m-j-home', compact('jabatan'));
    }

    public function create()
    {
        return view('admin.j-management.m-j-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|unique:jabatans,nama_jabatan',
        ],[
            'jabatan.unique' => 'Jabatan yang anda tambahkan sudah tersedia, masukan jabatan lain!.',
        ]);

        Jabatan::create([
            'kode_jabatan' => $request->kode,
            'nama_jabatan' => $request->jabatan,
            'created_by' => Auth::user()->nama_user,
        ]);
        return redirect()->route('jm-home')->with('sukses','Jabatan baru berhasil ditambahkan.');
    }

    public function show($id)
    {
        //return $id;

        $jabatan = Jabatan::find($id);
        return view('admin.j-management.m-j-show', compact('jabatan'));
    }

    public function edit(Request $request)
    {

        $jabatan = Jabatan::find($request->id);
        return view('admin.j-management.m-j-edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => "required|unique:jabatans,nama_jabatan,$id",
        ],[
            'jabatan.unique' => 'Jabatan yang anda tambahkan sudah tersedia, masukan jabatan lain!.',
        ]);

        $jabatan = Jabatan::find($id);
        $jabatan->update([
            'kode_jabatan' => $request->kode,
            'nama_jabatan' => $request->jabatan,
            'updated_by' => Auth::user()->nama_user,
        ]);

        return redirect()->route('jm-home')->with('edit','Jabatan berhasil diubah.');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();

        return redirect('/admin/manajemen-jabatan')->with('hapus','Jabatan berhasil dihapus.');
    }
}
