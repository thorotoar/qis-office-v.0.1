<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class JabatanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->uriQIS = env('QIS_URI');
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

        $this->clientQIS = new Client([
            'base_uri' => $this->uriQIS,
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    public function index()
    {
        $jabatan = Jabatan::orderBy('id', 'ASC')->get();
        return view('admin.j-management.m-j-home', compact('jabatan'));
    }

    public function create()
    {
        return view('admin.j-management.m-j-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|unique:jabatans,nama_jabatan',
            'kode' => 'nullable|unique:jabatans,kode_jabatan',
        ],[
            'jabatan.unique' => 'Jabatan yang anda tambahkan sudah tersedia, masukan jabatan lain!.',
            'kode.unique' => 'Kode jabatan yang anda tambahkan sudah tersedia, masukan kode jabatan lain!.',
        ]);

        $jb = Jabatan::create([
            'kode_jabatan' => $request->kode,
            'nama_jabatan' => $request->jabatan,
            'created_by' => Auth::user()->pegawai->nama,
        ]);
        return redirect()->route('jm-home')->with('sukses', 'Jabatan ' . "<b>" . $jb->nama_jabatan . "</b>" . ' berhasil ditambahkan.');
    }

    public function show($id)
    {
        //return $id;

        $jabatan = Jabatan::find($id);
        return view('admin.j-management.m-j-show', compact('jabatan'));
    }

    public function edit(Request $request)
    {

        $jabatan = Jabatan::find($request->id);
        return view('admin.j-management.m-j-edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan' => "required|unique:jabatans,nama_jabatan,$id",
            'kode' => "nullable|unique:jabatans,kode_jabatan,$id",
        ],[
            'jabatan.unique' => 'Jabatan yang anda tambahkan sudah tersedia, masukan jabatan lain!.',
            'kode.unique' => 'Kode jabatan yang anda tambahkan sudah tersedia, masukan kode jabatan lain!.',
        ]);

        $jabatan = Jabatan::find($id);
        $jabatan->update([
            'kode_jabatan' => $request->kode,
            'nama_jabatan' => $request->jabatan,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        return redirect()->route('jm-home')->with('edit','Jabatan ' . "<b>" . $jabatan->nama_jabatan . "</b>" . ' berhasil diubah.');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();

        return redirect()->route('jm-home')->with('hapus','Jabatan ' . "<b>" . $jabatan->nama_jabatan . "</b>" . ' berhasil dihapus.');
    }

    public function getJabatanQIS(){
        try {
            $response = $this->clientQIS->get($this->uriQIS . '/api/role')->getBody()->getContents();
            $response = json_decode($response, true);
            foreach ($response as $row){
                $check = Jabatan::where('nama_jabatan', $row['nama'])->where('lembaga_id', 2)->count();

                if(!$check){
                    Jabatan::create([
                        'nama_jabatan' => $row['nama'],
                        'lembaga_id' => 2,
                        'created_by' => Auth::user()->pegawai->nama,
                    ]);
                }
            }

            return redirect()->route('jm-home')->with('sukses', 'Data jabatan dari ' . "<b>" . 'QIS English' . "</b>" . ' lain berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function getJabatanMDC(){
        try {
            $response1 = $this->clientSIMPADI->get($this->uriSIMPADI . '/api/role')->getBody()->getContents();
            $response1 = json_decode($response1, true);
            foreach ($response1 as $row){
                $check = Jabatan::where('nama_jabatan', $row['nama'])->where('lembaga_id', 3)->count();

                if(!$check){
                    Jabatan::create([
                        'nama_jabatan' => $row['nama'],
                        'lembaga_id' => 3,
                        'created_by' => Auth::user()->pegawai->nama,
                    ]);
                }
            }

            return redirect()->route('jm-home')->with('sukses', 'Data jabatan dari ' . "<b>" . 'Muslim Day Care' . "</b>" . ' lain berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function getJabatanABK(){
        try {
            $response2 = $this->clientSIMDEPAD->get($this->uriSIMDEPAD. '/api/role')->getBody()->getContents();
            $response2 = json_decode($response2, true);
            foreach ($response2 as $row){
                $check = Jabatan::where('nama_jabatan', $row['ind'])->where('lembaga_id', 4)->count();

                if(!$check){
                    Jabatan::create([
                        'nama_jabatan' => $row['ind'],
                        'lembaga_id' => 4,
                        'created_by' => Auth::user()->pegawai->nama,
                    ]);
                }
            }

            return redirect()->route('jm-home')->with('sukses', 'Data jabatan dari ' . "<b>" . 'Sanggar ABK' . "</b>" . ' lain berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }
}
