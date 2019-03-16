<?php

namespace App\Http\Controllers\Pegawai;


use App\Jabatan;
Use App\JenisSurat;
use App\Mail\SuratKeluarEmail;
use App\Mail\SuratKeluarEmailRaw;
use App\SuratKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Events\SuratKeluar as EventSK;
use PDF;
use Mail;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $keluarView = SuratKeluar::orderBy('created_at', 'ASC')->get();
        $jenisSurat = JenisSurat::all();
        return view('pegawai.surat-keluar.k-home', compact('keluarView', 'jenisSurat'));
    }

    public function create(Request $request){
//        setlocale(LC_TIME, "id");
//        return strftime("%A %B %Y", strtotime(now()->format('Y-F-j')));
        $jenis = JenisSurat::find($request->id);

        $no_urut = str_pad(SuratKeluar::count() + 1, 3, 0, STR_PAD_LEFT);

        return view('pegawai.surat-keluar.k-tambah', compact('jenis', 'no_urut'));

//        if($jenis->template_surat == 'Template 1'){
//            return view('pegawai.surat-keluar.k-tambah-1', compact('jenis', 'no_urut'));
//        }
//        elseif ($jenis->template_surat == 'Template 2'){
//
//            return view('pegawai.surat-keluar.k-tambah-2', compact('jenis', 'no_urut'));
//        }
//        else{
//            return back()->with('not_found', 'Jenis Surat Tidak Ditemukan');
//        }
    }

    public function store(Request $request){
//        dd($request->all());

        $jenisur = JenisSurat::find($request->id);
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");

        if ( $request->kode_instansi == null){
            $nomorSurat = $request->no_surat .'/'. $request->kode_surat . '/' . $bulanRomawi[str_replace('0', '', substr($request->tgl_keluar, 0, 2))] . '/' . substr($request->tgl_keluar,-4);
        }else{
            $nomorSurat = _surat .'/'. $request->kode_surat . '/' . $request->kode_instansi . '/' . $bulanRomawi[str_replace('0', '', substr($request->tgl_keluar, 0, 2))] . '/' . substr($request->tgl_keluar, -4);
        }

        $sk = SuratKeluar::create([
            'user_id' => Auth::user()->id,
            'jenis_id' => $jenisur->id,
            'no_surat' => $nomorSurat,
            'lampiran' => $request->lampiran,
            'perihal' => $request->perihal,
            'tempat' => $request->tempat,
            'tgl_keluar' => $request->tgl_keluar,
            'tgl_dicatat' => $request->tgl_dicatat,
            'isi_surat' => $request->isi,
            'created_by' => Auth::user()->nama_user,
        ]);

        if (input::has('tujuan') || input::has('alamat_tujuan')){
            $sk->update([
                'tujuan' => $request->tujuan,
                'tempat_tujuan' => $request->tempat_tujuan,
                'alamat_tujuan' => $request->alamat_tujuan,
                'kota_tujuan' => $request->kota_tujuan,
            ]);
        }

        if (input::has('isi')){
            $filename = $jenisur->nama_jenis_surat.substr($sk->no_surat, 0, 3);
            $name = str_replace(' ', '_', str_random(2) . '' . $filename);

//            if ($jenisur->template_surat == 'Template 1'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-1", compact('sk'));
//            }elseif($jenisur->template_surat == 'Template 2'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-2", compact('sk'));
//            }

            $pdf = PDF::loadView("pegawai.surat-keluar.k-print", compact('sk'));
            $pdf->setPaper('A4', 'portrait');
            $pdf->save('images/file-surat/'. $name .'.pdf');

            $sk->update([
                'attach' => $name.'.pdf',
            ]);
        }

        return redirect()->route('surk-home')->with('sukses', $jenisur->nama_jenis_surat.'_'.substr($sk->no_surat, 0, 3). ' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $sk = SuratKeluar::find($request->id);
        $jenis = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $no_urut = str_pad(SuratKeluar::count() + 1, 3, 0, STR_PAD_LEFT);

//        if($jenis->template_surat == 'Template 1'){
//            return view('pegawai.surat-keluar.k-edit-1', compact('sk', 'jenis', 'no_urut'));
//        }
//        elseif ($jenis->template_surat == 'Template 2'){
//
//            return view('pegawai.surat-keluar.k-edit-2', compact('sk','jenis', 'no_urut'));
//        }
//        else{
//            return back()->with('not_found', 'Jenis Surat Tidak Ditemukan');
//        }

        return view('pegawai.surat-keluar.k-edit', compact('sk','jenis', 'no_urut'));

    }

    public function update(Request $request){
//        dd($request->all());

        $sk = SuratKeluar::find($request->id);
        $jenisur = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $sk->update([
            'user_id' => Auth::user()->id,
            'no_surat' => $request->no_surat,
            'lampiran' => $request->lampiran,
            'perihal' => $request->perihal,
            'tempat' => $request->tempat,
            'tgl_keluar' => $request->tgl_keluar,
            'tgl_dicatat' => $request->tgl_dicatat,
            'isi_surat' => $request->isi,
            'updated_by' => Auth::user()->nama_user,
        ]);

        if (input::has('tujuan') || input::has('alamat_tujuan')){
            $sk->update([
                'tujuan' => $request->tujuan,
                'tempat_tujuan' => $request->tempat_tujuan,
                'alamat_tujuan' => $request->alamat_tujuan,
                'kota_tujuan' => $request->kota_tujuan,
            ]);
        }

        if (input::has('isi')){
            File::delete('images/file-surat/'.$sk->attach);
            $filename = $jenisur->nama_jenis_surat.substr($sk->no_surat, 0, 3);
            $name = str_replace(' ', '_', str_random(2) . '' . $filename);

//            if ($jenisur->template_surat == 'Template 1'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-1", compact('sk'));
//            }elseif($jenisur->template_surat == 'Template 2'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-2", compact('sk'));
//            }

            $pdf = PDF::loadView("pegawai.surat-keluar.k-print", compact('sk'));
            $pdf->setPaper('A4', 'portrait');
            $pdf->save('images/file-surat/'. $name .'.pdf');

            $sk->update([
                'attach' => $name.'.pdf',
            ]);
        }

        return redirect()->route('surk-home')->with('sukses', $jenisur->nama_jenis_surat.'_'.substr($sk->no_surat, 0, 3). ' berhasil ditambahkan.');
    }

    public function attach(Request $request){
        $sk = SuratKeluar::find($request->id);

        if (Input::has('file_pdf')){
            File::delete('images/file-surat/'.$sk->attach);

            $file = $request->file('file_pdf')->getClientOriginalName();
            Input::file('file_pdf')->move('images/file-surat/', $file);

            $sk->update([
                'attach' => $file,
            ]);

            Mail::send(new SuratKeluarEmail($request, $sk->attach));
        }else{
            Mail::send(new SuratKeluarEmail($request, $sk->attach));
        }


        return back()->with('send', 'Surat Berhasil Terkirim');
    }
    
    public  function print(Request $request){
        $sk = SuratKeluar::find($request->id);
        $jenis = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $no = substr($sk->no_surat, 0, 3);
        //pdf
        $pdf = PDF::setOptions(['font' => 'calibri', 'images' => true]);
        $pdf->setPaper('A4', 'portrait');

//        if($jenis->template_surat == 'Template 1'){
//            $pdf->loadView("pegawai.surat-keluar.k-print-1", compact('sk', 'jenis'));
//            return $pdf->stream($jenis->nama_jenis_surat.$no.'.pdf');
//        }
//        elseif ($jenis->template_surat == 'Template 2'){
//            $pdf->loadView("pegawai.surat-keluar.k-print-2", compact('sk', 'jenis'));
//            return $pdf->stream($jenis->nama_jenis_surat.$no.'.pdf');
//        }
//        else{
//            return back()->with('not_found', 'Jenis Surat Tidak Ditemukan');
//        }

        $pdf->loadView("pegawai.surat-keluar.k-print", compact('sk', 'jenis'));
        return $pdf->stream(str_replace(' ', '_', str_random(2) . '' . $jenis->nama_jenis_surat.$no).'.pdf');

//        return view('pegawai.surat-keluar.k-print', compact('sk', 'jenis'));
    }

    public  function send(Request $request){
        Mail::send(new SuratKeluarEmailRaw($request));

        return back()->with('send', 'File Berhasil Terkirim');
    }

    public function destroy($id){

        $surK = SuratKeluar::find($id);
        File::delete('images/file-surat/'.$surK->attach);
        $surK->delete();

        $jenis = JenisSurat::where('id', $surK->jenis_id)->firstOrFail();

        return redirect()->route('surk-home')->with('hapus', 'Data ' . $jenis['nama_jenis_surat'] . '_' . substr($surK->no_surat, 0, 3) . ' terpilih berhasil dihapus.');
    }

    public function test(){
        return view('mail.m-personal');
    }
}
