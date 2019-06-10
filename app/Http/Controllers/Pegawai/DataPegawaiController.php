<?php

namespace App\Http\Controllers\Pegawai;

use App\Agama;
use App\Bank;
use App\Http\Controllers\Controller;
use App\Jabatan;
use App\Jenjang;
use App\JurusanPendidikan;
use App\Kewarganegaraan;
use App\Lembaga;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use PDF;


class DataPegawaiController extends Controller
{
    public function __construct()
    {
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
        $pegawai_view = Pegawai::orderBy('created_at', 'ASC')->get();
        return view('pegawai.data-pegawai.d-p-home', compact('pegawai_view'));
    }

    public function done(){
        return view('pegawai.data-pegawai.d-p-done');
    }

    public function create()
    {
        $kewarganegaraan = Kewarganegaraan::all();
        $agama = Agama::all();
        $bank = Bank::all();
        $lembaga = Lembaga::where('id', '!=', [1])->get();
        $lemb = Lembaga::where('id', '=', [1])->firstOrFail();
        $jabaya = Jabatan::where('lembaga_id', '=', 1)->get();
        $jenjang = Jenjang::whereIn('id', [8,9,10,11,12,13,14,15,16,17,18,19,20])->get();
        $jurusan = JurusanPendidikan::all();


        return view('pegawai.data-pegawai.d-p-tambah', compact( 'agama', 'kewarganegaraan', 'bank', 'lembaga', 'jabaya', 'jenjang', 'jurusan'));
    }

    public function jabatan(){
        $lembaga_id = Input::get('lembaga_id');
        $jabatan = Jabatan::where('lembaga_id', '=', $lembaga_id)->get();
        return response()->json($jabatan);
    }

    public function create_r(){

        $jenjang = Jenjang::whereIn('id', [8,9,10,11,12,13,14,15,16,17,18,19,20])->get();
        $jurusan = JurusanPendidikan::all();
        $pegawai = Pegawai::orderBy('id','DESC')->first();
        return view('pegawai.data-pegawai.d-p-tambah-r', compact('pegawai','jenjang', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
//            'nik' => 'required|unique:pegawais,nik',
//            'nip' => 'required|unique:pegawais,nip',
            'no_telp' => 'required|unique:pegawais,telpon',
            'email' => 'required|unique:pegawais,email',
            'no_rek' => 'nullable|unique:pegawais,no_rek',
//            'nik_ibu' => 'required|unique:pegawais,nik_ibu',
//            'nik_ayah' => 'required|unique:pegawais,nik_ayah',
        ],[
//            'nik.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
//            'nip.required' => 'NIP belum anda isi, silahkan isi terlebih dahulu!.',
            'no_telp.required' => 'Nomor Telpon belum anda isi, silahkan isi terlebih dahulu!.',
            'email.required' => 'E-Mail belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ibu.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ayah.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
            'nip.unique' => 'NIP yang anda tambahkan sudah tersedia, masukan NIP lain!.',
            'no_telp.unique' => 'Nomor Telpon yang anda tambahkan sudah tersedia, masukan Nomor Telpon lain!.',
            'email.unique' => 'E-Mail yang anda tambahkan sudah tersedia, masukan E-mail lain!.',
            'no_rek.unique' => 'Nomor Rekening yang anda tambahkan sudah tersedia, masukan Nomor Rekening lain!.',
            'nik_ibu.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
            'nik_ayah.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
        ]);

       $pegawai = Pegawai::create([
          'user_id' => Auth::user()->id,
          'nik' => $request->nik,
          'nip' => $request->nip,
//          'foto' => $request->foto,
          'nama' => $request->nama,
          'alamat' => $request->alamat,
          'tempat_lahir' => $request->tempat_lahir,
          'tgl_lahir' => $request->tanggal_lahir,
          'kelamin' => $request->kelamin,
          'agama_id' => $request->agama,
          'kewarganegaraan_id' => $request->negara,
          'telpon' => $request->no_telp,
          'email' => $request->email,
          'status_pernikahan' => $request->status,
          'nuptk' => $request->nuptk,
          'no_rek' => $request->no_rek,
          'bank_id' => $request->bank,
          'kcp_bank' => $request->kcp_bank,
          'ibu' => $request->nama_ibu,
          'nik_ibu' => $request->nik_ibu,
          'ayah' => $request->nama_ayah,
          'nik_ayah' => $request->nik_ayah,
          'pasangan' => $request->nama_p,
          'pekerjaan_pasangan' => $request->pekerjaan_p,
          'tgl_masuk' => $request->tanggal_masuk,
          'tgl_selesai' => $request->tanggal_selesai,
          'no_sk' => $request->no_sk,
          'jabatan_yayasan_id' => $request->jabatanY,
          'jabatan_id' => $request->jabatan,
          'lembaga_id' => $request->lembaga,
          'jenjang_id' => $request->jenjang,
          'status_pekerjaan' => $request->tanggal_selesai == null ? 'aktif' : 'tidak_aktif',
          'jurusan_id' => $request->jurusan,
          'instansi' => $request->instansi,
          'thn_lulus' => $request->thn_lulus,
          'created_by' => Auth::user()->nama_user,

        ]);

        if (Input::has('foto')) {
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('foto')->getClientOriginalName());
            Input::file('foto')->move('images/foto-pegawai/', $file);
            $pegawai->update([
                'foto' => 'images/foto-pegawai/' . $file,
            ]);
        }

//        return redirect()->route('d-p-tambah-r')->with('pendidikan','Lanjutkan dengan mengisi riwayat pendidikan');
        return redirect()->route('d-pegawai')->with('pegawai','Data ' . "<b>" . $pegawai->nama . "</b>" . ' pegawai berhasil ditambahkan.');
    }

    public function edit(Request $request){

        $pegawai = Pegawai::find($request->id);
//        dd($pegawai);
        $jabatan = Jabatan::where('lembaga_id', '!=', 1)->get();
        $kewarganegaraan = Kewarganegaraan::all();
        $agama = Agama::all();
        $bank = Bank::all();
        $lembaga = Lembaga::where('id', '!=', [1])->get();
        $jabaya = Jabatan::where('lembaga_id', '=', 1)->get();
        $jenjang = Jenjang::whereIn('id', [8,9,10,11,12,13,14,15,16,17,18,19,20])->get();
        $jurusan = JurusanPendidikan::all();

        return view('pegawai.data-pegawai.d-p-edit', compact('pegawai', 'rpegawai', 'jabatan', 'kewarganegaraan', 'agama', 'bank', 'lembaga', 'jabaya', 'jenjang', 'jurusan'));
    }

    public function update(Request $request, $id){

        $request->validate([
//            'nik' => "required|unique:pegawais,nik,$id",
//            'nip' => "required|unique:pegawais,nip,$id",
            'no_telp' => "required|unique:pegawais,telpon,$id",
            'email' => "required|unique:pegawais,email,$id",
            'no_rek' => "nullable|unique:pegawais,no_rek,$id",
//            'nik_ibu' => "required|unique:pegawais,nik_ibu,$id",
//            'nik_ayah' => "required|unique:pegawais,nik_ayah,$id",
        ],[
            'nik.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nip.required' => 'NIP belum anda isi, silahkan isi terlebih dahulu!.',
            'no_telp.required' => 'Nomor Telpon belum anda isi, silahkan isi terlebih dahulu!.',
            'email.required' => 'E-Mail belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ibu.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ayah.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
            'nip.unique' => 'NIP yang anda tambahkan sudah tersedia, masukan NIP lain!.',
            'no_telp.unique' => 'Nomor Telpon yang anda tambahkan sudah tersedia, masukan Nomor Telpon lain!.',
            'email.unique' => 'E-Mail yang anda tambahkan sudah tersedia, masukan E-mail lain!.',
            'no_rek.unique' => 'Nomor Rekening yang anda tambahkan sudah tersedia, masukan Nomor Rekening lain!.',
            'nik_ibu.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
            'nik_ayah.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
        ]);

        $pegawai = Pegawai::find($id);
        //dd($pegawai);
        $pegawai->update([
            'user_id' => Auth::user()->id,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'foto' => $request->foto,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tanggal_lahir,
            'kelamin' => $request->kelamin,
            'agama_id' => $request->agama,
            'kewarganegaraan_id' => $request->negara,
            'telpon' => $request->no_telp,
            'email' => $request->email,
            'status_pernikahan' => $request->status,
            'nuptk' => $request->nuptk,
            'no_rek' => $request->no_rek,
            'bank_id' => $request->bank,
            'kcp_bank' => $request->kcp_bank,
            'ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'pasangan' => $request->nama_p,
            'pekerjaan_pasangan' => $request->pekerjaan_p,
            'tgl_masuk' => $request->tanggal_masuk,
            'tgl_selesai' => $request->tanggal_selesai,
            'no_sk' => $request->no_sk,
            'jabatan_yayasan_id' => $request->jabatanY,
            'jabatan_id' => $request->jabatan,
            'lembaga_id' => $request->lembaga,
            'status_pekerjaan' => $request->tanggal_selesai == null ? 'aktif' : 'tidak_aktif',
            'jenjang_id' => $request->jenjang,
            'jurusan_id' => $request->jurusan,
            'instansi' => $request->instansi,
            'thn_lulus' => $request->thn_lulus,
            'updated_by' => Auth::user()->nama_user,
        ]);

        if (Input::has('foto_new')) {

            File::delete($pegawai->foto);
            $file = str_replace(' ', '_', str_random(4) . '' . $request->file('foto_new')->getClientOriginalName());
            Input::file('foto_new')->move('images/foto-pegawai/', $file);

            $pegawai->update([
                'foto' => 'images/foto-pegawai/' . $file,
            ]);
        }

//        $id = Pegawai::find($id);

//        return redirect()->route('d-p-edit-r',compact('id'))->with('pendidikan', 'Lanjutkan dengan mengisi riwayat pendidikan.'); //Lanjutkan dengan mengisi riwayat pendidikan.
        return redirect()->route('d-pegawai')->with('update_r', 'Data ' . "<b>" . $pegawai->nama . "</b>" . ' berhasil diupdate.');
    }

    public function destroy($id){

        $ser = Pegawai::find($id);
        $file = $ser->foto;
        File::delete($file);
        $ser->delete();

        return back()->with('destroy', 'Data ' . "<b>" . $ser->nama . "</b>" . ' terpilih berhasil dihapus.');
    }

    public function print(Request $request){

        $data = Pegawai::find($request->id);
        return view('pegawai.data-pegawai.d-p-print', compact('data'));
    }

    public function print_all(){
        $data = Pegawai::all();
        $pdf = PDF::loadView("pegawai.data-pegawai.d-p-print-all", compact('data'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('daftar_pegawai.pdf');
    }

    public function getPegawai(){
        try {
            $response = $this->clientSIMPADI->get($this->uriSIMPADI . '/api/pegawai')->getBody()->getContents();
            $response = json_decode($response, true);

            foreach ($response as $row){
                $agama = Agama::where('nama_agama', $row['user_id']['agama'])->first();
                $jabatan = Jabatan::where('nama_jabatan', $row['role']['nama'] == 'Pendidik' ? 'Pengajar' : $row['role']['nama'])->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();

                $check = Pegawai::where('nip', $row['nip'])->where('nama', $row['user_id']['nama'])
                    ->where('alamat', $row['user_id']['alamat'])->where('tempat_lahir', $row['user_id']['tempat_lahir'])
                    ->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])))->where('kelamin', $row['user_id']['jenis_kelamin'])
                    ->where('agama_id', $agama->id)->where('kewarganegaraan_id', $negara->id)->where('telpon', $row['user_id']['no_telp'])
                    ->where('email', $row['user_id']['email'])->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])))
                    ->where('status_pekerjaan', $row['status'])->where('jabatan_id', $jabatan->id)->where('lembaga_id', 3)
                    ->where('created_by', Auth::user()->nama_user)->count();

                $checkJ = Jabatan::where('nama_jabatan', $row['role']['nama'] == 'Pendidik' ? 'Pengajar' : $row['role']['nama'])->where('lembaga_id', 3)->count();

                if(!$checkJ && !$check){
                    Jabatan::create([
                        'nama_jabatan' => $row['role']['nama'] == 'Pendidik' ? 'Pengajar' : $row['role']['nama'],
                        'lembaga_id' => 3,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                    Pegawai::create([
                        'user_id' => Auth::user()->id,
                        'nip' => $row['nip'],
                        'nama' => $row['user_id']['nama'],
                        'alamat' => $row['user_id']['alamat'],
                        'tempat_lahir' => $row['user_id']['tempat_lahir'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])),
                        'kelamin' => $row['user_id']['jenis_kelamin'],
                        'agama_id' => $agama->id,
                        'kewarganegaraan_id' => $negara->id,
                        'telpon' => $row['user_id']['no_telp'],
                        'email' => $row['user_id']['email'],
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])),
                        'status_pekerjaan' => $row['status'],
                        'jabatan_id' => $jabatan->id,
                        'lembaga_id' => 3,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                } elseif($checkJ && !$check) {
                    Pegawai::create([
                        'user_id' => Auth::user()->id,
                        'nip' => $row['nip'],
                        'nama' => $row['user_id']['nama'],
                        'alamat' => $row['user_id']['alamat'],
                        'tempat_lahir' => $row['user_id']['tempat_lahir'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])),
                        'kelamin' => $row['user_id']['jenis_kelamin'],
                        'agama_id' => $agama->id,
                        'kewarganegaraan_id' => $negara->id,
                        'telpon' => $row['user_id']['no_telp'],
                        'email' => $row['user_id']['email'],
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])),
                        'status_pekerjaan' => $row['status'],
                        'jabatan_id' => $jabatan->id,
                        'lembaga_id' => 3,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                }
            }

            return redirect()->route('d-pegawai')->with('sukses', 'Data pegawai ' . "<b>" . 'Muslim Day Care' . "</b>" . ' berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function getPegawaiABK(){
        try{
            $response1 = $this->clientSIMDEPAD->get($this->uriSIMDEPAD . '/api/pegawai')->getBody()->getContents();
            $response1 = json_decode($response1, true);

            foreach ($response1 as $row){
                $jabatan = Jabatan::where('nama_jabatan', $row['role']['ind'])->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();
                if ($row['hub'] == null){
                    $hub = null;
                }elseif($row['hub'] != null){
                    $hub = $row['hub']['ind'] != 'Menikah' ? 'Belum Menikah' : 'Sudah Menikah' ;
                }

                if(Hash::check(true, $row['code_status'])){
                    $stats = 'aktif';
                } else {
                    $stats = 'tidak_aktif';
                }

                $check = Pegawai::where('nip', $row['ni'])->where('nama', $row['name'])->where('alamat', $row['address'])->where('tempat_lahir', $row['born_place'])
                    ->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['dob'])))->where('kelamin', $row['sex']['ind'])
                    ->where('agama_id', 1)->where('kewarganegaraan_id', $negara->id)->where('telpon', $row['phone'])->where('email', $row['email'])
                    ->where('status_pernikahan', $hub)->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['profile']['register'])))
                    ->where('status_pekerjaan', $stats)->where('jabatan_id', $jabatan->id)
                    ->where('jenjang_id', $row['edu']['ind'] != null ? Jenjang::where('nama_jenjang', $row['edu']['ind'])->first()->id : null)->where('lembaga_id', 4)
                    ->where('created_by', Auth::user()->nama_user)->count();

                $checkJ = Jabatan::where('nama_jabatan', $row['role']['ind'])->where('lembaga_id', 4)->count();

                if(!$check && !$checkJ){
                    Jabatan::create([
                        'nama_jabatan' => $row['role']['ind'],
                        'lembaga_id' => 4,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                    Pegawai::create([
                        'user_id' => Auth::user()->id,
                        'nip' => $row['ni'],
                        'nama' => $row['name'],
                        'alamat' => $row['address'],
                        'tempat_lahir' => $row['born_place'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['dob'])),
                        'kelamin' => $row['sex']['ind'],
                        'agama_id' => 1,
                        'kewarganegaraan_id' => $negara->id,
                        'telpon' => $row['phone'],
                        'email' => $row['email'],
                        'status_pernikahan' => $hub,
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['profile']['register'])),
                        'status_pekerjaan' => $stats,
                        'jabatan_id' => $jabatan->id,
                        'jenjang_id' => $row['edu']['ind'] != null ? Jenjang::where('nama_jenjang', $row['edu']['ind'])->first()->id : null,
                        'lembaga_id' => 4,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                } elseif(!$check && $checkJ) {
                    Pegawai::create([
                        'user_id' => Auth::user()->id,
                        'nip' => $row['ni'],
                        'nama' => $row['name'],
                        'alamat' => $row['address'],
                        'tempat_lahir' => $row['born_place'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['dob'])),
                        'kelamin' => $row['sex']['ind'],
                        'agama_id' => 1,
                        'kewarganegaraan_id' => $negara->id,
                        'telpon' => $row['phone'],
                        'email' => $row['email'],
                        'status_pernikahan' => $hub,
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['profile']['register'])),
                        'status_pekerjaan' => 'aktif',
                        'jabatan_id' => $jabatan->id,
                        'jenjang_id' => $row['edu']['ind'] != null ? Jenjang::where('nama_jenjang', $row['edu']['ind'])->first()->id : null,
                        'lembaga_id' => 4,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                }
            }

            return redirect()->route('d-pegawai')->with('sukses', 'Data pegawai ' . "<b>" . 'Sanggar ABK' . "</b>" . ' berhasil ditambahkan.');
        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function getPegawaiQIS(){
        try{
            $response2 = $this->clientQIS->get($this->uriQIS . '/api/pegawai')->getBody()->getContents();
            $response2 = json_decode($response2, true);

            foreach ($response2 as $row){
                $jabatan = Jabatan::where('nama_jabatan', $row['role']['nama'])->where('lembaga_id', 2)->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();

                $check = Pegawai::where('nik', $row['profile']['nik'])->where('nip', $row['profile']['nip'])->where('nama', $row['nama_user'])->where('alamat', $row['alamat'])
                    ->where('tempat_lahir', $row['tempat_lahir'])->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['tgl_lahir'])))
                    ->where('kelamin', $row['kelamin'])->where('agama_id', 1)->where('kewarganegaraan_id', $negara->id)->where('telpon', $row['telpon'])
                    ->where('email', $row['email_user'])->where('status_pernikahan', $row['profile']['status_pernikahan'])->where('nuptk', $row['profile']['nuptk'])
                    ->where('no_rek', $row['profile']['no_rek'])
                    ->where('bank_id', $row['bank']['nama_bank'] != null ? Bank::where('nama_bank', $row['bank']['nama_bank'])->first()->id : null)
                    ->where('kcp_bank', $row['profile']['kcp_bank'])->where('pasangan', $row['profile']['pasangan'])
                    ->where('pekerjaan_pasangan', $row['profile']['pekerjaan_pasangan'])
                    ->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['profile']['tgl_masuk'])))
                    ->where('status_pekerjaan', $row['status'])->where('jabatan_id', $jabatan->id)
                    ->where('jenjang_id', $row['edu']['nama_jenjang'] != null ? Jenjang::where('nama_jenjang', $row['edu']['nama_jenjang'])->first()->id : null)
                    ->where('jurusan_id', $row['jurusan']['nama_jurusan_pendidikan'] != null ? JurusanPendidikan::where('nama_jurusan_pendidikan', $row['jurusan']['nama_jurusan_pendidikan'])->first()->id : null)
                    ->where('instansi', $row['profile']['instansi'])->where('thn_lulus', $row['profile']['thn_lulus'])->where('lembaga_id', 2)
                    ->where('created_by', Auth::user()->nama_user)->count();

                $checkJ = Jabatan::where('nama_jabatan', $row['role']['nama'])->where('lembaga_id', 2)->count();

                if(!$check && !$checkJ){
                    Jabatan::create([
                        'nama_jabatan' => $row['role']['nama'],
                        'lembaga_id' => 2,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                    Pegawai::create([
                        'user_id' => Auth::user()->id,
                        'nik' => $row['profile']['nik'],
                        'nip' => $row['profile']['nip'],
                        'nama' => $row['nama_user'],
                        'alamat' => $row['alamat'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['tgl_lahir'])),
                        'kelamin' => $row['kelamin'],
                        'agama_id' => 1,
                        'kewarganegaraan_id' => $negara->id,
                        'telpon' => $row['telpon'],
                        'email' => $row['email_user'],
                        'status_pernikahan' => $row['profile']['status_pernikahan'],
                        'nuptk' => $row['profile']['nuptk'],
                        'no_rek' => $row['profile']['no_rek'],
                        'bank_id' => $row['bank']['nama_bank'] != null ? Bank::where('nama_bank', $row['bank']['nama_bank'])->first()->id : null,
                        'kcp_bank' => $row['profile']['kcp_bank'],
                        'pasangan' => $row['profile']['pasangan'],
                        'pekerjaan_pasangan' => $row['profile']['pekerjaan_pasangan'],
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['profile']['tgl_masuk'])),
                        'status_pekerjaan' => $row['status'],
                        'jabatan_id' => $jabatan->id,
                        'jenjang_id' => $row['edu']['nama_jenjang'] != null ? Jenjang::where('nama_jenjang', $row['edu']['nama_jenjang'])->first()->id : null,
                        'jurusan_id' => $row['jurusan']['nama_jurusan_pendidikan'] != null ? JurusanPendidikan::where('nama_jurusan_pendidikan', $row['jurusan']['nama_jurusan_pendidikan'])->first()->id : null,
                        'instansi' => $row['profile']['instansi'],
                        'thn_lulus' => $row['profile']['thn_lulus'],
                        'lembaga_id' => 2,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                } elseif(!$check && $checkJ) {
                    Pegawai::create([
                        'user_id' => Auth::user()->id,
                        'nik' => $row['profile']['nik'],
                        'nip' => $row['profile']['nip'],
                        'nama' => $row['nama_user'],
                        'alamat' => $row['alamat'],
                        'tempat_lahir' => $row['tempat_lahir'],
                        'tgl_lahir' => strftime("%d %B %Y", strtotime($row['tgl_lahir'])),
                        'kelamin' => $row['kelamin'],
                        'agama_id' => 1,
                        'kewarganegaraan_id' => $negara->id,
                        'telpon' => $row['telpon'],
                        'email' => $row['email_user'],
                        'status_pernikahan' => $row['profile']['status_pernikahan'],
                        'nuptk' => $row['profile']['nuptk'],
                        'no_rek' => $row['profile']['no_rek'],
                        'bank_id' => $row['bank']['nama_bank'] != null ? Bank::where('nama_bank', $row['bank']['nama_bank'])->first()->id : null,
                        'kcp_bank' => $row['profile']['kcp_bank'],
                        'pasangan' => $row['profile']['pasangan'],
                        'pekerjaan_pasangan' => $row['profile']['pekerjaan_pasangan'],
                        'tgl_masuk' => strftime("%d %B %Y", strtotime($row['profile']['tgl_masuk'])),
                        'status_pekerjaan' => $row['status'],
                        'jabatan_id' => $jabatan->id,
                        'jenjang_id' => $row['edu']['nama_jenjang'] != null ? Jenjang::where('nama_jenjang', $row['edu']['nama_jenjang'])->first()->id : null,
                        'jurusan_id' => $row['jurusan']['nama_jurusan_pendidikan'] != null ? JurusanPendidikan::where('nama_jurusan_pendidikan', $row['jurusan']['nama_jurusan_pendidikan'])->first()->id : null,
                        'instansi' => $row['profile']['instansi'],
                        'thn_lulus' => $row['profile']['thn_lulus'],
                        'lembaga_id' => 2,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                }
            }

            return redirect()->route('d-pegawai')->with('sukses', 'Data pegawai ' . "<b>" . 'QIS English' . "</b>" . ' berhasil ditambahkan.');
        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

}
