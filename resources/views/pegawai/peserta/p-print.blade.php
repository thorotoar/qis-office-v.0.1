<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Peserta Didik {{$data->lembaga->nama_lembaga}}</title>
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
<p align="center">
    <u><strong style="font-size: 16px">DATA PESERTA DIDIK</strong></u>
</p>
<table>
    {{--info personal--}}
    <tr>
        <div class="row">
            <div class="col-md-5">
                <div class="center">
                    @if($data->foto === null)
                        <img class="portrait" width="408px" height="495px" src="{{asset('images/icon/no.png')}}">
                    @else
                        <!--Carousel Wrapper-->
                        <img class="portrait" width="408px" height="495px" src="{{asset($data->foto)}}">
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
                                            <strong><span>@if($data->nik == null)
                                                        <span>-</span>
                                                    @endif{{$data->nik}}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NISN :</small><br>
                                            <strong><span>@if($data->nisn == null)
                                                        <span>-</span>
                                                    @endif{{$data->nisn}}</span></strong>
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
                                            <small class="green-text">Telepon Rumah  :</small><br>
                                            <strong><span>@if($data->telpon_rumah == null)
                                                        <span>-</span>
                                                    @endif{{$data->telpon_rumah}}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Telepon Seluler :</small><br>
                                            <strong><span>@if($data->telpon_selular == null)
                                                        <span>-</span>
                                                    @endif{{$data->telpon_selular}}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Email :</small><br>
                                            <strong><span>@if($data->email == null)
                                                        <span>-</span>
                                                    @endif{{$data->email}}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kewarganegaraan :</small><br>
                                            <strong><span>{{ $data->kewarganegaraan->nama_negara }}</span></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kebutuhan Khusus :</small><br>
                                            <strong>{{isset($data->kebutuhanKhusus)?$data->kebutuhanKhusus->nama_kebutuhan:'-'}}</strong>
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
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">RT/RW :</small><br>
                            <strong>@if($data->rt == null)
                                    <span>-</span>
                                @endif{{$data->rt}}/@if($data->rw == null)
                                    <span>-</span>
                                @endif{{$data->rw}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama Dusun :</small><br>
                            <strong><span>@if($data->nama_dusun == null)
                                        <span>-</span>
                                    @endif{{$data->nama_dusun}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Desa/Kelurahan:</small><br>
                            <strong>{{$data->desa}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Provinsi :</small><br>
                            <strong>{{$data->provinsi_id == null ? '-' : $data->provinsi->nama_provinsi}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Kabupaten :</small><br>
                            <strong>{{isset($data->kabupaten)?$data->kabupaten->nama_kabupaten:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Kecamatan :</small><br>
                            <strong>{{isset($data->kecamatan)?$data->kecamatan->nama_kecamatan:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Kode Pos :</small><br>
                            <strong>@if($data->kode_pos == null)
                                    <span>-</span>
                                @endif{{$data->kode_pos}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jenis Tinggal :</small><br>
                            <strong>@if($data->jenis_tinggal == null)
                                    <span>-</span>
                                @endif{{$data->jenis_tinggal}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Alat Transportasi :</small><br>
                            <strong>{{$data->transportasi_id ==null ? '-' : $data->transportasiPD->nama_transportasi}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Anak ke :</small><br>
                            <strong>@if($data->anak_ke == null)
                                    <span>-</span>
                                @endif{{$data->anak_ke}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Penerima KPS :</small><br>
                            <strong>{{$data->kps}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nomor KPS :</small><br>
                            <strong>@if($data->no_kps == null)
                                    <span>-</span>
                                @endif{{$data->no_kps}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Layak PIP :</small><br>
                            <strong>{{$data->pip}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Penerima KIP :</small><br>
                            <strong>{{$data->kip}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nomor KKS :</small><br>
                            <strong>@if($data->no_kks == null)
                                    <span>-</span>
                                @endif{{$data->no_kks}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Reg Akta Lahir :</small><br>
                            <strong>@if($data->reg_akta == null)
                                    <span>-</span>
                                @endif{{$data->reg_akta}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Lembaga :</small><br>
                            <strong>{{$data->lembaga->nama_lembaga}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info ayah--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Ayah</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama :</small><br>
                            <strong><span>@if($data->nama_ayah == null)
                                        <span>-</span>
                                    @endif{{$data->nama_ayah}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">NIK :</small><br>
                            <strong><span>@if($data->nik_ayah == null)
                                        <span>-</span>
                                    @endif{{$data->nik_ayah}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Tahun Lahir :</small><br>
                            <strong><span>@if($data->tahun_lahir_ayah == null)
                                        <span>-</span>
                                    @endif{{$data->tahun_lahir_ayah}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jenjang pendidikan :</small><br>
                            <strong>{{isset($data->jenjangPendidikanA)?$data->jenjangPendidikanA->nama_jenjang:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Pekerjaan :</small><br>
                            <strong><span>@if($data->pekerjaan_ayah == null)
                                        <span>-</span>
                                    @endif{{$data->pekerjaan_ayah}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Penghasilan :</small><br>
                            <strong>{{isset($data->penghasilanA)?$data->penghasilanA->jumlah_penghasilan:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Kebutuhan Khusus :</small><br>
                            <strong>{{isset($data->kebutuhanKhususA)?$data->kebutuhanKhususA->nama_kebutuhan:'-'}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info ibu--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Ibu</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama :</small><br>
                            <strong><span>{{$data->nama_ibu}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">NIK :</small><br>
                            <strong><span>@if($data->nik_ibu == null)
                                        <span>-</span>
                                    @endif{{$data->nik_ibu}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Tahun Lahir :</small><br>
                            <strong><span>@if($data->tahun_lahir_ibu == null)
                                        <span>-</span>
                                    @endif{{$data->tahun_lahir_ibu}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jenjang pendidikan :</small><br>
                            <strong>{{isset($data->jenjangPendidikanI)?$data->jenjangPendidikanI->nama_jenjang:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Pekerjaan :</small><br>
                            <strong><span>@if($data->pekerjaan_ibu == null)
                                        <span>-</span>
                                    @endif{{$data->pekerjaan_ibu}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Penghasilan :</small><br>
                            <strong>{{isset($data->penghasilanI)?$data->penghasilanI->jumlah_penghasilan:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Kebutuhan Khusus :</small><br>
                            <strong>{{isset($data->kebutuhanKhususI)?$data->kebutuhanKhususI->nama_kebutuhan:'-'}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
    {{--info wali--}}
    <tr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="h2-responsive product-name">
                            <strong>Info Wali</strong>
                        </h6><hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Nama :</small><br>
                            <strong><span>@if($data->nama_wali == null)
                                        <span>-</span>
                                    @endif{{$data->nama_wali}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">NIK :</small><br>
                            <strong><span>@if($data->nik_wali == null)
                                        <span>-</span>
                                    @endif{{$data->nik_wali}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Tahun Lahir :</small><br>
                            <strong><span>@if($data->tahun_lahir_wali == null)
                                        <span>-</span>p
                                    @endif{{$data->tahun_lahir_wali}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Jenjang pendidikan :</small><br>
                            <strong>{{isset($data->jenjangPendidikanW)?$data->jenjangPendidikanW->nama_jenjang:'-'}}</strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Pekerjaan :</small><br>
                            <strong><span>@if($data->pekerjaan_wali == null)
                                        <span>-</span>
                                    @endif{{$data->pekerjaan_wali}}</span></strong>
                        </h6>
                    </div>
                    <div class="col-md-2">
                        <h6 class="h6-responsive">
                            <small class="green-text">Penghasilan :</small><br>
                            <strong>{{isset($data->penghasilanW)?$data->penghasilanW->jumlah_penghasilan:'-'}}</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </tr><br>
</table>
</body>
</html>