<?php

namespace App\Http\Controllers\Pegawai;

use App\Agama;
use App\Bank;
use App\Http\Controllers\Controller;
use App\Jabatan;
use App\JabatanYayasan;
use App\Jenjang;
use App\JurusanPendidikan;
use App\Kewarganegaraan;
use App\Lembaga;
use App\Pegawai;
use App\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use PDF;


class DataPegawaiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
            'nik' => 'required|unique:pegawais,nik',
            'no_telp' => 'required|unique:pegawais,telpon',
            'email' => 'required|unique:pegawais,email',
            'no_rek' => 'nullable|unique:pegawais,no_rek',
            'nik_ibu' => 'required|unique:pegawais,nik_ibu',
            'nik_ayah' => 'required|unique:pegawais,nik_ayah',
        ],[
            'nik.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'no_telp.required' => 'Nomor Telpon belum anda isi, silahkan isi terlebih dahulu!.',
            'email.required' => 'E-Mail belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ibu.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ayah.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
            'no_telp.unique' => 'Nomor Telpon yang anda tambahkan sudah tersedia, masukan Nomor Telpon lain!.',
            'email.unique' => 'E-Mail yang anda tambahkan sudah tersedia, masukan E-mail lain!.',
            'no_rek.unique' => 'Nomor Rekening yang anda tambahkan sudah tersedia, masukan Nomor Rekening lain!.',
            'nik_ibu.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
            'nik_ayah.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
        ]);

       $pegawai = Pegawai::create([
          'user_id' => Auth::user()->id,
          'nik' => $request->nik,
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
        return redirect()->route('d-pegawai')->with('pegawai','Data ' . $pegawai->nama . 'pegawai berhasil ditambahkan.');
    }

    public function store_r(Request $request)
    {
        //dd($pegawai);
        $pegawai = Pegawai::find($request->id_pegawai);

        RiwayatPendidikan::create([
            //'id' => $request->riwayat_id,
            'pegawai_id' => $pegawai->id,
            'jenjang_id' => $request->jenjang,
            'jurusan_id' => $request->jurusan,
            'instansi' => $request->instansi,
            'thn_lulus' => $request->thn_lulus,

        ]);

        return redirect()->route('d-pegawai')->with('pegawai','Data ' . $pegawai->nama . 'pegawai berhasil ditambahkan.');
    }

    public function edit(Request $request, RiwayatPendidikan $rpegawai){

        $pegawai = Pegawai::find($request->id);
        $jabatan = Jabatan::all();
        $kewarganegaraan = Kewarganegaraan::all();
        $agama = Agama::all();
        $bank = Bank::all();
        $lembaga = Lembaga::where('id', '!=', [1])->get();
        $jabaya = Jabatan::where('lembaga_id', '=', 1)->get();
        $jenjang = Jenjang::whereIn('id', [8,9,10,11,12,13,14,15,16,17,18,19,20])->get();
        $jurusan = JurusanPendidikan::all();

        return view('pegawai.data-pegawai.d-p-edit', compact('pegawai', 'rpegawai', 'jabatan', 'kewarganegaraan', 'agama', 'bank', 'lembaga', 'jabaya', 'jenjang', 'jurusan'));
    }

    public function edit_r(Request $request, RiwayatPendidikan $pegawai){

        $rpegawai = RiwayatPendidikan::where('pegawai_id',$request->id)->first();
        $jenjang = Jenjang::whereIn('id', [8,9,10,11,12,13,14,15,16,17,18,19,20])->get();
        $jurusan = JurusanPendidikan::all();

        return view('pegawai.data-pegawai.d-p-edit-r', compact('pegawai', 'jenjang', 'jurusan','rpegawai'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){

        $request->validate([
            'nik' => "required|unique:pegawais,nik,$id",
            'no_telp' => "required|unique:pegawais,telpon,$id",
            'email' => "required|unique:pegawais,email,$id",
            'no_rek' => "nullable|unique:pegawais,no_rek,$id",
            'nik_ibu' => "required|unique:pegawais,nik_ibu,$id",
            'nik_ayah' => "required|unique:pegawais,nik_ayah,$id",
        ],[
            'nik.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'no_telp.required' => 'Nomor Telpon belum anda isi, silahkan isi terlebih dahulu!.',
            'email.required' => 'E-Mail belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ibu.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik_ayah.required' => 'NIK belum anda isi, silahkan isi terlebih dahulu!.',
            'nik.unique' => 'NIK yang anda tambahkan sudah tersedia, masukan NIK lain!.',
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
        return redirect()->route('d-pegawai')->with('update_r', 'Data ' . $pegawai->nama . 'berhasil diupdate.');
    }

    public function update_r(Request $request){

        $rpegawai = RiwayatPendidikan::find($request->id);
        $rpegawai->update([
            'jenjang_id' => $request->jenjang,
            'jurusan_id' => $request->jurusan,
            'instansi' => $request->instansi,
            'thn_lulus' => $request->thn_lulus,
        ]);

        $pegawai = Pegawai::where('id', $rpegawai->pegawai_id)->firstOrFail();

        return redirect()->route('d-pegawai')->with('update_r', 'Data ' . $pegawai->nama . 'berhasil diupdate.');
    }

    public function destroy($id){

        $ser = Pegawai::find($id);
        $file = $ser->foto;
        File::delete($file);
        $ser->delete();

        return back()->with('destroy', 'Data ' . $ser->nama . ' terpilih berhasil dihapus.');
    }

    public function print(Request $request){

        $data = RiwayatPendidikan::find($request->id);
        //dd($data);
        //$pdf = PDF::loadView("pegawai.data-pegawai.d-p-print", compact('data'));
        return view('pegawai.data-pegawai.d-p-print', compact('data'));
    }

    public function print_all(){
        $data = RiwayatPendidikan::all();
        $pdf = PDF::loadView("pegawai.data-pegawai.d-p-print-all", compact('data'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('daftar_pegawai.pdf');
    }

}
