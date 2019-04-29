<?php

namespace App\Http\Controllers\Pegawai;

use App\Agama;
use App\Dokumen;
use App\Http\Controllers\Controller;
use App\JadwalPelajaran;
use App\Jenjang;
use App\KebutuhanKhusus;
use App\Pegawai;
use App\Penghasilan;
use App\PesertaDidik;
use App\SuratKeluar;
use App\SuratMasuk;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    protected $clientSIMDEPAD, $clientSIMPADI, $uriSIMDEPAD, $uriSIMPADI;

    public function __construct()
    {
        $this->middleware('auth');

        $this->uriSIMPADI = env('SIMPADI_URI');
        $this->uriSIMDEPAD = env('SIMDEPAD_URI');

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

    public function index(Request $request){
        $pegawai= Pegawai::all()->count();
        $dokumen = Dokumen::all()->count();
        $pQIS = PesertaDidik::where('lembaga_id', [2])->count();
        $pABK = PesertaDidik::where('lembaga_id', [3])->count();
        $pMDC = PesertaDidik::where('lembaga_id', [4])->count();
        $sMasuk = SuratMasuk::all()->count();
        $sKeluar = SuratKeluar::all()->count();
        $jPelajaran = JadwalPelajaran::all()->count();

        $pegawaiShow = Pegawai::find($request->id);
        return view('pegawai.pegawai-home', compact('pegawai', 'dokumen', 'pQIS', 'pABK', 'pMDC', 'sMasuk', 'sKeluar', 'jPelajaran', 'pegawaiShow'));
    }

    public function changePass(){
        return view('pegawai.pegawai-rpassword');
    }

    public function change(Request $request){

//        if (Hash::check(Auth::user()->password, $request->password_lama ) ){
//            Auth::user()->update([
//                'password' => bcrypt($request->password_baru),
//                'password_a' => $request->password_baru,
//            ]);
//        }

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->with([
                'error' => 'Password lama anda salah !'
            ]);
        } else {
            if ($request->password_baru !== $request->cpassword_baru) {
                return back()->with([
                    'error' => 'Password baru anda tidak sama !'
                ]);
            } else {
                Auth::user()->update([
                    'password' => bcrypt($request->password_baru),
                    'password_a' => $request->password_baru
                ]);
            }
            return back()->with([
                'sukses' => 'Berhasil Memperbarui Password !'
            ]);
        }
    }

    public function getSiswa(Request $request){
        try {
            $response = $this->clientSIMPADI->get($this->uriSIMPADI . '/api/siswa')->getBody()->getContents();
            $response = json_decode($response, true);
            foreach ($response as $row){
                $agama = Agama::where('nama_agama', $row['user_id']['agama'])->first();
                $jenjangIbu = Jenjang::where('nama_jenjang', $row['pendidikan_terakhir_ibu'])->first();
                $jenjangAyah = Jenjang::where('nama_jenjang', $row['pendidikan_terakhir_ayah'])->first();
                $pIbu = Penghasilan::where('jumlah_penghasilan', $row['penghasilan_ibu'])->first();
                $pAyah = Penghasilan::where('jumlah_penghasilan', $row['penghasilan_ayah'])->first();
                $kebutuhan = KebutuhanKhusus::where('nama_kebutuhan', $row['jenis_abk'])->first();

                PesertaDidik::firstOrCreate([
                    'user_id' => Auth::user()->id,
                    'nama' => $row['user_id']['nama'],
                    'kelamin' => $row['user_id']['jenis_kelamin'],
                    'nik' => $row['nomer_nik'],
                    'tempat_lahir' => $row['user_id']['tempat_lahir'],
                    'tgl_lahir' => strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])),
                    'agama_id' => $agama->id,
                    'kebutuhan_id' => $kebutuhan->id,
                    'alamat' => $row['user_id']['alamat'],
                    'telpon_selular' => $row['user_id']['no_telp'],
                    'email' => $row['user_id']['email'],
                    'nama_ayah' => $row['nama_ayah'],
                    'tahun_lahir_ayah' => $row['tahun_kelahiran_ibu'],
                    'jenjang_ayah_id' => $jenjangAyah->id,
                    'pekerjaan_ayah' => $row['pekerjaan_ayah'],
                    'penghasilan_ayah_id' => $pAyah->id,
                    'nama_ibu' => $row['nama_ibu'],
                    'tahun_lahir_ibu' => $row['tahun_kelahiran_ibu'],
                    'jenjang_ibu_id' => $jenjangIbu->id,
                    'pekerjaan_ibu' => $row['pekerjaan_ibu'],
                    'penghasilan_ibu_id' => $pIbu->id,
                    'tgl_masuk' => strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])),
                    'status' => $row['status'],
                    'lembaga_id' => '3',
                    'created_by' => Auth::user()->nama_user,
                ]);
            }

            return $response;

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }
}
