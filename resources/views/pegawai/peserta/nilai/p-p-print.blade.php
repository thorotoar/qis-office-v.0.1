<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nilai {{$sis->nama}}</title>
    <link href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
</head>
<body onload="window.print()">
<div align="center">
    <h4 class="m-b-0 text-black-50"><u>NILAI PESERTA DIDIK {{strtoupper($sis->lembaga->nama_lembaga)}}</u></h4>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="m-b-0 text-black-50">{{$sis->nama}}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h6 class="h6-responsive">
                    <small class="green-text">NIK :</small><br>
                    <strong><span>@if($sis->nik == null)
                                <span>-</span>
                            @endif{{$sis->nik}}</span></strong>
                </h6>
                <h6 class="h6-responsive">
                    <small class="green-text">TTL :</small><br>
                    <strong><span>{{ $sis->tempat_lahir }}, {{ $sis->tgl_lahir }}</span></strong>
                </h6>
            </div>
            <div class="col-md-4">
                <h6 class="h6-responsive">
                    <small class="green-text">Telepon Seluler :</small><br>
                    <strong><span>@if($sis->telpon_selular == null)
                                <span>-</span>
                            @endif{{$sis->telpon_selular}}</span></strong>
                </h6>
                <h6 class="h6-responsive">
                    <small class="green-text">Email :</small><br>
                    <strong><span>@if($sis->email == null)
                                <span>-</span>
                            @endif{{$sis->email}}</span></strong>
                </h6>
            </div>
            <div class="col-md-4">
                <h6 class="h6-responsive">
                    <small class="green-text">Jenis Kelamin :</small><br>
                    <strong><span>{{ $sis->kelamin }}</span></strong>
                </h6>
                <h6 class="h6-responsive">
                    <small class="green-text">Kebutuhan Khusus :</small><br>
                    <strong>{{isset($sis->kebutuhanKhusus)?$sis->kebutuhanKhusus->nama_kebutuhan:'-'}}</strong>
                </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h6 class="h6-responsive">
                    <small class="green-text">Alamat :</small><br>
                    <strong><span>{{$sis->alamat}}</span></strong>
                </h6>
            </div>
        </div>
    </div>
</div>
<br>
{{--info nilai--}}
@if($sis->lembaga_id == 3)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Monitoring Pengasuhan</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="14%">Kode</th>
                                <th width="15%">Instruksi</th>
                                <th width="18%">Respon</th>
                                <th width="5%">Nilai</th>
                                <th width="32%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\NilaiDC::where('peserta_id', $sis->id)->where('isHarian', true)->where('jenis', 'Pengasuh')->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_catat}}</td>
                                    <td>{{$value->kode_aspek}}</td>
                                    <td>{{$value->instruksi}}</td>
                                    <td>{{$value->respon}}</td>
                                    <td>{{$value->nilai_hasil}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Monitoring Pendidikan</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="14%">Kode</th>
                                <th width="15%">Instruksi</th>
                                <th width="18%">Respon</th>
                                <th width="5%">Nilai</th>
                                <th width="32%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\NilaiDC::where('peserta_id', $sis->id)->where('isHarian', true)->where('jenis', 'Pengajar')->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_catat}}</td>
                                    <td>{{$value->kode_aspek}}</td>
                                    <td>{{$value->instruksi}}</td>
                                    <td>{{$value->respon}}</td>
                                    <td>{{$value->nilai_hasil}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Konsultasi Psikologis</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="17%">Aspek</th>
                                <th width="20%">Hasil</th>
                                <th width="47%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\NilaiDC::where('peserta_id', $sis->id)->where('isKonsultasi', true)->where('jenis','Konsultasi Psikolog')->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_catat}}</td>
                                    <td>{{$value->kode_aspek}}</td>
                                    <td>{{$value->nilai_hasil}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Konsultasi Pendidikan</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="17%">Aspek</th>
                                <th width="20%">Hasil</th>
                                <th width="47%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\NilaiDC::where('peserta_id', $sis->id)->where('isKonsultasi', true)->where('jenis','Konsultasi Pendidikan')->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_catat}}</td>
                                    <td>{{$value->kode_aspek}}</td>
                                    <td>{{$value->nilai_hasil}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Konsultasi Kesehatan Umum</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="17%">Aspek</th>
                                <th width="20%">Hasil</th>
                                <th width="47%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\NilaiDC::where('peserta_id', $sis->id)->where('isKonsultasi', true)->where('jenis','Kesehatan Umum')->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_catat}}</td>
                                    <td>{{$value->kode_aspek}}</td>
                                    <td>{{$value->nilai_hasil}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Konsultasi Kesehatan Gigi</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="17%">Aspek</th>
                                <th width="20%">Hasil</th>
                                <th width="47%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\NilaiDC::where('peserta_id', $sis->id)->where('isKonsultasi', true)->where('jenis','Kesehatan Gigi')->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_catat}}</td>
                                    <td>{{$value->kode_aspek}}</td>
                                    <td>{{$value->nilai_hasil}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($sis->lembaga_id == 4)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Hasil Monitoring</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="14%">Kegiatan</th>
                                <th width="15%">Target</th>
                                <th width="18%">Prestasi</th>
                                <th width="32%">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(App\NilaiABK::where('peserta_id', $sis->id)->where('isMonitoring', true)->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_monitoring}}</td>
                                    <td>{{$value->sub_aktivitas}}</td>
                                    <td>{{$value->target}}</td>
                                    <td>{{$value->prestasi}}</td>
                                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if($nilai->isEvaluasi == true)
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="h2-responsive product-name">
                        <h5>Hasil Evaluasi</h5>
                    </h6><hr>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="16%">Tanggal</th>
                                <th width="14%">Hasil Evaluasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(App\NilaiABK::where('peserta_id', $sis->id)->where('isEvaluasi', true)->get() as $index => $value)
                                <tr>
                                    <td>{{$value->tgl_evaluasi}}</td>
                                    <td>{{$value->evaluasi}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endif
</body>
</html>