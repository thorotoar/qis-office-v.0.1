<?php

namespace App\Http\Controllers\Pegawai;

use App\Jadwal;
use App\JadwalPelajaran;
use App\Lembaga;
use App\PesertaDidik;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class JadwalPelajaranController extends Controller
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

    public function indexQIS(){

    }

    public function indexMDC(){
        $peg = JadwalPelajaran::where('lembaga_id', 3)->orderBy('created_at')->get();
        $lemb = Lembaga::where('id', 2)->first();
        return view('pegawai.jadwal.mdc-home', compact('peg', 'lemb'));
    }

    public function indexABK(){
        $peg = JadwalPelajaran::where('lembaga_id', 4)->orderBy('created_at')->get();
        $lemb = Lembaga::where('id', 2)->first();
        return view('pegawai.jadwal.abk-home', compact('peg', 'lemb'));
    }

    public function modalJadwal($id){
        return Jadwal::where('jadwal_id', $id)->get();
    }

    public function editMdc(Request $request){
        $pes = PesertaDidik::find($request->id);
        $jadwal = JadwalPelajaran::where('siswa_id', $pes->id)->get();

        return view('pegawai.jadwal.mdc-edit', compact('pes', 'jadwal'));
    }


    public function updateMdc(Request $request){
        $jadMdc = JadwalPelajaran::find($request->id);

        $jadMdc->update([
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
            'kegiatan' => $request->kegiatan,
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->nama_user,
        ]);

        return back()->with('edit', 'Jadwal kegiatan ' . "<b>" . $jadMdc->kegiatan. "</b>" . ' ' . $jadMdc->jadwalPeserta->nama . ' berhasil diubah.');
    }

    public function destroyMdc($id){
        $jad = PesertaDidik::find($id);
        $jad->delete();

        return redirect()->route('mdc')->with('hapus', 'Jadwal ' . $jad->nama . ' berhasil dihapus.');
    }

    public function destroyJadwalMdc($id){
        $jadMdc = JadwalPelajaran::find($id);
        $jadMdc->delete();

        return back()->with('hapus', 'Jadwal kegiatan ' . "<b>" . $jadMdc->kegiatan. "</b>" . ' ' . $jadMdc->jadwalPeserta->nama . ' berhasil dihapus.');
    }

    public function print(Request $request){
        $pes = PesertaDidik::find($request->id);
        $data = JadwalPelajaran::where('siswa_id', $request->id)->get();

        $pdf = PDF::loadView("pegawai.jadwal.print", compact('pes', 'data'));
        $pdf->setPaper('A4');
        return $pdf->stream('jadwal_pelajaran.pdf');
    }

    public function getJadwalMDC(){
        try {
        $response = $this->clientSIMPADI->get($this->uriSIMPADI . '/api/jadwal')->getBody()->getContents();
        $response = json_decode($response, true);

        foreach ($response as $row){
//                $nama = PesertaDidik::where('nama', $row['user']['nama'])->first();
//
//                $check = JadwalPelajaran::where('siswa_id', $nama['id'])->where('kegiatan', $row['kegiatan'])->where('ruangan', $row['ruang'])->where('tgl_dicatat', strftime("%d %B %Y", strtotime(now())))->where('lembaga_id', 3)->count();
//
//                if (!$check){
//                    JadwalPelajaran::create([
//                        'siswa_id' => $nama['id'],
//                        'waktu_mulai' => $row['waktu_mulai'],
//                        'waktu_akhir' => $row['waktu_akhir'],
//                        'kegiatan' => $row['kegiatan'],
//                        'ruangan' => $row['ruang'],
//                        'keterangan' => $row['keterangan'],
//                        'tgl_dicatat' => strftime("%d %B %Y", strtotime(now())),
//                        'lembaga_id' => 3,
//                        'created_by' => Auth::user()->nama_user,
//                    ]);
//                }

//                dd($row['jadwal']);/
            $nama = PesertaDidik::where('nama', $row['user_id']['nama'])->first();
            $jadwalN = 'Jadwal '.$nama['nama'];

            $check = JadwalPelajaran::where('nama_jadwal', $jadwalN)->where('tgl_dicatat', strftime("%d %B %Y", strtotime(now())))->where('lembaga_id', 3)->count();

            if (!$check && $row['jadwal'] != null){
                $jadwal = JadwalPelajaran::create([
                    'nama_jadwal' => $jadwalN,
                    'tgl_dicatat' => strftime("%d %B %Y", strtotime(now())),
                    'lembaga_id' => 3,
                    'created_by' => Auth::user()->nama_user,
                ]);
            }else{
                $jadwal = $check->first();
            }

            if ($row['user_id']['nama'] != null){
                $nama->update([
                    'jadwal_id' => $jadwal->id
                ]);
            }

            if($row['jadwal'] != null){
                foreach ($row['jadwal'] as $index => $value){
//                            $checkJ = Jadwal::where('jadwal_id', $jadwal->id)->where('waktu_mulai', $value['waktu_mulai'])
//                                ->where('waktu_akhir', $value['waktu_akhir'])->where('kegiatan', $value['kegiatan'])->where('ruangan', $value['ruang'])->count();

                    Jadwal::create([
                        'jadwal_id' => $jadwal->id,
                        'waktu_mulai' => $value['waktu_mulai'],
                        'waktu_akhir' => $value['waktu_akhir'],
                        'kegiatan' => $value['kegiatan'],
                        'ruangan' => $value['ruang'],
                        'keterangan' => $value['keterangan'],
                        'created_by' => Auth::user()->nama_user,
                    ]);
                }
            }
        }

        return redirect()->route('jadwal.mdc')->with('sukses',  'Data jadwal ' . "<b>" . 'Muslim Day Care' . "</b>" . ' berhasil ditambahkan.');

    } catch (ConnectException $e) {
        return $e->getResponse();
    }
    }

    public function getJadwalABK(){

        try {
            $response1 = $this->clientSIMDEPAD->get($this->uriSIMDEPAD . '/api/jadwal')->getBody()->getContents();
            $response1 = json_decode($response1, true);

            foreach ($response1 as $row){
                $check = JadwalPelajaran::where('nama_jadwal', $row['name'])->where('tgl_dicatat', strftime("%d %B %Y", strtotime(now())))
                    ->where('lembaga_id', 4)->count();

                if (!$check){
                    $jadwal = JadwalPelajaran::create([
                        'nama_jadwal' => $row['name'],
                        'tgl_dicatat' => strftime("%d %B %Y", strtotime(now())),
                        'lembaga_id' => 4,
                        'created_by' => Auth::user()->nama_user,
                    ]);
                } else {
                    $jadwal = $check->first();
                }

                if ($row['sis'] != null){
                    foreach ($row['sis'] as $val){
                        $nama = PesertaDidik::where('nama', $val['name'])->first();
                        $nama->update([
                            'jadwal_id' => $jadwal->id
                        ]);
                    }
                }

                if($row['sche'] != null){
                    $it = new \MultipleIterator();
                    $it->attachIterator(new \ArrayIterator($row['day']));
                    $it->attachIterator(new \ArrayIterator($row['sche']));
                    $it->attachIterator(new \ArrayIterator($row['act']));

                    foreach ($it as $index => $item){
                        Jadwal::create([
                            'jadwal_id' => $jadwal->id,
                            'hari' => $item[0]['ind'],
                            'waktu_mulai' => $item[1]['time_start'],
                            'waktu_akhir' => $item[1]['time_end'],
                            'kegiatan' => $item[2]['name'],
                            'keterangan' => $item[2]['summary'],
                            'created_by' => Auth::user()->nama_user,
                        ]);
                    }
                }
            }

            return redirect()->route('jadwal.abk')->with('sukses',  'Data jadwal ' . "<b>" . 'Sanggar ABK' . "</b>" . ' berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function print_all(Request $request){
        if ($request->lembaga == 3){
            $datas = PesertaDidik::has('jadwalPeserta')->get();
        }

        $lemb = Lembaga::find($request->lembaga);

        $pdf = PDF::loadView("pegawai.jadwal.print-all", compact('datas', 'lemb'));
        $pdf->setPaper('A4');
        return $pdf->stream('daftar_jadwal_pelajaran.pdf');
    }
}
