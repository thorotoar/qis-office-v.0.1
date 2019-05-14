@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | EDIT DATA PEGAWAI')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Pegawai</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Data Pegawai</a></li>
                    <li class="breadcrumb-item active">Data Pegawai</li>
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
                                <form action="{{route('u-d-pegawai', $pegawai)}}" enctype="multipart/form-data" method="post">
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
                                                <label>NIK </label>
                                                <input type="number" class="form-control" name="nik" value="{{ $pegawai->nik  }}">
                                            </div>
                                            <div class="form-group">
                                                <label>NIP </label>
                                                <input type="text" class="form-control" name="nip" value="{{ $pegawai->nip }}" onkeypress="return numberOnly(event, false)">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="nama" value="{{ $pegawai->nama  }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="tempat_lahir" value="{{ $pegawai->tempat_lahir  }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control" name="tanggal_lahir" value="{{ $pegawai->tgl_lahir  }}" placeholder="tanggal/bulan/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<buttjenjon class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></buttjenjon>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis-kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select" id="jenis-kelamin" name="kelamin" required>
                                                        <option value=""  disabled>Pilih Jenis Kelamin</option>
                                                        @if($pegawai->kelamin == 'Laki-laki')
                                                            <option value="Laki-laki" selected>Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        @elseif($pegawai->kelamin == 'Perempuan')
                                                            <option value="Laki-laki" >Laki-laki</option>
                                                            <option value="Perempuan" selected>Perempuan</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="agama">Agama <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select" id="agama" name="agama" required>
                                                        <option value="" disabled>Pilih Agama</option>
                                                        @foreach($agama as $agamav)
                                                            <option value="{{$agamav->id}}"
                                                            @if($agamav->id == $pegawai->agama_id)
                                                                selected
                                                            @endif
                                                            >{{$agamav->nama_agama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Alamat <span class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="" name="alamat" placeholder="" required>{{ $pegawai->alamat  }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>No. Telp <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="no_telp" value="{{ $pegawai->telpon  }}" onkeypress="return numberOnly(event, false)" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input class="form-control" type="email" name="email" value="{{ $pegawai->email  }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="negara">Kewarganegaraan <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select" id="negara" name="negara" required>
                                                        <option value=""  disabled>Pilih Kewarganegaraan</option>
                                                        @foreach($kewarganegaraan as $negara)
                                                            <option value="{{$negara->id}}"
                                                                    @if($negara->id == $pegawai->kewarganegaraan_id)
                                                                    selected
                                                                    @endif
                                                            >{{$negara->nama_negara}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status Pernikahan </label>
                                                <div>
                                                    <select class="form-control custom-select" id="status" name="status">
                                                        @if($pegawai->status_pernikahan == 'Sudah Menikah')
                                                            <option value=""  disabled>Status</option>
                                                            <option value="Sudah Menikah" selected>Sudah Menikah</option>
                                                            <option value="Belum Menikah" >Belum Menikah</option>
                                                        @elseif($pegawai->status_pernikahan == 'Belum Menikah')
                                                            <option value=""  disabled>Status</option>
                                                            <option value="Sudah Menikah" >Sudah Menikah</option>
                                                            <option value="Belum Menikah" selected>Belum Menikah</option>
                                                        @else
                                                            <option value="" readonly disabled selected>Status</option>
                                                            <option value="Sudah Menikah" >Sudah Menikah</option>
                                                            <option value="Belum Menikah" >Belum Menikah</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Upload File Foto</label><b> (<i>{{$pegawai->foto}}</i>)</b><input type="hidden" value="{{$pegawai->foto}}" name="foto">
                                                <div>
                                                    <input type="file" name="foto_new" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Pendidikan Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Pendidikan Terakhir</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="jenjang">Jenjang Terakhir </label>
                                                <div>
                                                    <select class="form-control custom-select" id="jenjang" name="jenjang">
                                                        @if($pegawai->jenjang_id != null)
                                                            <option value="{{$pegawai->jenjang_id}}">{{App\Jenjang::find($pegawai->jenjang_id)->nama_jenjang}}</option>
                                                            @foreach($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @elseif($pegawai->jenjang_id == null)
                                                            <option value="" disabled selected readonly>Pilih Jenjang</option>
                                                            @foreach($jenjang as $jenjangs)
                                                                <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Instansi </label>
                                                <input type="text" class="form-control" name="instansi" value="{{$pegawai->instansi}}" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tahun Lulus </label>
                                                <input type="text" class="yearpicker form-control" name="thn_lulus" value="{{$pegawai->thn_lulus}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <div>
                                                    <select class="form-control custom-select" id="jurusan" name="jurusan">
                                                        @if($pegawai->jurusan_id != null)
                                                            <option value="" disabled readonly>Pilih Jurusan Peendidikan</option>
                                                            <option value="{{$pegawai->jurusan_id}}">{{App\JurusanPendidikan::find($pegawai->jurusan_id)->nama_jurusan_pendidikan}}</option>
                                                            @foreach($jurusan as $jurusans)
                                                                <option value="{{$jurusans->id}}">{{$jurusans->nama_jurusan_pendidikan}}</option>
                                                            @endforeach
                                                        @elseif($pegawai->jurusan_id == null)
                                                            <option value="" disabled readonly selected>Pilih Jurusan Peendidikan</option>
                                                            @foreach($jurusan as $jurusans)
                                                                <option value="{{$jurusans->id}}">{{$jurusans->nama_jurusan_pendidikan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Bank Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Bank</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input type="number" class="form-control" name="no_rek" value="{{ $pegawai->no_rek  }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="bank">Bank</label>
                                                <div>
                                                    <select class="form-control custom-select" id="bank" name="bank">
                                                        @if($pegawai->bank_id != null)
                                                            <option value=""  disabled>Pilih Bank</option>
                                                            @foreach($bank as $bankv)
                                                                <option value="{{$bankv->id}}"
                                                                        @if($bankv->id == $pegawai->bank_id)
                                                                        selected
                                                                        @endif
                                                                >{{$bankv->nama_bank}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value=""  disabled>Pilih Bank</option>
                                                            @foreach($bank as $bankv)
                                                                <option value="{{$bankv->id}}">{{$bankv->nama_bank}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>KCP Bank</label>
                                                <input type="text" class="form-control" name="kcp_bank" value="{{ $pegawai->kcp_bank  }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--Family Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Keluarga</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>NIK Ibu </label>
                                                <input type="number" class="form-control" name="nik_ibu" value="{{ $pegawai->nik_ibu }}">
                                            </div>
                                            <div class="form-group">
                                                <label>NIK Ayah </label>
                                                <input type="number" class="form-control" name="nik_ayah" value="{{ $pegawai->nik_ayah }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Ibu </label>
                                                <input type="text" class="form-control" name="nama_ibu" value="{{ $pegawai->ibu }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Ayah </label>
                                                <input type="text" class="form-control" name="nama_ayah" value="{{ $pegawai->ayah }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--Family Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Pasangan</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Pasangan</label>
                                                <input type="text" class="form-control" name="nama_p" value="{{ $pegawai->pasangan }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Pekerjaan Pasangan</label>
                                                <input type="text" class="form-control" name="pekerjaan_p" value="{{ $pegawai->pekerjaan_pasangan  }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{--Job Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Kepegawaian</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>NUPTK</label>
                                                <input type="text" class="form-control" name="nuptk" value="{{ $pegawai->nuptk  }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Masuk <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control" name="tanggal_masuk" value="{{ $pegawai->tgl_masuk  }}" placeholder="tanggal/bulan/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lembaga">Lembaga <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select" id="lembaga" name="lembaga"  required>
                                                        <option readonly="true" disabled>Pilih Jenis</option>
                                                        @foreach ($lembaga as $value)
                                                            <option value="{{$value->id}}"
                                                                    @if($value->id == $pegawai->lembaga_id)
                                                                    selected
                                                                    @endif
                                                            >{{$value->nama_lembaga}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan">Jenis Kepegawaian Lembaga</label>
                                                <div>
                                                    <select class="form-control custom-select" id="jabatan" name="jabatan"  required>
                                                        <option value=""  disabled readonly>Pilih Jenis</option>
                                                        @foreach ($jabatan as $value)
                                                            <option value="{{$value->id}}" @if($value->id == $pegawai->jabatan_id)
                                                            selected @endif >{{$value->nama_jabatan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>No. SK</label>
                                                <input type="text" class="form-control" name="no_sk" value="{{ $pegawai->no_sk  }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Selesai Bekerja</label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control" name="tanggal_selesai" value="{{ $pegawai->tgl_selesai  }}" placeholder="tanggal/bulan/tahun">
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatanY">Jenis Kepegawaian Yayasan </label>
                                                <div>
                                                    <select class="form-control custom-select" id="jabatanY" name="jabatanY">
                                                        <option value="0" disabled readonly>Pilih Jenis</option>
                                                        @if($pegawai->jabatan_yayasan_id != null)
                                                            <option value=""  disabled readonly>Pilih Jenis</option>
                                                            @foreach ($jabaya as $value)
                                                                <option value="{{$value->id}}" @if($value->id == $pegawai->jabatan_yayasan_id)
                                                                selected @endif >{{$value->nama_jabatan}}</option>
                                                            @endforeach
                                                        @else
                                                            <option value=""  disabled readonly selected>Pilih Jenis</option>
                                                            @foreach ($jabaya as $value)
                                                                <option value="{{$value->id}}">{{$value->nama_jabatan}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Button--}}
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-primary">Clear</button>
                                                <a href="{{route('d-pegawai')}}" class="btn btn-dark">Cancel</a>
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
        $('#lembaga').on('change', function(e){
            console.log(e);
            console.log('waw');
            var lembaga_id = e.target.value;
            $.get('/pegawai/data-pegawai/jabatan?lembaga_id=' + lembaga_id,function(data) {
                console.log(data);
                $('#jabatan').empty();
                $('#jabatan').append('<option readonly="true" selected>Pilih Jenis</option>');

                $.each(data, function(index, lembagaObj){
                    $('#jabatan').append('<option value="'+ lembagaObj.id +'">'+ lembagaObj.nama_jabatan +'</option>');
                })
            });
        });

        var fForm = $('#form-editPegawai');
        var fConfirm = $('button#editPegawai');

        // fConfirm.on('click', function(e){
        //     e.preventDefault();
        //     swal({
        //             title: "Simpan perubahan?",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#DD6B55",
        //             confirmButtonText: "Iya",
        //             cancelButtonText: "Tidak",
        //             closeOnConfirm: false,
        //             closeOnCancel: true
        //         },
        //         function(){
        //             fForm.submit();
        //         });
        // });

        fConfirm.on('click', function(){
            fForm.submit();
        });

        $('.datepicker').datepicker({
            format: "dd MM yyyy"
        });

        $('.yearpicker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@endsection