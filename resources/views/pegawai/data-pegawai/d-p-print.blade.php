<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pegawai {{$data->lembaga->nama_lembaga}}</title>
    <link href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('js/lib/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <style>
        .center{
            text-align: center;
        }

        img.portrait {
            border:1px solid #000;
            padding:10px;
        }
    </style>
</head>
<body onload="window.print()">
<div>
<!-- <center><img style="width: 10%" src="{{asset(('images/24.png'))}}"></center> -->
</div>
<p align="center">
    <u><strong style="font-size: 16px">DATA PEGAWAI</strong></u>
</p>
<table>
    <tr>
        <div class="row">
            <div class="col-md-5">
                <div class="center">
                    @if($data->foto === null)
                        <img class="portrait" width="348px" height="435px" src="{{asset('images/icon/no.png')}}">
                    @else
                        <!--Carousel Wrapper-->
                        <img class="portrait" width="348px" height="435px" src="{{asset($data->foto)}}">
                        <!--/.Carousel Wrapper-->
                    @endif
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h2-responsive product-name">
                            <strong>{{$data->nama}}</strong>
                        </h2><br>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class="h2-responsive product-name">
                                            <strong>Info Personal</strong>
                                        </h6><hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span>{{$data->nik}}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">TTL :</small><br>
                                            <strong><span>{{ $data->tempat_lahir }}, {{ $data->tgl_lahir }}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenis Kelamin :</small><br>
                                            <strong><span>{{ $data->kelamin }}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Agama :</small><br>
                                            <strong><span>{{ $data->agama->nama_agama }}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">No. Telp :</small><br>
                                            <strong><span>{{$data->telpon}}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Email :</small><br>
                                            <strong><span>{{ $data->email }}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kewarganegaraan :</small><br>
                                            <strong><span>{{ $data->kewarganegaraan->nama_negara }}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Status Hubungan :</small><br>
                                            <strong><span>{{ $data->agama->status_pernikahan }}</span></strong>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Alamat :</small><br>
                                            <strong><span>{{$data->alamat}}</span></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info bank--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Bank</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nomor Rekening :</small><br>
                            <strong>@if($data->no_rek == null)
                                    <span>-</span>
                                @endif{{$data->no_rek}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Bank :</small><br>
                            <strong>
                                @if($data->bank_id == null)
                                    <span>-</span>
                                @else
                                    {{$data->bank->nama_bank}}
                                @endif</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">KCP Bank :</small><br>
                            <strong>@if($data->kcp_bank == null)
                                    <span>-</span>
                                @endif{{$data->kcp_bank}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info keluarga--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Keluarga</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">NIK Ayah :</small><br>
                            <strong><span>{{$data->nik_ayah}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama Ayah :</small><br>
                            <strong><span>{{$data->ayah}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">NIK Ibu :</small><br>
                            <strong><span>{{$data->nik_ibu}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama Ibu :</small><br>
                            <strong><span>{{$data->ibu}}</span></strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info pasangan--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Pasangan</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama Pasangan :</small><br>
                            <strong>@if($data->pasangan == null)
                                    <span>-</span>
                                @endif{{$data->pasangan}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Pekerjaan Pasangan :</small><br>
                            <strong>
                                @if($data->pekerjaan_pasangan == null)
                                    <span>-</span>
                                @endif{{$data->pekerjaan_pasangan}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info kepegawaian--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Kepegawaian</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">NUPTK :</small><br>
                            <strong>@if($data->nuptk == null)
                                    <span>-</span>
                                @endif
                                {{$data->nuptk}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">No. SK :</small><br>
                            <strong>@if($data->no_sk == null)
                                    <span>-</span>
                                @endif
                                {{$data->no_sk}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Tanggal Masuk :</small><br>
                            <strong><span>{{$data->tgl_masuk}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jabatan Yayasan :</small><br>
                            <strong><span>{{isset($data->jabatanYayasan)?$data->jabatanYayasan->nama_jabatan_yayasan:'-'}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jabatan Lembaga:</small><br>
                            <strong><span>{{isset($data->jabatan)?$data->jabatan->nama_jabatan:'-'}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Lembaga :</small><br>
                            <strong><span>{{$data->lembaga->nama_lembaga}}</span></strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info pendidikan--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Pendidikan</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jenjang Terkhir :</small><br>
                            <strong><span>{{$data->jenjang_id != null ? $data->jenjang->nama_jenjang : ' '}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Tahun Lulus :</small><br>
                            <strong><span>{{$data->thn_lulus}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Instansi :</small><br>
                            <strong><span>{{$data->instansi}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jurusan :</small><br>
                            <strong>{{$data->jurusan_id != null ? $data->jurusan->nama_jurusan_pendidikan : ' '}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
</table>
</body>
</html>