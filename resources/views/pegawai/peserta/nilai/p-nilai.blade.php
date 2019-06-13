@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | NILAI PESERTA DIDIK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Nilai Peserta Didik</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $peserta->nama }}</a></li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('send'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {!! session('send') !!}
                        </div>
                    </div>
                </div>
        @endif
        <!-- Start Page Content -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                @if( $lemb->nama_lembaga == 'Quali International Surabaya')
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#nilai" role="tab">Hasil Nilai</a> </li>
                                @elseif( $lemb->nama_lembaga == 'Muslim Day Care')
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#harian" role="tab">Report Harian</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#konsultasi" role="tab">Report Konsultasi</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#kesehatan" role="tab">Report Kesehatan</a> </li>
                                @elseif( $lemb->nama_lembaga == 'Sanggar ABK')
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#monitoring" role="tab">Report Monitoring</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#evaluasi" role="tab">Report Evaluasi</a> </li>
                                @endif
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @if($lemb->nama_lembaga == 'Quali International Surabaya')
                                    <div class="tab-pane active" id="nilai" role="tabpanel">
                                        <div class="card-body">
                                            <br><div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Hasil Nilai Peserta Didik</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Tanggal Dicatat</th>
                                                                        <th>Grammar</th>
                                                                        <th>Comprehension</th>
                                                                        <th>Conversation</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach( \App\NilaiQIS::where('peserta_id', $peserta->id)->get() as $index => $value)
                                                                        @php
                                                                        $id = \App\PesertaDidik::where('id', $value->peserta_id)->first()->id;
                                                                        $email = \App\PesertaDidik::where('id', $value->peserta_id)->first()->email;
                                                                        @endphp
                                                                        <tr>
                                                                            <th>{{$value->tgl_dicatat}}</th>
                                                                            <th>{{$value->nilai_grammar}}</th>
                                                                            <th>{{$value->nilai_comprehension}}</th>
                                                                            <th>{{$value->nilai_conversation}}</th>
                                                                            <th>
                                                                                <button data-id="{{$id}}" class="btn btn-sm btn-rounded btn-primary btn-flat ser-print"
                                                                                        data-toggle="modal" data-placement="top"
                                                                                        title="Cetak Sertifikan" @if($value->isLulus == false)
                                                                                        disabled @endif>
                                                                                <i class="fa fa-search"></i> Cetak Sertifikat
                                                                                </button>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                                 data-toggle="modal" data-placement="top"
                                                                                                 title="Kirim Sertifikan" @if($value->isLulus == false)
                                                                                                 disabled @endif onclick="sendSertifikat('{{$value->id}}', '{{$email}}')">
                                                                                    <i class="fa fa-search"></i> Kirim Sertifikat
                                                                                </button>
                                                                            </th>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($lemb->nama_lembaga == 'Muslim Day Care')
                                    <div class="tab-pane active" id="harian" role="tabpanel">
                                        <div class="card-body">
                                            <br><div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Pengasuhan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title m-t-15">Daftar Hasil Monitoring Pengasuhan</h3>
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Monitoring</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach( \App\NilaiDC::where('peserta_id', $peserta->id)->where('isHarian', true)->where('jenis', 'Pengasuh')->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Hasil Monitoring Pengasuhan';
                                                                            $no = $index + 1;
                                                                            $kode = $value->kode_aspek;
                                                                            $ins = $value->instruksi;
                                                                            $res = $value->respon;
                                                                            $nilai = $value->nilai_hasil;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <td scope="row">{{ $index + 1 }}</td>
                                                                            <td>{{ $value->tgl_catat  }}</td>
                                                                            <td>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                        data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring"
                                                                                        onclick="getLihatNilai('{{$value->id}}', '{{$title}}', '{{$no}}', '{{$kode}}', '{{$ins}}', '{{$res}}', '{{$nilai}}', '{{$ket}}')">
                                                                                    <i class="fa fa-search"></i> Detail Monitoring
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Pendidikan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title m-t-15">Daftar Hasil Monitoring Pendidikan</h3>
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Monitoring</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach( \App\NilaiDC::where('peserta_id', $peserta->id)->where('isHarian', true)->where('jenis', 'Pengajar')->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Hasil Monitoring Pendidikan';
                                                                            $no = $index + 1;
                                                                            $kode = $value->kode_aspek;
                                                                            $ins = $value->instruksi;
                                                                            $res = $value->respon;
                                                                            $nilai = $value->nilai_hasil;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <th scope="row">{{ $index + 1 }}</th>
                                                                            <th>{{ $value->tgl_catat  }}</th>
                                                                            <th>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                        data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring"
                                                                                        onclick="getLihatNilai('{{$value->id}}', '{{$title}}', '{{$no}}', '{{$kode}}', '{{$ins}}', '{{$res}}', '{{$nilai}}', '{{$ket}}')">
                                                                                    <i class="fa fa-search"></i> Detail Monitoring
                                                                                </button>
                                                                            </th>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="konsultasi" role="tabpanel"><br>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Psikologis</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title m-t-15">Daftar Hasil Konsultasi Psikologis</h3>
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Konsultasi</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(\App\NilaiDC::where('peserta_id', $peserta->id)->where('isKonsultasi', true)->where('jenis','Konsultasi Psikolog')->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Hasil Konsultasi Psikologis';
                                                                            $no = $index + 1;
                                                                            $aspek = $value->kode_aspek == null ? '-' : $value->kode_aspek;
                                                                            $hasil = $value->nilai_hasil == null ? '-' : $value->nilai_hasil;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <th scope="row">{{ $index + 1 }}</th>
                                                                            <th>{{ $value->tgl_catat  }}</th>
                                                                            <th>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                        data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring"
                                                                                        onclick="getLihatKons('{{$value->id}}', '{{$title}}', '{{$no}}', '{{$aspek}}', '{{$hasil}}', '{{$ket}}')">
                                                                                    <i class="fa fa-search"></i> Detail Konsultasi
                                                                                </button>
                                                                            </th>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Pendidikan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title m-t-15">Daftar Hasil Konsultasi Pendidikan</h3>
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Konsultasi</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(\App\NilaiDC::where('peserta_id', $peserta->id)->where('isKonsultasi', true)->where('jenis','Konsultasi Pendidikan')->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Hasil Konsultasi Pendidikan';
                                                                            $no = $index + 1;
                                                                            $aspek = $value->kode_aspek == null ? '-' : $value->kode_aspek;
                                                                            $hasil = $value->nilai_hasil == null ? '-' : $value->nilai_hasil;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <th scope="row">{{ $index + 1 }}</th>
                                                                            <th>{{ $value->tgl_catat  }}</th>
                                                                            <th>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                        data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring"
                                                                                        onclick="getLihatKons('{{$value->id}}', '{{$title}}', '{{$no}}', '{{$aspek}}', '{{$hasil}}', '{{$ket}}')">
                                                                                    <i class="fa fa-search"></i> Detail Konsultasi
                                                                                </button>
                                                                            </th>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--third tab-->
                                    <div class="tab-pane" id="kesehatan" role="tabpanel">
                                        <div class="card-body">
                                            <br><div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Kesehatan Umum</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title m-t-15">Daftar Hasil Konsultasi Kesehatan Umum</h3>
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Konsultasi</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(\App\NilaiDC::where('peserta_id', $peserta->id)->where('isKonsultasi', true)->where('jenis','Kesehatan Umum')->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Hasil Konsultasi Kesehatan Umum';
                                                                            $no = $index + 1;
                                                                            $aspek = $value->kode_aspek == null ? '-' : $value->kode_aspek;
                                                                            $hasil = $value->nilai_hasil == null ? '-' : $value->nilai_hasil;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <td scope="row">{{ $index + 1 }}</td>
                                                                            <td>{{ $value->tgl_catat  }}</td>
                                                                            <td>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                        data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring"
                                                                                        onclick="getLihatKons('{{$value->id}}', '{{$title}}', '{{$no}}', '{{$aspek}}', '{{$hasil}}', '{{$ket}}')">
                                                                                    <i class="fa fa-search"></i> Detail Konsultasi
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Kesehatan Gigi</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <h3 class="card-title m-t-15">Daftar Hasil Konsultasi Kesehatan Gigi</h3>
                                                            <hr>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Konsultasi</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(\App\NilaiDC::where('peserta_id', $peserta->id)->where('isKonsultasi', true)->where('jenis','Kesehatan Gigi')->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Hasil Konsultasi Kesehatan Gigi';
                                                                            $no = $index + 1;
                                                                            $aspek = $value->kode_aspek == null ? '-' : $value->kode_aspek;
                                                                            $hasil = $value->nilai_hasil == null ? '-' : $value->nilai_hasil;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <td scope="row">{{ $index + 1 }}</td>
                                                                            <td>{{ $value->tgl_catat  }}</td>
                                                                            <td>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                                        data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring"
                                                                                        onclick="getLihatKons('{{$value->id}}', '{{$title}}', '{{$no}}', '{{$aspek}}', '{{$hasil}}', '{{$ket}}')">
                                                                                    <i class="fa fa-search"></i> Detail Konsultasi
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($lemb->nama_lembaga == 'Sanggar ABK')
                                    <div class="tab-pane active" id="monitoring" role="tabpanel">
                                        <div class="card-body">
                                            <br><div class="row">
                                                {{--//foreachhere--}}
                                                <div class="col-lg-12">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Daftar Hasil Monitoring</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Kegiatan</th>
                                                                        <th>Sub Kegiatan</th>
                                                                        <th>Target</th>
                                                                        <th>Tanggal Monitoring</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(\App\NilaiABK::where('peserta_id', $peserta->id)->where('isMonitoring', true)->get() as $index => $value)
                                                                        @php
                                                                            $title = 'Nilai Aktivitas Peserta Didik';
                                                                            $nilai = $value->nilai == null ? '-' : $value->nilai;
                                                                            $pres = $value->prestasi == null ? '-' : $value->prestasi;
                                                                            $ket = $value->keterangan == null ? '-' : $value->keterangan;
                                                                        @endphp
                                                                        <tr>
                                                                            <td scope="row">{{$index + 1}}</td>
                                                                            <td>{{$value->aktivitas}}</td>
                                                                            <td>{{$value->sub_aktivitas}}</td>
                                                                            <td>{{$value->target}}</td>
                                                                            <td>{{$value->tgl_monitoring}}</td>
                                                                            <td>
                                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring" onclick="getMonitoring('{{$value->id}}', '{{$title}}', '{{$nilai}}', '{{$pres}}','{{$ket}}')">
                                                                                    <i class="fa fa-eye"></i> Nilai
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="evaluasi" role="tabpanel"><br>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card card-outline-primary">
                                                        <div class="card-header">
                                                            <h4 class="m-b-0 text-white">Daftar Hasil Evaluasi Peserta Didik</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal Evaluasi</th>
                                                                        <th></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach(\App\NilaiABK::where('peserta_id', $peserta->id)->where('isEvaluasi', true)->get() as $index => $value)
                                                                    @php
                                                                    $title = 'Hasil Evaluasi Peserta Didik';
                                                                    $detail = $value->evaluasi;
                                                                    @endphp
                                                                    <tr>
                                                                        <td scope="row">{{$index + 1}}</td>
                                                                        <td>{{$value->tgl_evaluasi}}</td>
                                                                        <td>
                                                                            <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat Detail Monitoring" onclick="getEvaluasi('{{$value->id}}', '{{$title}}', '{!! $detail !!}')">
                                                                                <i class="fa fa-eye"></i> Detail Hasil Evaluasi
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
    </div>

    @include('pegawai.peserta.nilai.p-nilai-show')
    @include('pegawai.peserta.nilai.p-send')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>

    <script>
        var id;
        var body = $('body');
        body.on('click', '.sweet-peserta-edit', function () {
            id = $(this).data('id');
            swal({
                title: "Edit data terpilih?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {

                if (isConfirm) {
                    window.location = '{{route('p-edit')}}' + '?id=' + id;
                }
            })
        });

        body.on('click', '.ser-print', function () {
            id = $(this).data('id');
            window.location = '{{route('p-n-print')}}' + '?id=' + id;
        });

        function getLihatNilai(id, title, no, kode, ins, res, nilai, ket){
            $("#title").text(title);
            $("#no").text(no);
            $("#kode").text(kode);
            $("#ins").text(ins);
            $("#res").text(res);
            $("#nilai").text(nilai);
            $("#ket").text(ket);
            $("#modalHarian").modal('show');
        }

        function getLihatKons(id, title, no, aspek, hasil, ket){
            $("#title1").text(title);
            $("#no1").text(no);
            $("#aspek1").text(aspek);
            $("#hasil1").text(hasil);
            $("#ket1").text(ket);
            $("#modalKonsultasi").modal('show');
        }

        function getMonitoring(id, title, nilai, pres, ket){
            $("#titleMo").text(title);
            $("#nilaiMo").text(nilai);
            $("#presMo").text(pres);
            $("#ketMo").text(ket);
            $("#modalMonitoring").modal('show');
        }

        function getEvaluasi(id, title, detail){
            console.log('test');
            $("#titleEv").text(title);
            $("#detailEv").html(detail);
            $("#modalEvaluasi").modal('show');
        }

        body.on('click', '.sweet-print', function () {
            id = $(this).data('id');
            window.location = '{{route('p-print')}}' + '?id=' + id;
        });

        $("#kelamin").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $("#lembaga").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function () {
            $('#kelamin').prop('selectedIndex', 0);
            $('#lembaga').prop('selectedIndex', 0);
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });

        function sendSertifikat(id, email){
            $("#formSertifikat input[name=id]").val(id);
            $("#formSertifikat input[name=penerima]").val(email);
            $("#sendSertifikat").modal('show');
        }

        var editor_config;
        $(function () {
            editor_config = {
                branding: false,
                path_absolute: '{{url('/')}}',
                selector: '.isi',
                height: 100,
                themes: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code',
                    'insertdatetime media table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                relative_urls: false,
                file_browser_callback: function (field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth ||
                        document.getElementsByTagName('body')[0].clientWidth,
                        y = window.innerHeight || document.documentElement.clientHeight ||
                            document.getElementsByTagName('body')[0].clientHeight,
                        cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + '&type=Images';
                    } else {
                        cmsURL = cmsURL + '&type=Files';
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'File Manager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: 'yes',
                        close_previous: 'no'
                    });
                }
            };
            tinymce.init(editor_config);
        });
    </script>
@endsection