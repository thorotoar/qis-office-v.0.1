<?php

namespace App\Http\Controllers\pegawai;

use App\Dokumen;
use App\FileDokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class DokumenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dokumenV = Dokumen::orderBy('created_at', 'ASC')->get();
//        $fileDok = FileDokumen::where('dokumen_id', $dokumenV)->get()->toArray();
        return view('pegawai.dokumen.d-home', compact('dokumenV', 'fileDok'));
    }

    public function show(Request $request){
        $dokumen = Dokumen::find($request->id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get()->toArray();

        return view('pegawai.dokumen.d-show-page', compact('dokumen', 'fileDok'));
    }

    public  function download(Request $request){
        $dl = FileDokumen::find($request->id);

        return response()->download($dl->upload_file, substr($dl->title, 2));
    }

    public function create(){
        $dokumen = Dokumen::all();
        return view('pegawai.dokumen.d-tambah', compact('dokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required|unique:dokumens,nama_dokumen',
            'keterangan' => 'nullable|unique:dokumens,keterangan',
            'upload_file' => 'required',
            'upload_file.*' => 'mimes:jpg,jpeg,gif,png,pdf,doc,docx,txt,zip,rar,xls,xlsx,odt,ppt,pptx,video/avi,video/mpeg,video/quicktime|max:10000',
        ],[
            'nama_dokumen.required' => 'Nama dokumen belum anda isi, silahkan isi terlebih dahulu!.',
            'upload_file.required' => 'File dokumen belum anda isi, silahkan isi terlebih dahulu!.',
            'nama_dokumen.unique' => 'Nama dokumen yang anda tambahkan sudah tersedia, masukan nama dokumen lain!.',
            'keterangan.unique' => 'Keterangan yang anda tambahkan sudah tersedia, masukan keterangan lain!.',
        ]);

        $nama = $request->nama_dokumen;

        $dokumen = Dokumen::create([
            'user_id' => Auth::user()->id,
            'nama_dokumen' => $request->nama_dokumen,
            'tgl_file' => $request->tgl_file,
            'tgl_dicatat' => $request->tgl_dicatat,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::user()->nama_user,

        ]);

        if (Input::has('upload_file')) {
            //$user = Dokumen::find($request->id);
            foreach ($request->file('upload_file') as $files){
                $name = str_replace(' ', '_', str_random(2) . '' . $files->getClientOriginalName());
                $files->move('images/file-dokumen/', $name);
                FileDokumen::create([
                    'dokumen_id' => $dokumen->id,
                    'title' => $name,
                    'upload_file' => 'images/file-dokumen/' . $name,
                ]);
            }
        }


        return redirect()->route('d-home')->with('sukses','File '. $nama . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){

        $dokumen = Dokumen::find($request->id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get()->toArray();
        //dd($fileDok);

        return view('pegawai.dokumen.d-edit', compact('dokumen', 'fileDok'));
    }


    public function update(Request $request, $id){

        $dokumen = Dokumen::find($id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get();

        //dd($pegawai);
        $dokumen->update([
            'user_id' => Auth::user()->id,
            'nama_dokumen' => $request->nama_dokumen,
            'tgl_file' => $request->tgl_file,
            'tgl_dicatat' => $request->tgl_dicatat,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->nama_user,
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
                $files->move('images/file-dokumen/', $name);
                FileDokumen::create([
                    'dokumen_id' => $dokumen->id,
                    'title' => $name,
                    'upload_file' => 'images/file-dokumen/' . $name,
                ]);
            }
        }

//        return redirect()->route('d-home')->with('edit', 'Dokumen berhasil diubah.'); //Lanjutkan dengan mengisi riwayat pendidikan.
        return back()->with('edit', 'Dokumen berhasil diubah.');;
    }

    public function destroy($id){

        $dok = Dokumen::find($id);
        $nama = $dok->nama_dokumen;
        $fileDok = FileDokumen::where('dokumen_id', $dok->id)->get();

        foreach ( $fileDok as $files){
            $file = $files->upload_file;
            File::delete($file);
            $dok->delete();
        }


        return back()->with('hapus', 'Data '. $nama . ' berhasil dihapus.');
    }
}
