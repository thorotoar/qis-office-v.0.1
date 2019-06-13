<?php

namespace App\Http\Controllers\Admin;

use App\Sertifikat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SertifikatController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $ser = Sertifikat::orderBy('id', 'ASC')->get();

        return view('admin.ser-management.ser-home', compact('ser'));
    }

    public function create(){
        return view('admin.ser-management.ser-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'versi' => 'required|unique:sertifikats,versi_sertifikat',
            'tgl_catat' => 'required',
            'file_sertifikat' => 'required',
        ],[
            'versi.required' => 'Kolom ' . "<b>" . 'versi sertifikat' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'versi.unique' => "<b>" . 'Versi sertifikat' . "</b>" . ' yang anda tambahkan sudah tersedia,' .  ' masukan versi sertifikat lain!.',
            'tgl_catat.required' => 'Kolom ' . "<b>" . 'tanggal dicatat' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
            'file_sertifikat.required' => 'Kolom ' . "<b>" . 'template sertifikat' . "</b>" .  ' belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $tshs = Sertifikat::all();
        foreach ($tshs as $tsh){
            File::delete($tsh->template_sertifikat);
            $tsh->delete();
        }

        $ts = Sertifikat::create([
            'user_id' => Auth::user()->id,
            'versi_sertifikat' => $request->versi,
            'tgl_dicatat' => $request->tgl_catat,
            'created_by' => Auth::user()->nama_user,
        ]);

//        dd($ts);

        if (Input::has('file_sertifikat')) {
            $file = 'file-sertifikat.' . $request->file('file_sertifikat')->getClientOriginalExtension();
            Input::file('file_sertifikat')->move('images/sertifikat/', $file);
            $ts->update([
                'template_sertifikat' => 'images/sertifikat/' . $file,
            ]);
        }

        return redirect()->route('ts-home')->with('sukses', "<b>" . 'Sertifikat ' . $ts->versi_sertifikat . "</b>" . ' berhasil ditambahkan.');
    }
}
