<?php

namespace App\Http\Controllers\Pegawai;

use App\Mail\SuratMasukEmail;
use App\SuratMasuk;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Mail;
use PDF;

class SuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $smasukView = SuratMasuk::orderBy('created_at', 'ASC')->get();
        return view('pegawai.surat-masuk.m-home', compact('smasukView'));
    }

    public function create()
    {
        return view('pegawai.surat-masuk.m-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|unique:surat_masuks,no_surat',
            'tgl_diterima' => 'required|unique:surat_masuks,tgl_diterima',
            'tgl_dicatat' => 'required|unique:surat_masuks,tgl_dicatat',
            'pengirim' => 'required|unique:surat_masuks,pengirim',
            'penerima' => 'required|unique:surat_masuks,penerima',
            'prihal' => 'nullable|unique:surat_masuks,prihal',
        ],[
            'no_surat.required' => 'Nomor surat belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_diterima.required' => 'Tanggal diterima belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_dicatat.required' => 'Tanggal dicatat belum anda isi, silahkan isi terlebih dahulu!.',
            'pengirim.required' => 'Pengirim belum anda isi, silahkan isi terlebih dahulu!.',
            'penerima.required' => 'Penerima belum anda isi, silahkan isi terlebih dahulu!.',
            'no_surat.unique' => 'Nomor surat yang anda tambahkan sudah tersedia, masukan nomor surat lain!.',
            'tgl_diterima.unique' => 'Tanggal diterima yang anda tambahkan sudah tersedia, masukan tanggal diterima lain!.',
            'tgl_dicatat.unique' => 'Tanggal dicatat yang anda tambahkan sudah tersedia, masukan tanggal dicatat lain!.',
            'pengirim.unique' => 'Pengirim yang anda tambahkan sudah tersedia, masukan pengirim lain!.',
            'penerima.unique' => 'Penerima yang anda tambahkan sudah tersedia, masukan penerima lain!.',
            'prihal.unique' => 'Prihal yang anda tambahkan sudah tersedia, masukan prihal lain!.',
        ]);

        $suratM = SuratMasuk::create([
            'user_id' => Auth::user()->id,
            'no_surat' => $request->no_surat,
            'tgl_diterima' => $request->tgl_diterima,
            'tgl_dicatat' => $request->tgl_dicatat,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'prihal' => $request->prihal,
            'created_by' => Auth::user()->nama_user,

        ]);

        if (Input::has('upload_file')) {
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('upload_file')->getClientOriginalName());
            Input::file('upload_file')->move('file-surat-masuk/', $file);
            $suratM->update([
                'upload_file' => 'file-surat-masuk/' . $file,
            ]);
        }


        return redirect()->route('surm-home')->with('sukses','Surat masuk ' .  $suratM->no_surat . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){

        $suratM = SuratMasuk::find($request->id);

        return view('pegawai.surat-masuk.m-edit', compact('suratM'));
    }


    public function update(Request $request, $id){

        $suratM = SuratMasuk::find($id);
        //dd($pegawai);
        $suratM->update([
            'user_id' => Auth::user()->id,
            'no_surat' => $request->no_surat,
            'tgl_diterima' => $request->tgl_diterima,
            'tgl_dicatat' => $request->tgl_dicatat,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'prihal' => $request->prihal,
            'updated_by' => Auth::user()->nama_user,
        ]);

        if (Input::has('upload_file_new')) {

            File::delete($suratM->upload_file);
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('upload_file_new')->getClientOriginalName());
            Input::file('upload_file_new')->move('file-surat-masuk/', $file);

            $suratM->update([
                'upload_file' => 'file-surat-masuk/' . $file,
            ]);
        }

        return redirect()->route('surm-home')->with('edit', 'Surat masuk ' . $suratM->no_surat . ' berhasil diubah.'); //Lanjutkan dengan mengisi riwayat pendidikan.
    }

    public function attach(Request $request){
        $sk = SuratMasuk::find($request->id);

        if (Input::has('file_pdf')){
            File::delete('file-surat-masuk/'.$sk->attach);

            $file = $request->file('file_pdf')->getClientOriginalName();
            Input::file('file_pdf')->move('file-surat-masuk/', $file);

            $sk->update([
                'attach' => $file,
            ]);

            Mail::send(new SuratMasukEmail($request, $sk->upload_file));
        }else{
            Mail::send(new SuratMasukEmail($request, $sk->upload_file));
        }


        return back()->with('send', 'Surat Masuk Berhasil Terkirim');
    }

    public function destroy($id){

        $surM = SuratMasuk::find($id);
        $file = $surM->upload_file;
        File::delete($file);
        $surM->delete();

        return redirect()->route('surm-home')->with('hapus', 'Surat masuk ' . $surM->no_surat . ' berhasil dihapus.');
    }

    public function print(Request $request){
        $data = SuratMasuk::find($request->id);
        $file = File::get('file-surat-masuk/'. substr($data->upload_file, '17'));

        return Response::make($file);
    }

    public function printAll(){
        $datas = SuratMasuk::all();
        //dd($data);
        $pdf = PDF::loadView("pegawai.surat-masuk.m-print-all", compact('datas'));
        $pdf->setPaper('A4');
        return $pdf->stream('daftar_surat_masuk.pdf');
    }
}
