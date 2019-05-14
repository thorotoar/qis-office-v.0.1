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
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use PDF;


class DataPegawaiController extends Controller
{

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
        return redirect()->route('d-pegawai')->with('pegawai','Data ' . $pegawai->nama . ' pegawai berhasil ditambahkan.');
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
        return redirect()->route('d-pegawai')->with('update_r', 'Data ' . $pegawai->nama . ' berhasil diupdate.');
    }

    public function destroy($id){

        $ser = Pegawai::find($id);
        $file = $ser->foto;
        File::delete($file);
        $ser->delete();

        return back()->with('destroy', 'Data ' . $ser->nama . ' terpilih berhasil dihapus.');
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
                $jabatan = Jabatan::where('nama_jabatan', $row['role']['nama'])->first();
                $negara = Kewarganegaraan::where('nama_negara', 'Indonesia')->first();

                $checkJ = Jabatan::where('nama_jabatan', $row['role']['nama'])->where('lembaga_id', 3)->count();

                if(!$checkJ){
                    Jabatan::create([
                        'nama_jabatan' => $row['role']['nama'],
                        'lembaga_id' => 3,
                        'created_by' => Auth::user()->nama_user,
                    ]);

                    $check = Pegawai::where('user_id', Auth::user()->id)->where('nip', $row['nip'])->where('nama', $row['user_id']['nama'])->where('alamat', $row['user_id']['alamat'])
                        ->where('tempat_lahir', $row['user_id']['tempat_lahir'])->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])))->where('kelamin', $row['user_id']['jenis_kelamin'])
                        ->where('agama_id', $agama->id)->where('kewarganegaraan_id', $negara->id)->where('telpon', $row['user_id']['no_telp'])->where('email', $row['user_id']['email'])
                        ->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])))->where('status_pekerjaan', $row['status'])->where('jabatan_id', $jabatan->id)
                        ->where('lembaga_id', 3)->where('created_by', Auth::user()->nama_user)->count();

                    if (!$check){
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
                } else {
                    $check = Pegawai::where('user_id', Auth::user()->id)->where('nip', $row['nip'])->where('nama', $row['user_id']['nama'])->where('alamat', $row['user_id']['alamat'])
                        ->where('tempat_lahir', $row['user_id']['tempat_lahir'])->where('tgl_lahir', strftime("%d %B %Y", strtotime($row['user_id']['tanggal_lahir'])))->where('kelamin', $row['user_id']['jenis_kelamin'])
                        ->where('agama_id', $agama->id)->where('kewarganegaraan_id', $negara->id)->where('telpon', $row['user_id']['no_telp'])->where('email', $row['user_id']['email'])
                        ->where('tgl_masuk', strftime("%d %B %Y", strtotime($row['user_id']['tgl_mulai_masuk'])))->where('status_pekerjaan', $row['status'])->where('jabatan_id', $jabatan->id)
                        ->where('lembaga_id', 3)->where('created_by', Auth::user()->nama_user)->count();

                    if (!$check){
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
            }

            return redirect()->route('d-pegawai')->with('sukses', 'Data pegawai dari lembaga berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

}
