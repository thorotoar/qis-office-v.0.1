<?php

namespace App\Http\Controllers\Pegawai;

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
use DB;

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

        $no_urut = str_pad(SuratKeluar::count() + 1, 3, 0, STR_PAD_LEFT); //latest()->first()->id

        return view('pegawai.surat-keluar.k-tambah', compact('jenis', 'no_urut'));
    }

    public function store(Request $request){
        $jenisur = JenisSurat::find($request->id);
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");

        if ( $request->kode_surat == '' && $request->kode_jabatan == ''){
            $nomorSurat = $request->no_surat .'/'. $request->kode_lembaga . '/' . $bulanRomawi[str_replace('0', '', substr($request->tgl_keluar, 0, 2))] . '/' . substr($request->tgl_keluar,-4);
        }elseif ( $request->kode_surat == '' && $request->kode_jabatan != ''){
            $nomorSurat = $request->no_surat .'/'. $request->kode_lembaga . '/' . $request->kode_jabatan . '/' . $bulanRomawi[str_replace('0', '', substr($request->tgl_keluar, 0, 2))] . '/' . substr($request->tgl_keluar, -4);
        }elseif ($request->kode_surat != '' && $request->kode_jabatan == '' ){
            $nomorSurat = $request->no_surat .'/'. $request->kode_surat .'/'. $request->kode_lembaga .  '/' . $bulanRomawi[str_replace('0', '', substr($request->tgl_keluar, 0, 2))] . '/' . substr($request->tgl_keluar, -4);
        }elseif($request->kode_surat != '' && $request->kode_jabatan != ''){
            $nomorSurat = $request->no_surat .'/'. $request->kode_surat .'/'. $request->kode_lembaga . '/' . $request->kode_jabatan . '/' . $bulanRomawi[str_replace('0', '', substr($request->tgl_keluar, 0, 2))] . '/' . substr($request->tgl_keluar, -4);
        }else{
            $nomorSurat = '';
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
            'created_by' => Auth::user()->pegawai->nama,
        ]);

        if (input::has('isi')){
            $filename = $jenisur->nama_jenis_surat.substr($sk->no_surat, 0, 3);
            $name = str_replace(' ', '_', str_random(2) . '' . $filename);

//            if ($jenisur->template_surat == 'Template 1'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-1", compact('sk'));
//            }elseif($jenisur->template_surat == 'Template 2'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-2", compact('sk'));
//            }

            $pdf = PDF::loadView("pegawai.surat-keluar.k-print", compact('sk'));
            $pdf->setPaper('Legal', 'portrait');
            $pdf->save('file-surat/'. $name .'.pdf');

            $sk->update([
                'attach' => $name.'.pdf',
            ]);
        }

        return redirect()->route('surk-home')->with('sukses', "<b>" . $jenisur->nama_jenis_surat.'_'.substr($sk->no_surat, 0, 3) . "</b>" . ' berhasil ditambahkan.');
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
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        if (input::has('isi')){
            File::delete('file-surat/'.$sk->attach);
            $filename = $jenisur->nama_jenis_surat.substr($sk->no_surat, 0, 3);
            $name = str_replace(' ', '_', str_random(2) . '' . $filename);

//            if ($jenisur->template_surat == 'Template 1'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-1", compact('sk'));
//            }elseif($jenisur->template_surat == 'Template 2'){
//                $pdf = PDF::loadView("pegawai.surat-keluar.k-print-2", compact('sk'));
//            }

            $pdf = PDF::loadView("pegawai.surat-keluar.k-print", compact('sk'));
            $pdf->setPaper('Legal', 'portrait');
            $pdf->save('file-surat/'. $name .'.pdf');

            $sk->update([
                'attach' => $name.'.pdf',
            ]);
        }

        return redirect()->route('surk-home')->with('sukses', "<b>" . $jenisur->nama_jenis_surat.'_'.substr($sk->no_surat, 0, 3). "</b>" . ' berhasil ditambahkan.');
    }

    public function attach(Request $request){
        $sk = SuratKeluar::find($request->id);

        if (Input::has('file_pdf')){
            File::delete('file-surat/'.$sk->attach);

            $file = $request->file('file_pdf')->getClientOriginalName();
            Input::file('file_pdf')->move('file-surat/', $file);

            $sk->update([
                'attach' => $file,
            ]);

            Mail::send(new SuratKeluarEmail($request, $sk->attach));
        }else{
            Mail::send(new SuratKeluarEmail($request, $sk->attach));
        }


        return back()->with('send', 'Surat Keluar Berhasil Terkirim');
    }
    
    public  function print(Request $request){
        $sk = SuratKeluar::find($request->id);
        $jenis = JenisSurat::where('id', $sk->jenis_id)->firstOrFail();

        $no = substr($sk->no_surat, 0, 3);
        //pdf
        $pdf = PDF::setOptions(['font' => 'calibri', 'images' => true]);
        $pdf->setPaper('Legal', 'portrait');

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
        $files = [];
        foreach ($request->file('file_pdf') as $i=>$file){
            $name = $file->getClientOriginalName();
            $file->move('file-surat/', $name);

            $files[$i] = $name;
        }

        Mail::send(new SuratKeluarEmailRaw($request, $files));

        foreach ($files as $file){
            File::delete('file-surat/' . $file);
        }

        return back()->with('send', 'File berhasil dikirim.');
    }

    public function destroy($id){
        $surK = SuratKeluar::find($id);
        File::delete('file-surat/'.$surK->attach);
        $surK->delete();

        $jenis = JenisSurat::where('id', $surK->jenis_id)->firstOrFail();

        return redirect()->route('surk-home')->with('hapus', 'Data ' . "<b>" . $jenis['nama_jenis_surat'] . '_' . substr($surK->no_surat, 0, 3) . "</b>" . ' terpilih berhasil dihapus.');
    }

//    public function searchJabatan($Q){
//        $perihals = Jabatan::where('kode_jabatan', 'LIKE', '%' . $Q . '%')->get();
//        foreach ($perihals as $perihal) {
//            $perihal->label = $perihal->kode_jabatan . ' - ' . $perihal->nama_jabatan;
//        }
//        return $perihals;
//    }

    public function printAll(){
        $datas = SuratKeluar::all();
        //dd($data);
        $pdf = PDF::loadView("pegawai.surat-keluar.k-print-all", compact('datas'));
        $pdf->setPaper('A4');
        return $pdf->stream('daftar_surat_keluar.pdf');
    }
}
