<?php

namespace App\Http\Controllers\Pegawai;

use App\Dokumen;
use App\Http\Controllers\Controller;
use App\JadwalPelajaran;
use App\Pegawai;
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
            $response = $this->clientSIMPADI->get($this->uriSIMPADI . '/api/siswa');
            return $response;

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }
}
