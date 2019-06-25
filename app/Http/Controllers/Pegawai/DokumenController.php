<?php

namespace App\Http\Controllers\pegawai;

use App\Dokumen;
use App\FileDokumen;
use App\Mail\DokumenEmail;
use App\Mail\DokumenEmailRaw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Mail;
use PDF;

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

    public function store(Request $request){
        $request->validate([
            'nama_dokumen' => 'required',
            'kategori' => 'required',
            'tgl_file' => 'required',
            'tgl_dicatat' => 'required',
            'keterangan' => 'nullable',
            'upload_file' => 'required',
            'upload_file.*' => 'mimes:jpg,jpeg,gif,png,pdf,doc,docx,txt,zip,rar,xls,xlsx,odt,ppt,pptx,video/avi,video/mpeg,video/quicktime|max:10000',
        ],[
            'nama_dokumen.required' => 'Nama ' . "<b>" . 'dokumen' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'kategori.required' => "<b>" . 'Kategori' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_file.required' => "<b>" . 'Tanggal file' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_dicatat.required' => "<b>" . 'Tanggal dicatat' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'upload_file.required' => "<b>" . 'File dokumen' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $nama = $request->nama_dokumen;

        $dokumen = Dokumen::create([
            'user_id' => Auth::user()->id,
            'kategori_id' => $request->kategori,
            'nama_dokumen' => $request->nama_dokumen,
            'tgl_file' => $request->tgl_file,
            'tgl_dicatat' => $request->tgl_dicatat,
            'keterangan' => $request->keterangan,
            'created_by' => Auth::user()->pegawai->nama,

        ]);

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


        return redirect()->route('d-home')->with('sukses','File '. "<b>" . $nama . "</b>" . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $dokumen = Dokumen::find($request->id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get()->toArray();
        //dd($fileDok);

        return view('pegawai.dokumen.d-edit', compact('dokumen', 'fileDok'));
    }


    public function update(Request $request, $id){
        $request->validate([
            'nama_dokumen' => 'required',
            'kategori' => 'required',
            'tgl_file' => 'required',
            'tgl_dicatat' => 'required',
            'keterangan' => 'nullable',
            'upload_file.*' => 'mimes:jpg,jpeg,gif,png,pdf,doc,docx,txt,zip,rar,xls,xlsx,odt,ppt,pptx,video/avi,video/mpeg,video/quicktime|max:10000',
        ],[
            'nama_dokumen.required' => 'Nama ' . "<b>" . 'dokumen' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'kategori.required' => "<b>" . 'Kategori' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_file.required' => "<b>" . 'Tanggal file' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_dicatat.required' => "<b>" . 'Tanggal dicatat' . "</b>" . ' belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $dokumen = Dokumen::find($id);
        $fileDok = FileDokumen::where('dokumen_id', $dokumen->id)->get();

        //dd($pegawai);
        $dokumen->update([
            'user_id' => Auth::user()->id,
            'kategori_id' => $request->kategori,
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

        return redirect()->route('d-home')->with('edit', 'Dokumen ' . "<b>" . $dokumen->nama_dokumen . "</b>" . ' berhasil diubah.');
//        return back()->with('edit', 'Dokumen berhasil diubah.');
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

    public function attach(Request $request){
        $d = Dokumen::find($request->id);
        $fd = FileDokumen::where('dokumen_id', $d->id)->get()->toArray();
//        dd($fd['upload_file']);

        Mail::send(new DokumenEmail($request, $fd));

        return back()->with('send', 'Dokumen ' . "<b>" . $d->nama_dokumen . "</b>" . ' berhasil terkirim');
    }

    public  function send(Request $request){
        $files = [];
        foreach ($request->file('file_pdf') as $i=>$file){
            $name = $file->getClientOriginalName();
            $file->move('file-dokumen/', $name);

            $files[$i] = $name;
        }

        Mail::send(new DokumenEmailRaw($request, $files));

        foreach ($files as $file){
            File::delete('file-dokumen/' . $file);
        }

        return back()->with('send', 'File Berhasil Terkirim');
    }

    public function print_all(){
        $data = Dokumen::all();
        //dd($data);
        $pdf = PDF::loadView("pegawai.dokumen.d-print-all", compact('data'));
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('daftar_dokumen.pdf');
    }
}
