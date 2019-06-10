<?php

namespace App\Http\Controllers\Pegawai;

use App\Agama;
use App\Jabatan;
use App\Jenjang;
use App\Kabupaten;
use App\KebutuhanKhusus;
use App\Kecamatan;
use App\Kewarganegaraan;
use App\Lembaga;
use App\Mail\SertifikatEmail;
use App\NilaiABK;
use App\NilaiDC;
use App\NilaiQIS;
use App\Pegawai;
use App\Penghasilan;
use App\PesertaDidik;
use App\Provinsi;
use App\Transportasi;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use PDF;
use Mail;

class PesertaController extends Controller
{

    protected $clientSIMDEPAD, $clientSIMPADI, $uriSIMDEPAD, $uriSIMPADI;

    public function __construct(){
        $this->middleware('auth');

        $this->uriQIS = env('QIS_URI');
        $this->uriSIMPADI = env('SIMPADI_URI');
        $this->uriSIMDEPAD = env('SIMDEPAD_URI');

        $this->clientQIS = new Client([
            'base_uri' => $this->uriQIS,
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $this->clientSIMPADI = new Client([
            'base_uri' => $this->uriSIMPADI,
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        $this->clientSIMDEPAD = new Client([
            'base_uri' => $this->uriSIMDEPAD,
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function index(){
        $pesertaDidik = PesertaDidik::orderBy('created_at')->get();

        return view('pegawai.peserta.p-home', compact('pesertaDidik'));
    }

    public function create(){
        $penghasilan = Penghasilan::all();
        $jenjang = Jenjang::all();
        $kebutuhan = KebutuhanKhusus::all();
        $provinsi = Provinsi::all();
        $negara = Kewarganegaraan::all();
        $agama = Agama::all();
        $transportasi = Transportasi::all();
        $lembaga = Lembaga::where('id', '!=', [1])->get();
        return view('pegawai.peserta.p-tambah', compact('penghasilan', 'jenjang', 'kebutuhan', 'provinsi', 'negara', 'agama', 'transportasi', 'lembaga'));
    }

    public function kabupaten(){
        $provinsi_id = Input::get('provinsi_id');
        $provinsi = Kabupaten::where('provinsi_id', '=', $provinsi_id)->get();
        return response()->json($provinsi);
    }

    public function kecamatan(){
        $kabupaten_id = Input::get('kabupaten_id');
        $kabupaten = Kecamatan::where('kabupaten_id', '=', $kabupaten_id)->get();
        return response()->json($kabupaten);
    }

    public function store(Request $request){
        $request->validate([
            'nik' => 'nullable|numeric',
            'nik_ayah' => 'nullable|numeric',
            'nik_ibu' => 'nullable|numeric',
            'nik_wali' => 'nullable|numeric',
            'nisn' => 'nullable|numeric',
            'nama' => 'required',
            'kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'transportasi' => 'required',
            'kps' => 'required',
            'pip' => 'required',
            'kip' => 'required',
            'lembaga' => 'required',
            'nama_ibu' => 'required',
        ], [
            'nik.numeric' => 'Kolom NIK hanya bisa diisi dengan format angka!.',
            'nik_ayah.numeric' => 'Kolom NIK Ayah hanya bisa diisi dengan format angka!.',
            'nik_ibu.numeric' => 'Kolom NIK Ibu hanya bisa diisi dengan format angka!.',
            'nik_wali.numeric' => 'Kolom NIK Wali hanya bisa diisi dengan format angka!.',
            'nisn.numeric' => 'Kolom NISN hanya bisa diisi dengan format angka!.',
            'nama.required' => 'Nama peserta didik belum anda isi, silahkan isi terlebih dahulu!.',
            'kelamin.required' => 'Jenis kelamin belum anda isi, silahkan isi terlebih dahulu!.',
            'tempat_lahir.required' => 'Tempat lahir belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_lahir.required' => 'Tanggal lahir belum anda isi, silahkan isi terlebih dahulu!.',
            'agama.required' => 'Agama belum anda isi, silahkan isi terlebih dahulu!.',
            'kewarganegaraan.required' => 'Kewarganegaraaan belum anda isi, silahkan isi terlebih dahulu!.',
            'alamat.required' => 'Alamat belum anda isi, silahkan isi terlebih dahulu!.',
            'desa.required' => 'Desa/kelurahan belum anda isi, silahkan isi terlebih dahulu!.',
            'provinsi.required' => 'Provinsi belum anda isi, silahkan isi terlebih dahulu!.',
            'kabupaten.required' => 'Kabupaten belum anda isi, silahkan isi terlebih dahulu!.',
            'kecamatan.required' => 'Kecamatan belum anda isi, silahkan isi terlebih dahulu!.',
            'transportasi.required' => 'Alat transportasi belum anda isi, silahkan isi terlebih dahulu!.',
            'kps.required' => 'Penerima KPS belum anda isi, silahkan isi terlebih dahulu!.',
            'pip.required' => 'Layak PIP belum anda isi, silahkan isi terlebih dahulu!.',
            'kip.required' => 'Penerima KIP belum anda isi, silahkan isi terlebih dahulu!.',
            'lembaga.required' => 'Lembaga belum anda isi, silahkan isi terlebih dahulu!.',
            'nama_ibu.required' => 'Nama ibu belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $peserta = PesertaDidik::create([
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'kelamin' => $request->kelamin,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama_id' => $request->agama,
            'kewarganegaraan_id' => $request->kewarganegaraan,
            'kebutuhan_id' => $request->kebutuhan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'nama_dusun' => $request->nama_dusun,
            'desa' => $request->desa,
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'jenis_tinggal' => $request->jenis_tinggal,
            'transportasi_id' => $request->transportasi,
            'anak_ke' => $request->anak_ke,
            'telpon_rumah' => $request->telpon_rumah,
            'telpon_selular' => $request->telpon_selular,
            'email' => $request->email,
            'kps' => $request->kps,
            'no_kps' => $request->no_kps,
            'pip' => $request->pip,
            'kip' => $request->kip,
            'no_kks' => $request->no_kks,
            'reg_akta' => $request->reg_akta,
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
            'jenjang_ayah_id' => $request->jenjang_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah_id' => $request->penghasilan_ayah,
            'kebutuhan_ayah_id' => $request->kebutuhan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
            'jenjang_ibu_id' => $request->jenjang_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu_id' => $request->penghasilan_ibu,
            'kebutuhan_ibu_id' => $request->kebutuhan_ibu,
            'nama_wali' => $request->nama_wali,
            'nik_wali' => $request->nik_wali,
            'tahun_lahir_wali' => $request->tahun_lahir_wali,
            'jenjang_wali_id' => $request->jenjang_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'penghasilan_wali_id' => $request->penghasilan_wali,
            'tgl_masuk' => $request->tgl_masuk,
            'status' => $request->status,
            'lembaga_id' => $request->lembaga,
            'created_by' => Auth::user()->nama_user,

        ]);

        if (Input::has('foto')) {
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('foto')->getClientOriginalName());
            Input::file('foto')->move('images/foto-peserta/', $file);
            $peserta->update([
                'foto' => 'images/foto-peserta/' . $file,
            ]);
        }

        $nama = $request->nama;

        return redirect()->route('p-home')->with('sukses', 'Peserta Didik ' . "<b>" . $nama . "</b>" . ' berhasil ditambahkan.');
    }

    public function edit(Request $request){
        $peserta = PesertaDidik::find($request->id);

        $penghasilan = Penghasilan::all();
        $jenjang = Jenjang::all();
        $kebutuhan = KebutuhanKhusus::all();
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::all();
        $kecamatan = Kecamatan::all();
        $negara = Kewarganegaraan::all();
        $agama = Agama::all();
        $transportasi = Transportasi::all();
        $lembaga = Lembaga::all();
        return view('pegawai.peserta.p-edit', compact('penghasilan', 'jenjang', 'kebutuhan', 'provinsi', 'negara', 'agama', 'transportasi', 'lembaga', 'peserta', 'kabupaten', 'kecamatan'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
//            'nik' => 'nullable|numeric',
//            'nik_ayah' => 'nullable|numeric',
//            'nik_ibu' => 'nullable|numeric',
//            'nik_wali' => 'nullable|numeric',
//            'nisn' => 'nullable|numeric',
            'nama' => 'required',
            'kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'transportasi' => 'required',
            'kps' => 'required',
            'pip' => 'required',
            'kip' => 'required',
            'lembaga' => 'required',
            'nama_ibu' => 'required',
        ], [
//            'nik.numeric' => 'Kolom NIK hanya bisa diisi dengan format angka!.',
//            'nik_ayah.numeric' => 'Kolom NIK Ayah hanya bisa diisi dengan format angka!.',
//            'nik_ibu.numeric' => 'Kolom NIK Ibu hanya bisa diisi dengan format angka!.',
//            'nik_wali.numeric' => 'Kolom NIK Wali hanya bisa diisi dengan format angka!.',
//            'nisn.numeric' => 'Kolom NISN hanya bisa diisi dengan format angka!.',
            'nama.required' => 'Nama peserta didik belum anda isi, silahkan isi terlebih dahulu!.',
            'kelamin.required' => 'Jenis kelamin belum anda isi, silahkan isi terlebih dahulu!.',
            'tempat_lahir.required' => 'Tempat lahir belum anda isi, silahkan isi terlebih dahulu!.',
            'tgl_lahir.required' => 'Tanggal lahir belum anda isi, silahkan isi terlebih dahulu!.',
            'agama.required' => 'Agama belum anda isi, silahkan isi terlebih dahulu!.',
            'kewarganegaraan.required' => 'Kewarganegaraaan belum anda isi, silahkan isi terlebih dahulu!.',
            'alamat.required' => 'Alamat belum anda isi, silahkan isi terlebih dahulu!.',
            'desa.required' => 'Desa/kelurahan belum anda isi, silahkan isi terlebih dahulu!.',
            'provinsi.required' => 'Provinsi belum anda isi, silahkan isi terlebih dahulu!.',
            'kabupaten.required' => 'Kabupaten belum anda isi, silahkan isi terlebih dahulu!.',
            'kecamatan.required' => 'Kecamatan belum anda isi, silahkan isi terlebih dahulu!.',
            'transportasi.required' => 'Alat transportasi belum anda isi, silahkan isi terlebih dahulu!.',
            'kps.required' => 'Penerima KPS belum anda isi, silahkan isi terlebih dahulu!.',
            'pip.required' => 'Layak PIP belum anda isi, silahkan isi terlebih dahulu!.',
            'kip.required' => 'Penerima KIP belum anda isi, silahkan isi terlebih dahulu!.',
            'lembaga.required' => 'Lembaga belum anda isi, silahkan isi terlebih dahulu!.',
            'nama_ibu.required' => 'Nama ibu belum anda isi, silahkan isi terlebih dahulu!.',
        ]);

        $peserta = PesertaDidik::find($id);

        $peserta->update([
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'kelamin' => $request->kelamin,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama_id' => $request->agama,
            'kewarganegaraan_id' => $request->kewarganegaraan,
            'kebutuhan_id' => $request->kebutuhan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'nama_dusun' => $request->nama_dusun,
            'desa' => $request->desa,
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'kecamatan_id' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'jenis_tinggal' => $request->jenis_tinggal,
            'transportasi_id' => $request->transportasi,
            'anak_ke' => $request->anak_ke,
            'telpon_rumah' => $request->telpon_rumah,
            'telpon_selular' => $request->telpon_selular,
            'email' => $request->email,
            'kps' => $request->kps,
            'no_kps' => $request->no_kps,
            'pip' => $request->pip,
            'kip' => $request->kip,
            'no_kks' => $request->no_kks,
            'reg_akta' => $request->reg_akta,
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'tahun_lahir_ayah' => $request->tahun_lahir_ayah,
            'jenjang_ayah_id' => $request->jenjang_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah_id' => $request->penghasilan_ayah,
            'kebutuhan_ayah_id' => $request->kebutuhan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
            'jenjang_ibu_id' => $request->jenjang_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu_id' => $request->penghasilan_ibu,
            'kebutuhan_ibu_id' => $request->kebutuhan_ibu,
            'nama_wali' => $request->nama_wali,
            'nik_wali' => $request->nik_wali,
            'tahun_lahir_wali' => $request->tahun_lahir_wali,
            'jenjang_wali_id' => $request->jenjang_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'penghasilan_wali_id' => $request->penghasilan_wali,
            'tgl_masuk' => $request->tgl_masuk,
            'status' => $request->status,
            'lembaga_id' => $request->lembaga,
            'created_by' => Auth::user()->nama_user,

        ]);

        if (Input::has('foto_new')) {

            File::delete($peserta->foto);
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('foto_new')->getClientOriginalName());
            Input::file('foto_new')->move('images/foto-peserta/', $file);

            $peserta->update([
                'foto' => 'images/foto-peserta/' . $file,
            ]);
        }
        $nama = $request->nama;

        return redirect()->route('p-home')->with('edit', 'Data Peserta Didik ' . "<b> ". $nama . "</b>" . ' berhasil diubah.');
//        return redirect()->route('p-home')->with('edit', 'Data Peserta Didik ' . $nama . ' berhasil diubah.');
    }

    public function destroy($id){
        $ser = PesertaDidik::find($id);
        $nilai = NilaiQIS::where('peserta_id', $ser->id)->first();
//        dd($nilai->attach);

        $file = $ser->foto;

        if (!$nilai){
            File::delete($file);
        }else{
            File::delete($file);
            File::delete('file-sertifikat/'.$nilai->attach);
        }

        $ser->delete();

        return back()->with('destroy', 'Data ' . "<b>" . $ser->nama . "</b>" . ' berhasil dihapus.');
    }

    public function print(Request $request){
        $data = PesertaDidik::find($request->id);
        //dd($data);
        //$pdf = PDF::loadView("pegawai.data-pegawai.d-p-print", compact('data'));
        return view('pegawai.peserta.p-print', compact('data'));
    }

    public function print_all(){
        $data = PesertaDidik::all();
        //dd($data);
        $pdf = PDF::loadView("pegawai.peserta.p-print-all", compact('data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('daftar_peserta.pdf');
    }

    public function attach(Request $request){
        $nilai = NilaiQIS::find($request->id);
//        dd($nilai);

        Mail::send(new SertifikatEmail($request, $nilai->attach));

        return back()->with('send', 'Sertifikat Berhasil Terkirim');
    }

    public  function printNilai(Request $request){
        $sis = PesertaDidik::find($request->id);

        if ($sis->lembaga_id == 2){
            $nilai = NilaiQIS::where('peserta_id', $sis->id)->first();

            $pdf = PDF::setPaper('Legal', 'landscape');
            $pdf->loadView("pegawai.peserta.nilai.p-sertif", compact('nilai'));
            return $pdf->stream(str_replace(' ', '_', str_random(2) . '' . 'sertif_' . $sis->nama . '.pdf'));

        } elseif ($sis->lembaga_id == 3){
            $nilai = NilaiDC::where('peserta_id', $sis->id)->first();

            return view('pegawai.peserta.nilai.p-p-print', compact('sis', 'nilai'));

        } elseif ($sis->lembaga_id == 4){
            $nilai = NilaiABK::where('peserta_id', $sis->id)->first();

            return view('pegawai.peserta.nilai.p-p-print', compact('sis', 'nilai'));
        }
    }

    public function lihatNilai($id){
        $peserta = PesertaDidik::find($id);
//        dd($peserta);

        $lemb = Lembaga::where('id', $peserta->lembaga_id)->first();

        return view('pegawai.peserta.nilai.p-nilai', compact('peserta', 'lemb'));
    }


    public function getSiswa(){
        try {
            $response = $this->clientSIMPADI->get($this->uriSIMPADI . '/api/siswa')->getBody()->getContents();
            $response = json_decode($response, true);
            foreach ($response as $row) {
                $agama = Agama::where('nama_agama', $row['user_id']['agama'])->first();
                $jenjangA = Jenjang::where('nama_jenjang', $row['pendidikan_terakhir_ibu'])->first();
                $jenjangI = Jenjang::where('nama_jenjang', $row['pendidikan_terakhir_ayah'])->first();
                $pIbu = Penghasilan::where('jumlah_penghasilan', $row['penghasilan_ibu'])->first();
                $pAyah = Penghasilan::where('jumlah_penghasilan', $row['penghasilan_ayah'])->first();
                $kebutuhan = KebutuhanKhusus::where('nama_kebutuhan', $row['jenis_abk'])->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();

                $check = PesertaDidik::where('user_id', Auth::id())->where('nama', $row['user_id']['nama'])->where('kelamin', $row['user_id']['jenis_kelamin'])->where('nik', $row['nomer_nik'])
                    ->where('tempat_lahir', $row['user_id']['tempat_lahir'])->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])))
                    ->where('agama_id', $agama->id)->where('kebutuhan_id', $kebutuhan->id)->where('alamat', $row['user_id']['alamat'])->where('telpon_selular', $row['user_id']['no_telp'])
                    ->where('email', $row['user_id']['email'])->where('nama_ayah', $row['nama_ayah'])->where('tahun_lahir_ayah', $row['tahun_kelahiran_ayah'])->where('jenjang_ayah_id', $jenjangA->id)
                    ->where('pekerjaan_ayah', $row['pekerjaan_ayah'])->where('penghasilan_ayah_id', $pAyah->id)->where('nama_ibu', $row['nama_ibu'])->where('tahun_lahir_ibu', $row['tahun_kelahiran_ibu'])
                    ->where('jenjang_ibu_id', $jenjangI->id)->where('pekerjaan_ibu', $row['pekerjaan_ibu'])->where('penghasilan_ibu_id', $pIbu->id)->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])))
                    ->where('status', $row['status'])->where('lembaga_id', 3)->where('created_by', Auth::user()->nama_user);

                if (!$check->count()) {
                    $peserta = PesertaDidik::create([
                        'user_id' => Auth::user()->id,
                        'nama' => $row['user_id']['nama'],
                        'kelamin' => $row['user_id']['jenis_kelamin'],
                        'nik' => $row['nomer_nik'],
                        'tempat_lahir' => $row['user_id']['tempat_lahir'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])),
                        'agama_id' => $agama->id,
                        'kewarganegaraan_id' => $negara->id,
                        'kebutuhan_id' => $kebutuhan->id,
                        'alamat' => $row['user_id']['alamat'],
                        'telpon_selular' => $row['user_id']['no_telp'],
                        'email' => $row['user_id']['email'],
                        'nama_ayah' => $row['nama_ayah'],
                        'tahun_lahir_ayah' => $row['tahun_kelahiran_ayah'],
                        'jenjang_ayah_id' => $jenjangA->id,
                        'pekerjaan_ayah' => $row['pekerjaan_ayah'],
                        'penghasilan_ayah_id' => $pAyah->id,
                        'nama_ibu' => $row['nama_ibu'],
                        'tahun_lahir_ibu' => $row['tahun_kelahiran_ibu'],
                        'jenjang_ibu_id' => $jenjangI->id,
                        'pekerjaan_ibu' => $row['pekerjaan_ibu'],
                        'penghasilan_ibu_id' => $pIbu->id,
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])),
                        'status' => $row['status'],
                        'isFull' => false,
                        'lembaga_id' => 3,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                } else{
                    $peserta = $check->first();
                }

                if ($row['harian'] != null) {
                    $it = new \MultipleIterator();
                    $it->attachIterator(new \ArrayIterator($row['harian']));
                    $it->attachIterator(new \ArrayIterator($row['kode']));
                    $it->attachIterator(new \ArrayIterator($row['pegawai_id']));

                    foreach ($it as $item) {
                        $pegawai = Pegawai::where('nip', $item[2])->first();
                        $jabatan = Jabatan::find($pegawai->jabatan_id);
//                        dd( $jabatan);
                        $checkN = NilaiDC::where('tgl_catat', strftime("%d %B %Y", strtotime($item[0]['tanggal'])))->where('jenis', $jabatan->nama_jabatan)
                                         ->where('kode_aspek', $item[1])->where('instruksi', $item[0]['instruksi'])->count();

                        if (!$checkN){
                            NilaiDC::create([
                                'peserta_id' => $peserta->id,
                                'isHarian' => true,
                                'tgl_catat' => strftime("%d %B %Y", strtotime($item[0]['tanggal'])),
                                'jenis' => $jabatan->nama_jabatan,
                                'kode_aspek' => $item[1],
                                'instruksi' => $item[0]['instruksi'],
                                'respon' => $item[0]['respon'],
                                'nilai_hasil' => $item[0]['penilaian'],
                                'keterangan' => $item[0]['keterangan'],
                            ]);
                        }
                    }
                }

                if ($row['konsultasi'] != null){
                    $it = new \MultipleIterator();
                    $it->attachIterator(new \ArrayIterator($row['konsultasi']));
                    $it->attachIterator(new \ArrayIterator($row['jenis']));

                    foreach ($it as $item) {
                        $checkK = NilaiDC::where('tgl_catat', strftime("%d %B %Y", strtotime($item[0]['tgl_konsultasi'])))->where('jenis', $item[1])->count();

                        if (!$checkK){
                            NilaiDC::create([
                                'peserta_id' => $peserta->id,
                                'isKonsultasi' => true,
                                'tgl_catat' => strftime("%d %B %Y", strtotime($item[0]['tgl_konsultasi'])),
                                'jenis' => $item[1],
                                'kode_aspek' => $item[0]['aspek'],
                                'nilai_hasil' => $item[0]['hasil'],
                                'keterangan' => $item[0]['keterangan'],
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('p-home')->with('sukses', 'Data peserta '. "<b>" . 'Muslim Day Care' . "</b>" .' berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function getSiswaABK(){
        try{
            $response = $this->clientSIMDEPAD->get($this->uriSIMDEPAD . '/api/peserta')->getBody()->getContents();
            $response = json_decode($response, true);

            foreach ($response as $row){
                $sex = $row['sexStud']['ind'] == 'Perempuan' ? 'Perempuan' : 'Laki-laki';
                $status = $row['stud']['status'] == 'Active' ? 'aktif' : 'tidak aktif';
                $kebutuhan = KebutuhanKhusus::where('nama_kebutuhan', $row['dis']['name'])->first();
                $jenjang = Jenjang::where('nama_jenjang', $row['edu']['ind'])->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();

                //ayah
                $namaA = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Male';
                $tahunA = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Male';
                $jenjangFamA = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Male';
                $pekerjaanA = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Male';
                //ibu
                $namaI = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Female';
                $tahunI = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Female';
                $jenjangFamI = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Female';
                $pekerjaanI = $row['hub']['eng'] == 'Parent' && $row['sexFam']['en'] == 'Female';

                $check = PesertaDidik::where('nama', $row['stud']['name'])->where('kelamin', $sex)->where('nisn', $row['stud']['ni'])
                    ->where('tempat_lahir', $row['stud']['born_place'])->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['stud']['dob'])))
                    ->where('agama_id', 1)->where('kewarganegaraan_id', $negara->id)->where('kebutuhan_id', $kebutuhan->id)->where('alamat', $row['fam']['address'])
                    ->where('telpon_selular', $row['fam']['phone'])->where('email', $row['user_id']['email'])
                    ->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['stud']['register'])))->where('status', $status)->where('lembaga_id', 4)
                    ->where('created_by', Auth::user()->nama_user);

                $checkA = PesertaDidik::where('nama_ayah', $namaA == true ? $row['fam']['name'] : null)
                    ->where('tahun_lahir_ayah', $tahunA == true ? substr($row['fam']['dob'], 0, 4) : null)
                    ->where('jenjang_ayah_id', $jenjangFamA == true && $row['edu']['id'] != null ? $jenjang->id : null)
                    ->where('pekerjaan_ayah', $pekerjaanA == true ? $row['prof']['ind'] : null);
                $checkI = PesertaDidik::where('nama_ibu', $namaI == true ? $row['fam']['name'] : null)
                    ->where('tahun_lahir_ibu', $tahunI == true ? substr($row['fam']['dob'], 0, 4) : null)
                    ->where('jenjang_ibu_id', $jenjangFamI == true && $row['edu']['id'] != null ? $jenjang->id : null)
                    ->where('pekerjaan_ibu', $pekerjaanI == true ? $row['prof']['ind'] : null);
                $checkW = PesertaDidik::where('nama_wali', $row['hub']['ind'] != 'Orang Tua' ? $row['fam']['name'] : null)
                    ->where('tahun_lahir_wali', $row['hub']['ind'] != 'Orang Tua' ? substr($row['fam']['dob'], 0, 4) : null)
                    ->where('jenjang_wali_id', $row['hub']['ind'] != 'Orang Tua' && $row['edu']['ind'] != '' ? $jenjang->id : null)
                    ->where('pekerjaan_wali', $row['hub']['ind'] != 'Orang Tua' ? $row['prof']['ind'] : null);

                if (!$check->count() && !$checkA->count() || !$checkI->count() || !$checkW->count()) {
                    $peserta = PesertaDidik::create([
                        'user_id' => Auth::user()->id,
                        'nama' => $row['stud']['name'],
                        'kelamin' => $sex,
                        'nisn' => $row['stud']['ni'],
                        'tempat_lahir' => $row['stud']['born_place'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['stud']['dob'])),
                        'agama_id' => 1,
                        'kewarganegaraan_id' => $negara->id,
                        'kebutuhan_id' => $kebutuhan->id,
                        'alamat' => $row['fam']['address'],
                        'telpon_selular' => $row['fam']['phone'],
                        'email' => $row['user_id']['email'],
                        'nama_ayah' => $namaA == true ? $row['fam']['name'] : null,
                        'tahun_lahir_ayah' => $tahunA == true ? substr($row['fam']['dob'], 0, 4) : null,
                        'jenjang_ayah_id' => $jenjangFamA == true && $row['edu']['id'] != null ? $jenjang->id : null,
                        'pekerjaan_ayah' => $pekerjaanA == true ? $row['prof']['ind'] : null,
                        'nama_ibu' => $namaI == true ? $row['fam']['name'] : null,
                        'tahun_lahir_ibu' => $tahunI == true ? substr($row['fam']['dob'], 0, 4) : null,
                        'jenjang_ibu_id' => $jenjangFamI == true && $row['edu']['id'] != null ? $jenjang->id : null,
                        'pekerjaan_ibu' => $pekerjaanI == true ? $row['prof']['ind'] : null,
                        'nama_wali' => $row['hub']['ind'] != 'Orang Tua' ? $row['fam']['name'] : null,
                        'tahun_lahir_wali' => $row['hub']['ind'] != 'Orang Tua' ? substr($row['fam']['dob'], 0, 4) : null,
                        'jenjang_wali_id' => $row['hub']['ind'] != 'Orang Tua' && $row['edu']['ind'] != '' ? $jenjang->id : null,
                        'pekerjaan_wali' => $row['hub']['ind'] != 'Orang Tua' ? $row['prof']['ind'] : null,
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['stud']['register'])),
                        'status' => $row['stud']['status'] == 'Active' ? 'aktif' : 'tidak aktif',
                        'isFull' => false,
                        'lembaga_id' => 4,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                } else{
                    $peserta = $check->first();
                }

                if ($row['score'] != null) {
                    $it = new \MultipleIterator();
                    $it->attachIterator(new \ArrayIterator($row['score']));
                    $it->attachIterator(new \ArrayIterator($row['act']));
                    $it->attachIterator(new \ArrayIterator($row['mstAct']));

                    foreach ($it as $value) {
                        $checkN = NilaiABK::where('tgl_monitoring', strftime("%d %B %Y", strtotime($value[0]['date'])))->where('aktivitas', $value[2]['name'])->where('sub_aktivitas', $value[1]['name'])->where('target', $value[1]['target'])->count();

                        if (!$checkN){
                            NilaiABK::create([
                                'peserta_id' => $peserta->id,
                                'isMonitoring' => true,
                                'tgl_monitoring' => strftime("%d %B %Y", strtotime($value[0]['date'])),
                                'aktivitas' => $value[2]['name'],
                                'sub_aktivitas' => $value[1]['name'],
                                'target' => $value[1]['target'],
                                'nilai' => $value[0]['value'],
                                'prestasi' => $value[0]['achievement'],
                                'keterangan' => $value[0]['note'],
                            ]);
                        }
                    }
                }

                if ($row['rsEval'] != null){
                    foreach ($row['rsEval'] as $value){
                        $checkN = NilaiABK::where('tgl_evaluasi', strftime("%d %B %Y", strtotime(substr($value['created_at'], 0, 10))))->count();

                        if (!$checkN){
                            NilaiABK::create([
                                'peserta_id' => $peserta->id,
                                'isEvaluasi' => true,
                                'tgl_evaluasi' => strftime("%d %B %Y", strtotime(substr($value['created_at'], 0, 10))),
                                'evaluasi' => $value['detail']
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('p-home')->with('sukses', 'Data peserta '. "<b>" . 'Sanggar ABK' . "</b>" .' berhasil ditambahkan.');

        }catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function getSiswaQIS(){
        try{
            $response2 = $this->clientQIS->get($this->uriQIS . '/api/peserta')->getBody()->getContents();
            $response2 = json_decode($response2, true);

            foreach ($response2 as $row){
                $kebutuhan = KebutuhanKhusus::where('nama_kebutuhan', $row['dis']['nama_kebutuhan'])->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();
                $prov = Provinsi::where('nama_provinsi', $row['prov']['nama_provinsi'])->first();
                $kab = Kabupaten::where('nama_kabupaten', $row['kab']['nama_kabupaten'])->first();
                $kec = Kecamatan::where('nama_kecamatan', $row['kec']['nama_kecamatan'])->first();

                $check = PesertaDidik::where('nama', $row['nama_user'])->where('kelamin', $row['kelamin'])->where('nisn', $row['profile']['nisn'])
                    ->where('nik', $row['profile']['nik'])->where('tempat_lahir', $row['tempat_lahir'])
                    ->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['tgl_lahir'])))->where('agama_id', 1)->where('kewarganegaraan_id', $negara->id)
                    ->where('kebutuhan_id', $row['dis']['nama_kebutuhan'] != null ? $kebutuhan->id : null)->where('alamat', $row['alamat'])
                    ->where('rt', $row['profile']['rt'])->where('rw', $row['profile']['rw'])->where('nama_dusun', $row['profile']['nama_dusun'])
                    ->where('desa', $row['profile']['desa'])->where('provinsi_id', $prov->id)->where('kabupaten_id', $kab->id)->where('kecamatan_id', $kec->id)
                    ->where('kode_pos', $row['profile']['kode_pos'])->where('anak_ke', $row['profile']['anak_ke'])->where('telpon_selular', $row['telpon'])
                    ->where('email', $row['email_user'])
                    ->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['profile']['tgl_masuk'])))->where('status', $row['status'])->where('lembaga_id', 2)
                    ->where('created_by', Auth::user()->nama_user);

                $checK = PesertaDidik::where('nama_ayah', $row['profile']['nama_ayah'])->where('nik_ayah', $row['profile']['nik_ayah'])
                    ->where('tahun_lahir_ayah', $row['profile']['tahun_lahir_ayah'])
                    ->where('jenjang_ayah_id', Jenjang::where('nama_jenjang', $row['jenA']['nama_jenjang'])->first()->id)
                    ->where('pekerjaan_ayah', $row['profile']['pekerjaan_ayah'])
                    ->where('penghasilan_ayah_id', Penghasilan::where('jumlah_penghasilan', $row['pengA']['jumlah_penghasilan'])->first()->id)
                    ->where('nama_ibu', $row['profile']['nama_ibu'])->where('nik_ibu', $row['profile']['nik_ibu'])
                    ->where('tahun_lahir_ibu', $row['profile']['tahun_lahir_ibu'])
                    ->where('jenjang_ibu_id', Jenjang::where('nama_jenjang', $row['jenI']['nama_jenjang'])->first()->id)
                    ->where('pekerjaan_ibu', $row['profile']['tahun_lahir_ibu'])
                    ->where('penghasilan_ibu_id', Penghasilan::where('jumlah_penghasilan', $row['pengI']['jumlah_penghasilan'])->first()->id)
                    ->where('nama_wali', $row['profile']['nama_wali'])->where('nik_wali', $row['profile']['nik_wali'])
                    ->where('tahun_lahir_wali', $row['profile']['tahun_lahir_wali'])
                    ->where('jenjang_wali_id', Jenjang::where('nama_jenjang', $row['jenW']['nama_jenjang'])->first()->id)
                    ->where('pekerjaan_wali', $row['profile']['pekerjaan_wali'])
                    ->where('penghasilan_wali_id', Penghasilan::where('jumlah_penghasilan', $row['pengW']['jumlah_penghasilan'])->first()->id);

                if (!$check->count() && !$checK->count()) {
                    $peserta = PesertaDidik::create([
                        'user_id' => Auth::user()->id,
                        'nama' => $row['nama_user'],
                        'kelamin' => $row['kelamin'],
                        'nisn' => $row['profile']['nisn'],
                        'nik' => $row['profile']['nik'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['tgl_lahir'])),
                        'agama_id' => 1,
                        'kewarganegaraan_id' => $negara->id,
                        'kebutuhan_id' => $row['dis']['nama_kebutuhan'] != null ? $kebutuhan->id : null,
                        'alamat' => $row['alamat'],
                        'rt' => $row['profile']['rt'],
                        'rw' => $row['profile']['rw'],
                        'nama_dusun' => $row['profile']['nama_dusun'],
                        'desa' => $row['profile']['desa'],
                        'provinsi_id' => $prov->id,
                        'kabupaten_id' => $kab->id,
                        'kecamatan_id' => $kec->id,
                        'kode_pos' => $row['profile']['kode_pos'],
                        'anak_ke' => $row['profile']['anak_ke'],
                        'telpon_selular' => $row['telpon'],
                        'email' => $row['email_user'],
                        'nama_ayah' => $row['profile']['nama_ayah'],
                        'nik_ayah' => $row['profile']['nik_ayah'],
                        'tahun_lahir_ayah' => $row['profile']['tahun_lahir_ayah'],
                        'jenjang_ayah_id' => Jenjang::where('nama_jenjang', $row['jenA']['nama_jenjang'])->first()->id,
                        'pekerjaan_ayah' => $row['profile']['pekerjaan_ayah'],
                        'penghasilan_ayah_id' => Penghasilan::where('jumlah_penghasilan', $row['pengA']['jumlah_penghasilan'])->first()->id,
                        'nama_ibu' => $row['profile']['nama_ibu'],
                        'nik_ibu' => $row['profile']['nik_ibu'],
                        'tahun_lahir_ibu' => $row['profile']['tahun_lahir_ibu'],
                        'jenjang_ibu_id' => Jenjang::where('nama_jenjang', $row['jenI']['nama_jenjang'])->first()->id,
                        'pekerjaan_ibu' => $row['profile']['pekerjaan_ibu'],
                        'penghasilan_ibu_id' => Penghasilan::where('jumlah_penghasilan', $row['pengI']['jumlah_penghasilan'])->first()->id,
                        'nama_wali' => $row['profile']['nama_wali'],
                        'nik_wali' => $row['profile']['nik_wali'],
                        'tahun_lahir_wali' => $row['profile']['tahun_lahir_wali'],
                        'jenjang_wali_id' => Jenjang::where('nama_jenjang', $row['jenW']['nama_jenjang'])->first()->id,
                        'pekerjaan_wali' => $row['profile']['pekerjaan_wali'],
                        'penghasilan_wali_id' => Penghasilan::where('jumlah_penghasilan', $row['pengW']['jumlah_penghasilan'])->first()->id,
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['profile']['tgl_masuk'])),
                        'status' => $row['status'],
                        'isFull' => false,
                        'lembaga_id' => 2,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                } else{
                    $peserta = $check->first();
                }

                if ($row['nilai'] != null){
                    $checkN = NilaiQIS::where('nomor_nilai', $row['nilai']['nomor_nilai'])->count();
                    $checkL = NilaiQIS::where('nomor_nilai', $row['nilai']['nomor_nilai'])->where('isLulus', false)->count();

                    if (!$checkN){
                        $nilai = NilaiQIS::create([
                            'peserta_id' => $peserta->id,
                            'nomor_nilai' => $row['nilai']['nomor_nilai'],
                            'isLulus' => $row['nilai']['isLulus'] == true ? true : false,
                            'tgl_dicatat' => strftime("%d %B %Y", strtotime($row['nilai']['tgl_dicatat'])),
                            'program' => $row['prog']['nama_program'],
                            'nilai_grammar' => $row['nilai']['nilai_grammar'],
                            'nilai_comprehension' => $row['nilai']['nilai_comprehension'],
                            'nilai_conversation' => $row['nilai']['nilai_conversation'],
                            'keterangan' => $row['nilai']['keterangan'],
                        ]);

//                        dd($peserta->nama);

                        if($row['nilai']['isLulus'] == true){
                            $name = str_replace(' ', '_', str_random(2) . '' . 'ser_' . $peserta->nama);

                            $pdf = PDF::loadView("pegawai.peserta.nilai.p-sertif", compact('nilai'));
                            $pdf->setPaper('Legal', 'landscape');
                            $pdf->save('file-sertifikat/'. $name .'.pdf');

                            $nilai->update([
                                'attach' => $name.'.pdf',
                            ]);
                        }
                    }

                    if ($checkL && $row['nilai']['isLulus'] == true){
                        $nilai = NilaiQIS::where('nomor_nilai', $row['nilai']['nomor_nilai'])->first();

                        $nilai->update([
                            'isLulus' => $row['nilai']['isLulus']
                        ]);

                        if($nilai->isLulus == true){
                            $name = str_replace(' ', '_', str_random(2) . '' . 'ser_' . $peserta->nama);

                            $pdf = PDF::loadView("pegawai.peserta.nilai.p-sertif", compact('nilai'));
                            $pdf->setPaper('Legal', 'landscape');
                            $pdf->save('file-sertifikat/'. $name .'.pdf');

                            $nilai->update([
                                'attach' => $name.'.pdf',
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('p-home')->with('sukses', 'Data peserta '. "<b>" . 'QIS English' . "</b>" .' berhasil ditambahkan.');

        }catch (ConnectException $e) {
            return $e->getResponse();
        }
    }
}