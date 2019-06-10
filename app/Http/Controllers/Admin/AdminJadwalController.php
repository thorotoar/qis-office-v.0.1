<?php

namespace App\Http\Controllers\Admin;

use App\Jadwal;
use App\JadwalPelajaran;
use App\Lembaga;
use App\PesertaDidik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminJadwalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function indexQIS(){
        $peg = JadwalPelajaran::where('lembaga_id', 2)->orderBy('created_at')->get();
        $lemb = Lembaga::where('id', 2)->first();
        return view('admin.a-jadwal.aj-qis-home', compact('peg', 'lemb'));
    }

    public function indexMDC(){
        $peg = JadwalPelajaran::where('lembaga_id', 3)->orderBy('created_at')->get();
        $lemb = Lembaga::where('id', 2)->first();
        return view('admin.a-jadwal.aj-mdc-home', compact('peg', 'lemb'));
    }

    public function indexABK(){
        $peg = JadwalPelajaran::where('lembaga_id', 4)->orderBy('created_at')->get();
        $lemb = Lembaga::where('id', 2)->first();
        return view('admin.a-jadwal.aj-abk-home', compact('peg', 'lemb'));
    }

    public function modalJadwal($id){
        return Jadwal::where('jadwal_id', $id)->get();
    }

    public function edit(Request $request){
        $j = JadwalPelajaran::find($request->id);
        $sis = PesertaDidik::where('jadwal_id', $j->id)->first();

        return view('admin.a-jadwal.aj-edit', compact('sis', 'j'));
    }

    public function update(Request $request){
        $j = JadwalPelajaran::find($request->id);

        $j->update([
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
            'kegiatan' => $request->kegiatan,
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->nama_user,
        ]);

        return back()->with('edit', 'Jadwal kegiatan ' . "<b>" . $j->kegiatan. "</b>" . ' ' . $j->nama . ' berhasil diubah.');
    }

    public function destroy($id){
        $j = JadwalPelajaran::find($id);
        $j->delete();

        return back()->with('hapus', 'Jadwal kegiatan ' . "<b>" . $j->nama. "</b>" . ' berhasil dihapus.');
    }
}
