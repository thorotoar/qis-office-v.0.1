@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | TAMBAH DATA PESERTA DIDIK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Peserta Didik</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Data Peserta Didik</a></li>
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
                                <form action="{{route('p-tambah-peserta')}}" enctype="multipart/form-data" method="post">
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
                                                <input type="text" class="form-control input-sm" name="nama" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="kelamin" required>
                                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>NISN </label>
                                                <input type="text" class="form-control input-sm" name="nisn" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK </label>
                                                <input type="text" class="form-control input-sm" name="nik" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" name="tempat_lahir" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control input-sm" name="tgl_lahir" placeholder="tanggal/bulan/tahun" required>
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
                                                        @foreach($agama as $agamas)
                                                            <option value="{{$agamas->id}}"> {{$agamas->nama_agama}}</option>
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
                                                            <option value="{{$negaras->id}}"> {{$negaras->nama_negara}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kebutuhan">Kebutuhan Khusus </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kebutuhan" name="kebutuhan">
                                                        <option value="" disabled selected>Pilih Kebutuhan Khusus</option>
                                                        @foreach($kebutuhan as $kebutuhans)
                                                            <option value="{{$kebutuhans->id}}">{{$kebutuhans->kode_kebutuhan}} - {{$kebutuhans->nama_kebutuhan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat <span class="text-danger">*</span></label>
                                                <textarea name="alamat"  cols="30" rows="10" class="form-control input-sm" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>RT </label>
                                                <input type="text" class="form-control input-sm" name="rt" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>RW </label>
                                                <input type="text" class="form-control input-sm" name="rw" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Dusun </label>
                                                <input type="text" class="form-control input-sm" name="nama_dusun" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Desa/Kelurahan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" name="desa" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="provinsi" name="provinsi" required>
                                                        <option value="" disabled selected>Pilih Provinsi</option>
                                                        @foreach($provinsi as $key => $provinsis)
                                                            <option value="{{$provinsis->id}}"> {{$provinsis->nama_provinsi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kabupaten" name="kabupaten" required>
                                                        <option value="" disabled selected>Pilih Kabupaten</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kecamatan" name="kecamatan" required>
                                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tanggal Masuk <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control input-sm" name="tgl_masuk" placeholder="tanggal/bulan/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Kode Pos </label>
                                                <input type="text" class="form-control input-sm" name="kode_pos" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Tinggal </label>
                                                <input type="text" class="form-control input-sm" name="jenis_tinggal" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="negara">Alat Transportasi <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="negara" name="transportasi" required>
                                                        <option value="" disabled selected>Pilih Alat Transportasi</option>
                                                        @foreach( $transportasi as $transportasis)
                                                            <option value="{{$transportasis->id}}">{{$transportasis->nama_transportasi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Anak Keberapa </label>
                                                <input type="text" class="form-control input-sm" name="anak_ke" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telpon Rumah </label>
                                                <input type="text" class="form-control input-sm" name="telpon_rumah" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Telpon Selular </label>
                                                <input type="text" class="form-control input-sm" name="telpon_selular" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Email </label>
                                                <input type="email" class="form-control input-sm" name="email" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Penerima KPS <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="kps" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor KPS </label>
                                                <input type="text" class="form-control input-sm" name="no_kps" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Layak PIP <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="pip" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <option value="Layak">Layak</option>
                                                        <option value="Tidak Layak">Tidak Layak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Penerima KIP <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenis-kelamin" name="kip" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor KKS </label>
                                                <input type="text" class="form-control input-sm" name="no_kks" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>Reg Akta Lahir </label>
                                                <input type="text" class="form-control input-sm" name="reg_akta" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="negara">Lembaga <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="negara" name="lembaga" required>
                                                        <option value="" disabled selected>Pilih Lembaga</option>
                                                        @foreach( $lembaga as $lembagas)
                                                            <option value="{{$lembagas->id}}">{{$lembagas->nama_lembaga}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Upload Foto Peserta Didik</label>
                                                <div>
                                                    <input type="file" name="foto" class="form-control input-sm">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status Peserta didik <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="status" name="status" required>
                                                        <option value="" disabled selected>Pilih Status</option>
                                                        <option value="aktif">Aktif</option>
                                                        <option value="lulus">Tidak Aktif</option>
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
                                                <input type="text" class="form-control input-sm" name="nama_ayah" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Ayah </label>
                                                <input type="text" class="form-control input-sm" name="nik_ayah" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Lahir Ayah </label>
                                                <input type="text" class=" form-control input-sm yearpicker" name="tahun_lahir_ayah" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenjang-ayah">Jenjang Pendidikan Ayah </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenjang-ayah" name="jenjang_ayah" >
                                                        <option value="" disabled selected>Pilih Jenjang Pendidikan Ayah</option>
                                                        @foreach($jenjang as $jenjangs)
                                                            <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ayah </label>
                                                <input type="text" class="form-control input-sm" name="pekerjaan_ayah" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="penghasilan-ayah">Penghasilan Ayah </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="penghasilan-ayah" name="penghasilan_ayah" >
                                                        <option value="" disabled selected>Pilih Penghasilan Ayah</option>
                                                        @foreach($penghasilan as $penghasilans)
                                                            <option value="{{$penghasilans->id}}">{{$penghasilans->jumlah_penghasilan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kebutuhan-ayah">Kebutuhan Khusus Ayah </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kebutuhan-ayah" name="kebutuhan_ayah" >
                                                        <option value="" disabled selected>Pilih Kebutuhan Khusus Ayah</option>
                                                        @foreach($kebutuhan as $kebutuhans)
                                                            <option value="{{$kebutuhans->id}}">{{$kebutuhans->kode_kebutuhan}} - {{$kebutuhans->nama_kebutuhan}}</option>
                                                        @endforeach
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
                                                <input type="text" class="form-control input-sm" name="nama_ibu" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Ibu </label>
                                                <input type="text" class="form-control input-sm" name="nik_ibu" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Lahir Ibu </label>
                                                <input type="text" class="yearpicker form-control input-sm yearpicker" name="tahun_lahir_ibu" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenjang-ibu">Jenjang Pendidikan Ibu </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenjang-ibu" name="jenjang_ibu" >
                                                        <option value="" disabled selected>Pilih Jenjang Pendidikan Ibu</option>
                                                        @foreach($jenjang as $jenjangs)
                                                            <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Ibu </label>
                                                <input type="text" class="form-control input-sm" name="pekerjaan_ibu" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="penghasilan-ibu">Penghasilan Ibu </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="penghasilan-ibu" name="penghasilan_ibu" >
                                                        <option value="" disabled selected>Pilih Penghasilan Ibu</option>
                                                        @foreach($penghasilan as $penghasilans)
                                                            <option value="{{$penghasilans->id}}">{{$penghasilans->jumlah_penghasilan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kebutuhan-ibu">Kebutuhan Khusus Ibu </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="kebutuhan-ibu" name="kebutuhan_ibu" >
                                                        <option value="" disabled selected>Pilih Kebutuhan Khusus Ibu</option>
                                                        @foreach($kebutuhan as $kebutuhans)
                                                            <option value="{{$kebutuhans->id}}">{{$kebutuhans->kode_kebutuhan}} - {{$kebutuhans->nama_kebutuhan}}</option>
                                                        @endforeach
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
                                                <input type="text" class="form-control input-sm" name="nama_wali" value="">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Wali </label>
                                                <input type="text" class="form-control input-sm" name="nik_wali" value="" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Lahir Wali </label>
                                                <input type="text" class="form-control input-sm yearpicker" name="tahun_lahir_wali" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="jenjang-wali">Jenjang Pendidikan Wali </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="jenjang-wali" name="jenjang_wali" >
                                                        <option value="" disabled selected>Pilih Jenjang Pendidikan Wali</option>
                                                        @foreach($jenjang as $jenjangs)
                                                            <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pekerjaan Wali </label>
                                                <input type="text" class="form-control input-sm" name="pekerjaan_wali" value="">
                                            </div>
                                            <div class="form-group">
                                                <label for="penghasilan-wali">Penghasilan Wali </label>
                                                <div>
                                                    <select class="form-control form-control-sm custom-select" id="penghasilan-wali" name="penghasilan_wali" >
                                                        <option value="" disabled selected>Pilih Penghasilan Wali</option>
                                                        @foreach($penghasilan as $penghasilans)
                                                            <option value="{{$penghasilans->id}}">{{$penghasilans->jumlah_penghasilan}}</option>
                                                        @endforeach
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
                                                <a href="{{route('p-home')}}" class="btn btn-dark">Cancel</a>
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
            $.get('/pegawai/peserta-didik/kabupaten?provinsi_id=' + provinsi_id,function(data) {
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
            $.get('/pegawai/peserta-didik/kecamatan?kabupaten_id=' + provinsi_id,function(data) {
                console.log(data);

                $('#kecamatan').empty();
                $('#kecamatan').append('<option disabled selected>Pilih Kecamatan</option>');

                $.each(data, function(index, kecamatanObj){
                    $('#kecamatan').append('<option value="'+ kecamatanObj.id +'">'+ kecamatanObj.nama_kecamatan +'</option>');
                })
            });
        });

        var fForm = $('#form-addPeserta');
        var fConfirm = $('button#addPeserta');

        fConfirm.on('click', function(e){
            e.preventDefault();
            swal({
                    title: "Tambahkan pegawai?",
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
            todayBtn: 'linked',
            format: "dd MM yyyy",
            autoclose: true

        });

        $('.yearpicker').datepicker({
            todayBtn: 'linked',
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
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