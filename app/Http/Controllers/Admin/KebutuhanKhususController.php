<?php

namespace App\Http\Controllers\Admin;

use App\KebutuhanKhusus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KebutuhanKhususController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $kk = KebutuhanKhusus::orderBy('id', 'ASC')->get();
        return view('admin.keb-management.keb-home', compact('kk'));
    }

    public function create(){
        return view('admin.keb-management.keb-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'kebutuhan' => 'required|unique:kebutuhan_khususes,nama_kebutuhan',
            'kode' => 'required|unique:kebutuhan_khususes,kode_kebutuhan',
        ],[
            'kebutuhan.required' => 'Kolom ' . "<b>" . 'nama kebutuhan' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'kebutuhan.unique' => 'Nama kebutuhan yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan kebutuhan lain!.',
            'kode.required' => 'Kolom ' . "<b>" . 'kode' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'kode.unique' => 'Kode yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan kode lain!.'
        ]);

        $kk = KebutuhanKhusus::create([
            'kode_kebutuhan' => $request->kode,
            'nama_kebutuhan' => $request->kebutuhan,
            'created_by' => Auth::user()->pegawai->nama,
        ]);
        return redirect()->route('keb-home')->with('sukses','Kebutuhan khusus ' . "<b>" . $kk->nama_kebutuhan . "</b>" . ' baru berhasil ditambahkan.');
    }

    public function show($id){
        $kk = KebutuhanKhusus::find($id);
        return view('admin.keb-management.keb-show', compact('kk'));
    }

    public function edit(Request $request){
        $kk = KebutuhanKhusus::find($request->id);
        return view('admin.keb-management.keb-edit', compact('kk'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'kebutuhan' => "required|unique:kebutuhan_khususes,nama_kebutuhan, $id",
            'kode' => "required|unique:kebutuhan_khususes,kode_kebutuhan,$id",
        ],[
            'kebutuhan.required' => 'Kolom ' . "<b>" . 'nama kebutuhan' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'kebutuhan.unique' => 'Nama kebutuhan yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan kebutuhan lain!.',
            'kode.required' => 'Kolom ' . "<b>" . 'kode' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'kode.unique' => 'Kode yang anda tambahkan ' . "<b>" . 'sudah tersedia,' . "</b>" .  ' masukan kode lain!.'
        ]);

        $kk = KebutuhanKhusus::find($id);
        $kk->update([
            'kode_kebutuhan' => $request->kode,
            'nama_kebutuhan' => $request->kebutuhan,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        return redirect()->route('keb-home')->with('edit','Kebutuhan khusus ' . "<b>" . $kk->nama_kebutuhan . "</b>" . ' berhasil diubah.');
    }

    public function destroy($id){
        $kk = KebutuhanKhusus::find($id);
        $kk->delete();

        return redirect()->route('keb-home')->with('hapus','Kebutuhan khusus ' . "<b>" . $kk->nama_kebutuhan . "</b>" . ' berhasil dihapus.');
    }
}
