@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | EDIT DATA PESERTA DIDIK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Peserta Didik</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Data Peserta Didik</a></li>
                    <li class="breadcrumb-item active">Data Peserta Didik</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ $error }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-elements">
                                <form action="{{route('ap-update', $peserta)}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    {{--Personal Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Personal</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Peserta Didik <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" name="nama" value="{{$peserta->nama}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="kelamin" required>
                                                        <option value="" disabled>Pilih Jenis Kelamin</option>
                                                        @if($peserta->kelamin == 'Laki-laki')
                                                            <option value="Laki-laki" selected>Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        @elseif($peserta->kelamin == 'Perempuan')
                                                            <option value="Laki-laki" >Laki-laki</option>
                                                            <option value="Perempuan" selected>Perempuan</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>NISN </label>
                                                <input type="text" class="form-control input-sm" name="nisn" value="{{$peserta->nisn}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK </label>
                                                <input type="text" class="form-control input-sm" name="nik" value="{{$peserta->nik}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" name="tempat_lahir" value="{{$peserta->tempat_lahir}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input autocomplete="off" type="text" class="form-control input-sm" name="tgl_lahir" value="{{$peserta->tgl_lahir}}" placeholder="tanggal/bulan/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="agama">Agama <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="agama" name="agama" required>
                                                        <option value="" disabled selected>Pilih Agama</option>
                                                        <option value="" disabled>Pilih Agama</option>
                                                        @foreach($agama as $agamav)
                                                            <option value="{{$agamav->id}}"
                                                                    @if($agamav->id == $peserta->agama_id)
                                                                    selected
                                                                    @endif
                                                            >{{$agamav->nama_agama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="negara">Kewarganegaran <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="negara" name="kewarganegaraan" required>
                                                        <option value="" disabled selected>Pilih Kewarganegaran</option>
                                                        @foreach($negara as $negaras)
                                                            <option value="{{$negaras->id}}"
                                                                    @if($negaras->id == $peserta->kewarganegaraan_id)
                                                                    selected
                                                                    @endif
                                                            >{{$negaras->nama_negara}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kebutuhan">Kebutuhan Khusus </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kebutuhan" name="kebutuhan">
                                                        @if($peserta->kebutuhan_id != null)
                                                            <option value="" disabled>Pilih Kebutuhan Khusus</option>
                                                            @foreach ($kebutuhan as $kebutuhans)
                                                                <option value="{{$kebutuhans->id}}"
                                                                        @if($kebutuhans->id == $peserta->kebutuhan_id)
                                                                        selected
                                                                        @endif
                                                                >{{$kebutuhans->nama_kebutuhan}}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="" disabled selected>Pilih Kebutuhan Khusus</option>
                                                        @foreach ($kebutuhan as $kebutuhans)
                                                            <option value="{{$kebutuhans->id}}">{{$kebutuhans->nama_kebutuhan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat <span class="text-danger">*</span></label>
                                                <textarea name="alamat"  cols="30" rows="10" class="form-control input-sm" required>{{$peserta->alamat}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>RT </label>
                                                <input type="text" class="form-control input-sm" name="rt" value="{{$peserta->rt}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>RW </label>
                                                <input type="text" class="form-control input-sm" name="rw" value="{{$peserta->rw}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Dusun </label>
                                                <input type="text" class="form-control input-sm" name="nama_dusun" value="{{$peserta->nama_dusun}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Desa/Kelurahan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" name="desa" value="{{$peserta->desa}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="provinsi" name="provinsi" required>
                                                        @if($peserta->provinsi_id != null)
                                                            <option value="" disabled >Pilih Provinsi</option>
                                                            @foreach($provinsi as $provinsis)
                                                                <option value="{{$provinsis->id}}"
                                                                        @if($provinsis->id == $peserta->provinsi_id)
                                                                        selected
                                                                        @endif
                                                                >{{$provinsis->nama_provinsi}}</option>
                                                            @endforeach
                                                        @elseif($peserta->provinsi_id == null))
                                                        <option value="" disabled selected>Pilih Provinsi</option>
                                                        @foreach($provinsi as $key => $provinsis)
                                                            <option value="{{$provinsis->id}}"> {{$provinsis->nama_provinsi}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kabupaten" name="kabupaten" required>
                                                        @if($peserta->kabupaten_id != null)
                                                            <option value="" disabled >Pilih Kabupaten</option>
                                                            @foreach ($kabupaten as $kabupatens)
                                                                <option value="{{$kabupatens->id}}"
                                                                        @if($kabupatens->id == $peserta->kabupaten_id)
                                                                        selected
                                                                        @endif
                                                                >{{$kabupatens->nama_kabupaten}}</option>
                                                            @endforeach
                                                        @elseif($peserta->kabupaten_id == null)
                                                            <option value="" disabled selected>Pilih Kabupaten</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kecamatan" name="kecamatan" required>
                                                        @if($peserta->kecamatan_id != null)
                                                            <option value="" disabled >Pilih Kecamatan</option>
                                                            @foreach ($kecamatan as $kecamatans)
                                                                <option value="{{$kecamatans->id}}"
                                                                        @if($kecamatans->id == $peserta->kecamatan_id)
                                                                        selected
                                                                        @endif
                                                                >{{$kecamatans->nama_kecamatan}}</option>
                                                            @endforeach
                                                        @elseif($peserta->kecamatan_id != null)
                                                            <option value="" disabled selected>Pilih Kecamatan</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tanggal Masuk <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input autocomplete="off" type="text" class="form-control input-sm" name="tgl_masuk" value="{{$peserta->tgl_masuk}}" placeholder="tanggal/bulan/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Pos </label>
                                                <input type="text" class="form-control input-sm" name="kode_pos" value="{{$peserta->kode_pos}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Tinggal </label>
                                                <input type="text" class="form-control input-sm" name="jenis_tinggal" value="{{ $peserta->jenis_tinggal}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="negara">Alat Transportasi <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="negara" name="transportasi" required>
                                                        @if($peserta->transportasi_id != null)
                                                            <option value="" disabled>Pilih Alat Transportasi</option>
                                                            @foreach ($transportasi as $transportasis)
                                                                <option value="{{$transportasis->id}}"
                                                                        @if($transportasis->id == $peserta->transportasi_id)
                                                                        selected
                                                                        @endif
                                                                >{{$transportasis->nama_transportasi}}</option>
                                                            @endforeach
                                                        @elseif($peserta->transportasi_id == null)
                                                            <option value="" disabled selected>Pilih Alat Transportasi</option>
                                                            @foreach ($transportasi as $transportasis)
                                                                <option value="{{$transportasis->id}}">{{$transportasis->nama_transportasi}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Anak Keberapa </label>
                                                <input type="text" class="form-control input-sm" name="anak_ke" value="{{$peserta->anak_ke}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telpon Rumah </label>
                                                <input type="text" class="form-control input-sm" name="telpon_rumah" value="{{$peserta->telpon_rumah}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telpon Selular </label>
                                                <input type="text" class="form-control input-sm" name="telpon_selular" value="{{$peserta->telpon_selular}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Email </label>
                                                <input type="email" class="form-control input-sm" name="email" value="{{$peserta->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Penerima KPS <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="kps" required>
                                                        @if($peserta->kps == 'Ya')
                                                            <option value="" disabled >Pilih</option>
                                                            <option value="Ya" selected>Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        @elseif($peserta->kps == null)
                                                            <option value="" disabled selected>Pilih</option>
                                                            <option value="Ya">Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        @elseif($peserta->kps == 'Tidak')
                                                            <option value="" disabled >Pilih</option>
                                                            <option value="Ya" >Ya</option>
                                                            <option value="Tidak" selected>Tidak</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor KPS </label>
                                                <input type="text" class="form-control input-sm" name="no_kps" value="{{$peserta->no_kps}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Layak PIP <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="pip" required>
                                                        @if($peserta->pip == 'Layak')
                                                            <option value="" disabled>Pilih</option>
                                                            <option value="Layak" selected>Layak</option>
                                                            <option value="Tidak Layak">Tidak Layak</option>
                                                        @elseif($peserta->pip == 'Tidak Layak')
                                                            <option value="" disabled>Pilih</option>
                                                            <option value="Layak">Layak</option>
                                                            <option value="Tidak Layak" selected>Tidak Layak</option>
                                                        @elseif($peserta->pip == null)
                                                            <option value="" disabled selected>Pilih</option>
                                                            <option value="Layak">Layak</option>
                                                            <option value="Tidak Layak">Tidak Layak</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Penerima KIP <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="kip" required>
                                                        @if($peserta->kip == 'Ya')
                                                            <option value="" disabled>Pilih</option>
                                                            <option value="Ya" selected>Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        @elseif($peserta->kip == 'Tidak')
                                                            <option value="" disabled>Pilih</option>
                                                            <option value="Ya" >Ya</option>
                                                            <option value="Tidak" selected>Tidak</option>
                                                        @elseif($peserta->kip == null)
                                                            <option value="" disabled selected>Pilih</option>
                                                            <option value="Ya">Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor KKS </label>
                                                <input type="text" class="form-control input-sm" name="no_kks" value="{{$peserta->no_kks}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Reg Akta Lahir </label>
                                                <input type="text" class="form-control input-sm" name="reg_akta" value="{{$peserta->reg_akta}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="negara">Lembaga <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="lembaga" name="lembaga" required>
                                                        <option readonly="true" disabled>Pilih Jenis</option>
                                                        @foreach ($lembaga as $value)
                                                            <option value="{{$value->id}}"
                                                                    @if($value->id == $peserta->lembaga_id)
                                                                    selected
                                                                    @endif
                                                            >{{$value->nama_lembaga}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Upload Foto Peserta Didik</label><b> (<i>{{$peserta->foto}}</i>)</b><input type="hidden" value="{{$peserta->foto}}" name="foto">
                                                <div>
                                                    <input type="file" name="foto_new" class="form-control input-sm">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status Peserta didik <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="status" name="status" required>
                                                        <option value="" disabled>Pilih Status</option>
                                                        @if($peserta->status == 'Aktif')
                                                            <option value="Aktif" selected>Aktif</option>
                                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                                        @elseif($peserta->status == 'Tidak Aktif')
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Tidak Aktif" selected>Tidak Aktif</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Ayah Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Ayah</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Ayah </label>
                                                <input type="text" class="form-control input-sm" name="nama_ayah" value="{{$peserta->nama_ayah}}">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Ayah </label>
                                                <input type="text" class="form-control input-sm" name="nik_ayah" value="{{$peserta->nik_ayah}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Lahir Ayah </label>
                                                <input type="text" class=" form-control input-sm yearpicker" name="tahun_lahir_ayah" value="{{$peserta->tahun_lahir_ayah}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenjang-ayah">Jenjang Pendidikan Ayah </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenjang-ayah" name="jenjang_ayah" >
                                                        @if($peserta->jenjang_ayah_id != null)
                                                            <option value="" disabled>Pilih Jenjang Pendidikan Ayah</option>
                                                            @foreach ($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}"
                                                                        @if($jenjangs->id == $peserta->jenjang_ayah_id)
                                                                        selected
                                                                        @endif
                                                                >{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @elseif($peserta->jenjang_ayah_id == null)
                                                            <option value="" disabled>Pilih Jenjang Pendidikan Ayah</option>
                                                            @foreach ($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ayah </label>
                                                <input type="text" class="form-control input-sm" name="pekerjaan_ayah" value="{{$peserta->pekerjaan_ayah}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="penghasilan-ayah">Penghasilan Ayah </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="penghasilan-ayah" name="penghasilan_ayah" >
                                                        @if($peserta->jenjang_ayah_id != null)
                                                            <option value="" disabled>Pilih Penghasilan Ayah</option>
                                                            @foreach ($penghasilan as $penghasilans)
                                                                <option value="{{$penghasilans->id}}"
                                                                        @if($penghasilans->id == $peserta->penghasilan_ayah_id)
                                                                        selected
                                                                        @endif
                                                                >{{$penghasilans->jumlah_penghasilan}}</option>
                                                            @endforeach
                                                        @elseif($peserta->jenjang_ayah_id == null)
                                                            <option value="" disabled>Pilih Penghasilan Ayah</option>
                                                            @foreach ($penghasilan as $penghasilans)
                                                                <option value="{{$penghasilans->id}}">{{$penghasilans->jumlah_penghasilan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kebutuhan-ayah">Kebutuhan Khusus Ayah </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kebutuhan-ayah" name="kebutuhan_ayah" >
                                                        @if($peserta->kebutuhan_ayah_id != null)
                                                                <option value="" disabled>Pilih Kebutuhan Khusus Ayah</option>
                                                            @foreach ($kebutuhan as $kebutuhans)
                                                                <option value="{{$kebutuhans->id}}"
                                                                        @if($kebutuhans->id == $peserta->kebutuhan_ayah_id)
                                                                        selected
                                                                        @endif
                                                                >{{$kebutuhans->nama_kebutuhan}}</option>
                                                            @endforeach
                                                        @elseif($peserta->kebutuhan_ayah_id == null)
                                                            <option value="" disabled selected>Pilih Kebutuhan Khusus Ayah</option>
                                                            @foreach ($kebutuhan as $kebutuhans)
                                                                <option value="{{$kebutuhans->id}}">{{$kebutuhans->nama_kebutuhan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Ibu Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Ibu</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Ibu <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" name="nama_ibu" value="{{$peserta->nama_ibu}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Ibu </label>
                                                <input type="text" class="form-control input-sm" name="nik_ibu" value="{{$peserta->nik_ibu}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Lahir Ibu </label>
                                                <input type="text" class=" form-control input-sm yearpicker" name="tahun_lahir_ibu" value="{{$peserta->tahun_lahir_ibu}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenjang-ibu">Jenjang Pendidikan Ibu </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenjang-ibu" name="jenjang_ibu" >
                                                        @if($peserta->jenjang_ibu_id != null)
                                                            <option value="" disabled>Pilih Jenjang Pendidikan Ibu</option>
                                                            @foreach ($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}"
                                                                        @if($jenjangs->id == $peserta->jenjang_ibu_id)
                                                                        selected
                                                                        @endif
                                                                >{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @elseif($peserta->jenjang_ibu_id == null)
                                                            <option value="" disabled>Pilih Jenjang Pendidikan Ibu</option>
                                                            @foreach ($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ibu </label>
                                                <input type="text" class="form-control input-sm" name="pekerjaan_ibu" value="{{$peserta->pekerjaan_ibu}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="penghasilan-ibu">Penghasilan Ibu </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="penghasilan-ibu" name="penghasilan_ibu" >
                                                        @if($peserta->jenjang_ibu_id != null)
                                                            <option value="" disabled>Pilih Penghasilan Ibu</option>
                                                            @foreach ($penghasilan as $penghasilans)
                                                                <option value="{{$penghasilans->id}}"
                                                                        @if($penghasilans->id == $peserta->penghasilan_ibu_id)
                                                                        selected
                                                                        @endif
                                                                >{{$penghasilans->jumlah_penghasilan}}</option>
                                                            @endforeach
                                                        @elseif($peserta->jenjang_ibu_id == null)
                                                            <option value="" disabled>Pilih Penghasilan Ibu</option>
                                                            @foreach ($penghasilan as $penghasilans)
                                                                <option value="{{$penghasilans->id}}">{{$penghasilans->jumlah_penghasilan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kebutuhan-ibu">Kebutuhan Khusus Ibu </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kebutuhan-ibu" name="kebutuhan_ibu" >
                                                        <option value="" disabled>Pilih Kebutuhan Khusus Ibu</option>
                                                        @if($peserta->kebutuhan_ibu_id != null)
                                                            <option value="" disabled>Pilih Kebutuhan Khusus Ibu</option>
                                                            @foreach ($kebutuhan as $kebutuhans)
                                                                <option value="{{$kebutuhans->id}}"
                                                                        @if($kebutuhans->id == $peserta->kebutuhan_ibu_id)
                                                                        selected
                                                                        @endif
                                                                >{{$kebutuhans->nama_kebutuhan}}</option>
                                                            @endforeach
                                                        @elseif($peserta->kebutuhan_ibu_id == null)
                                                            <option value="" disabled selected>Pilih Kebutuhan Khusus Ibu</option>
                                                            @foreach ($kebutuhan as $kebutuhans)
                                                                <option value="{{$kebutuhans->id}}">{{$kebutuhans->nama_kebutuhan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Wali Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Wali</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Wali </label>
                                                <input type="text" class="form-control input-sm" name="nama_wali" value="{{$peserta->nama_wali}}">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Wali </label>
                                                <input type="text" class="form-control input-sm" name="nik_wali" value="{{$peserta->nik_wali}}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Lahir Wali </label>
                                                <input type="text" class=" form-control input-sm yearpicker" name="tahun_lahir_wali" value="{{$peserta->tahun_lahir_wali}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="jenjang-wali">Jenjang Pendidikan Wali </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenjang-wali" name="jenjang_wali">
                                                        @if($peserta->jenjang_wali_id != null)
                                                            <option value="" disabled>Pilih Jenjang Pendidikan Wali</option>
                                                            @foreach ($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}"
                                                                        @if($jenjangs->id == $peserta->jenjang_wali_id)
                                                                        selected
                                                                        @endif
                                                                >{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @elseif($peserta->jenjang_wali_id == null)
                                                            <option value="" disabled>Pilih Jenjang Pendidikan Wali</option>
                                                            @foreach ($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pekerjaan Wali </label>
                                                <input type="text" class="form-control input-sm" name="pekerjaan_wali" value="{{$peserta->pekerjaan_wali}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="penghasilan-wali">Penghasilan Wali </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="penghasilan-wali" name="penghasilan_wali" >
                                                        @if($peserta->jenjang_wali_id != null)
                                                            <option value="" disabled>Pilih Penghasilan Wali</option>
                                                            @foreach ($penghasilan as $penghasilans)
                                                                <option value="{{$penghasilans->id}}"
                                                                        @if($penghasilans->id == $peserta->penghasilan_wali_id)
                                                                        selected
                                                                        @endif
                                                                >{{$penghasilans->jumlah_penghasilan}}</option>
                                                            @endforeach
                                                        @elseif($peserta->jenjang_wali_id == null)
                                                            <option value="" disabled>Pilih Penghasilan Wali</option>
                                                            @foreach ($penghasilan as $penghasilans)
                                                                <option value="{{$penghasilans->id}}">{{$penghasilans->jumlah_penghasilan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{--Button--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <hr>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-primary">Clear</button>
                                                <a href="{{route('ap-home')}}" class="btn btn-dark">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /# row -->

            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $('#provinsi').on('change', function(e){
            console.log(e);
            console.log('waw');
            var provinsi_id = e.target.value;
            $.get('/admin/peserta-didik/kabupaten?provinsi_id=' + provinsi_id,function(data) {
                console.log(data);
                $('#kabupaten').empty();
                $('#kabupaten').append('<option disabled selected>Pilih Kabupaten</option>');

                $('#kecamatan').empty();
                $('#kecamatan').append('<option disabled selected>Pilih Kecamatan</option>');

                $.each(data, function(index, kabupatenObj){
                    $('#kabupaten').append('<option value="'+ kabupatenObj.id +'">'+ kabupatenObj.nama_kabupaten +'</option>');
                })
            });
        });

        $('#kabupaten').on('change', function(e){
            console.log(e);
            console.log('waw');
            var provinsi_id = e.target.value;
            $.get('/admin/peserta-didik/kecamatan?kabupaten_id=' + provinsi_id,function(data) {
                console.log(data);

                $('#kecamatan').empty();
                $('#kecamatan').append('<option disabled selected>Pilih Kecamatan</option>');

                $.each(data, function(index, kecamatanObj){
                    $('#kecamatan').append('<option value="'+ kecamatanObj.id +'">'+ kecamatanObj.nama_kecamatan +'</option>');
                })
            });
        });

        var fForm = $('#form-editPeserta');
        var fConfirm = $('button#editPeserta');

        fConfirm.on('click', function(e){
            e.preventDefault();
            swal({
                    title: "Simpan perubahan?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(){
                    fForm.submit();
                });
        });

        $('.datepicker').datepicker({
            format: "dd MM yyyy"
        });

        $('.yearpicker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $(".years").datetimepicker({
            format: "yyyy",
            startView: 'decade',
            minView: 'decade',
            viewSelect: 'decade',
            autoclose: true,
        });
    </script>
@endsection