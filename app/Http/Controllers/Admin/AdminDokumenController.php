<?php

namespace App\Http\Controllers\Admin;

use App\Dokumen;
use App\FileDokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class AdminDokumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dokumenV = Dokumen::orderBy('created_at', 'ASC')->get();
        return view('admin.a-dokumen.a-d-home', compact('dokumenV', 'fileDok'));
    }

    public function show(Request $request){
        $dokumen = Dokumen::find($request->id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get()->toArray();

        return view('admin.a-dokumen.a-d-show-page', compact('dokumen', 'fileDok'));
    }

    public  function download(Request $request){
        $dl = FileDokumen::find($request->id);

        return response()->download($dl->upload_file, substr($dl->title, 2));
    }

    public function edit(Request $request){
        $dokumen = Dokumen::find($request->id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get()->toArray();

        return view('admin.a-dokumen.a-d-edit', compact('dokumen', 'fileDok'));
    }


    public function update(Request $request, $id){
        $dokumen = Dokumen::find($id);

        $dokumen->update([
            'nama_dokumen' => $request->nama_dokumen,
            'tgl_file' => $request->tgl_file,
            'tgl_dicatat' => $request->tgl_dicatat,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        if (Input::has('delete_file')) {
            $checked = $request->delete_file;
            $file = FileDokumen::whereIn('id',$checked)->pluck('upload_file');
            foreach ($file as $item){
                File::delete($item);
                $doc = FileDokumen::where('upload_file',$item)->first();
                $doc->delete();
            }
        }

        if (Input::has('upload_file')) {
            //$user = Dokumen::find($request->id);
            foreach ($request->file('upload_file') as $files){
                $name = str_replace(' ', '_', str_random(2) . '' . $files->getClientOriginalName());
                $files->move('file-dokumen/', $name);
                FileDokumen::create([
                    'dokumen_id' => $dokumen->id,
                    'title' => $name,
                    'upload_file' => 'file-dokumen/' . $name,
                ]);
            }
        }

        return redirect()->route('ad-home')->with('edit', 'Dokumen ' . "<b>" . $dokumen->nama_dokumen . "</b>" . ' berhasil diubah.');
    }

    public function destroy($id){
        $dok = Dokumen::find($id);
        $fileDok = FileDokumen::where('dokumen_id', $dok->id)->get();

        foreach ( $fileDok as $files){
            $file = $files->upload_file;
            File::delete($file);
            $dok->delete();
        }
        return back()->with('hapus', 'Data '. "<b>" . $dok->nama_dokumen . "</b>" . ' berhasil dihapus.');
    }
}
