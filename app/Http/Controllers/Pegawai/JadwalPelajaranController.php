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

    public function indexQIS(){
        $peg = JadwalPelajaran::where('lembaga_id', 2)->orderBy('created_at')->get();
        $lemb = Lembaga::where('id', 2)->first();
        return view('pegawai.jadwal.qis-home', compact('peg', 'lemb'));
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
        return Jadwal::where('jadwal_id', $id)->orderByRaw('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")')->get();
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
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        return back()->with('edit', 'Jadwal kegiatan ' . "<b>" . $jadMdc->kegiatan. "</b>" . ' ' . $jadMdc->jadwalPeserta->nama . ' berhasil diubah.');
    }

    public function destroy($id){
        $jad = JadwalPelajaran::find($id);
        $jad->delete();

        if ($jad->lembaga_id == 2){
            return redirect()->route('jadwal.qis')->with('hapus', 'Jadwal ' . "<b>" . $jad->nama_jadwal . "</b>" . ' berhasil dihapus.');
        }elseif ($jad->lembaga_id == 3){
            return redirect()->route('jadwal.mdc')->with('hapus', 'Jadwal ' . "<b>" . $jad->nama_jadwal . "</b>" . ' berhasil dihapus.');
        }elseif ($jad->lembaga_id == 4){
            return redirect()->route('jadwal.abk')->with('hapus', 'Jadwal ' . "<b>" . $jad->nama_jadwal . "</b>" . ' berhasil dihapus.');
        }
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
        $data = JadwalPelajaran::find($request->id);

        $pdf = PDF::setPaper('A4', 'Potrait');
        $pdf->loadView("pegawai.jadwal.j-print", compact('data'));
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

            $check = JadwalPelajaran::where('nama_jadwal', $jadwalN)->where('tgl_dicatat', strftime("%d %B %Y", strtotime(now())))->where('lembaga_id', 3)->first();

            if (!$check && $row['jadwal'] != null){
                $jadwal = JadwalPelajaran::create([
                    'nama_jadwal' => $jadwalN,
                    'tgl_dicatat' => strftime("%d %B %Y", strtotime(now())),
                    'lembaga_id' => 3,
                    'created_by' => Auth::user()->pegawai->nama,
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
                ->where('lembaga_id', 4)->first();

            if (!$check){
                $jadwal = JadwalPelajaran::create([
                    'nama_jadwal' => $row['name'],
                    'tgl_dicatat' => strftime("%d %B %Y", strtotime(now())),
                    'lembaga_id' => 4,
                    'created_by' => Auth::user()->pegawai->nama,
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
                    ]);
                }
            }
        }

        return redirect()->route('jadwal.abk')->with('sukses',  'Data jadwal ' . "<b>" . 'Sanggar ABK' . "</b>" . ' berhasil ditambahkan.');

    } catch (ConnectException $e) {
        return $e->getResponse();
    }
}

    public function getJadwalQIS(){
        try {
            $response2 = $this->clientQIS->get($this->uriQIS. '/api/jadwal')->getBody()->getContents();
            $response2 = json_decode($response2, true);

            foreach ($response2 as $row){
                $check = JadwalPelajaran::where('nama_jadwal', $row['nama_jadwal'])->where('tgl_dicatat', strftime("%d %B %Y", strtotime($row['tgl_dicatat'])))
                    ->where('lembaga_id', 2)->first();
//                dd($check);

                if (!$check){
                    $jadwal = JadwalPelajaran::create([
                        'nama_jadwal' => $row['nama_jadwal'],
                        'tgl_dicatat' => strftime("%d %B %Y", strtotime($row['tgl_dicatat'])),
                        'lembaga_id' => 2,
                        'created_by' => Auth::user()->pegawai->nama,
                    ]);
                } else {
                    $jadwal = $check->first();
                }

                if ($row['user'] != null){
                    foreach ($row['user'] as $val){
                        $nama = PesertaDidik::where('nama', $val['nama_user'])->first();
                        $nama->update([
                            'jadwal_id' => $jadwal->id
                        ]);
                    }
                }

                if($row['jad'] != null){
                    $it = new \MultipleIterator();
                    $it->attachIterator(new \ArrayIterator($row['jad']));
                    $it->attachIterator(new \ArrayIterator($row['hari']));

                    foreach ($it as $index => $item){
                        Jadwal::create([
                            'jadwal_id' => $jadwal->id,
                            'hari' => $item[1]['nama_hari'],
                            'waktu_mulai' => $item[0]['waktu_mulai'],
                            'waktu_akhir' => $item[0]['waktu_akhir'],
                            'kegiatan' => $item[0]['kegiatan'],
                            'keterangan' => $item[0]['keterangan'],
                        ]);
                    }
                }
            }

            return redirect()->route('jadwal.qis')->with('sukses',  'Data jadwal ' . "<b>" . 'QIS English' . "</b>" . ' berhasil ditambahkan.');

        } catch (ConnectException $e) {
            return $e->getResponse();
        }
    }

    public function print_all(Request $request){
        $lemb = Lembaga::find($request->id);

        $pdf = PDF::loadView("pegawai.jadwal.j-print-all", compact('lemb'));
        $pdf->setPaper('A4');
        return $pdf->stream('daftar_jadwal_pelajaran.pdf');
    }
}
