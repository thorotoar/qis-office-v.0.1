@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | EDIT SURAT KELUAR')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">{{ $jenis->nama_jenis_surat }}</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Edit {{ $jenis->nama_jenis_surat }}</a></li>
                    <li class="breadcrumb-item active">{{ $jenis->nama_jenis_surat }}</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-elements">
                                    <form action="{{route('surk-update', $sk->id)}}" enctype="multipart/form-data" method="post">
                                        {{csrf_field()}}
                                        @if($sk->jenisSurat->template_surat == 'Template 1')
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Nomor Surat <span class="text-danger">*</span></label>
                                                        <input class="form-control input-sm" type="Text" name="no_surat" value="{{ $sk->no_surat }}" placeholder="nomor surat..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Lampiran </label>
                                                        <input class="form-control input-sm" type="Text" value="{{ $sk->lampiran }}" name="lampiran">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Perihal <span class="text-danger">*</span></label>
                                                        <input class="form-control input-sm" type="Text" value="{{ $sk->perihal }}" name="perihal" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tempat <span class="text-danger">*</span></label>
                                                        <input class="form-control input-sm" type="Text" value="{{ $sk->tempat }}" name="tempat" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Keluar <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input type="text" class="form-control input-sm" name="tgl_keluar" value="{{ $sk->tgl_keluar }}" placeholder="bulan/tanggal/tahun" required>
                                                            <div class="input-group-addon">
                                                                &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Dicatat <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input type="text" class="form-control input-sm" name="tgl_dicatat" value="{{ $sk->tgl_dicatat }}" placeholder="bulan/tanggal/tahun" required>
                                                            <div class="input-group-addon">
                                                                &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tujuan </label>
                                                        <input class="form-control input-sm" type="Text" placeholder="Contoh: Bagian Keuangan/ Sdr. Abdullah" value="{{ $sk->tujuan }}" name="tujuan">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tempat Tujuan </label>
                                                        <input class="form-control input-sm" type="Text" placeholder="Contoh: SIKES MUHAMMADIYAH LAMONGAN" value="{{ $sk->tempat_tujuan }}" name="tempat_tujuan">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Alamat Tujuan </label>
                                                        <textarea class="form-control input-sm" name="alamat_tujuan" placeholder="">{{ $sk->alamat_tujuan }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kota Tujuan </label>
                                                        <input class="form-control input-sm" type="Text" placeholder="Contoh: Lamongan" value="{{ $sk->kota_tujuan }}" name="kota_tujuan">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($sk->jenisSurat->template_surat == 'Template 2')
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nomor Surat <span class="text-danger">*</span></label>
                                                        <input class="form-control input-sm" type="Text" name="no_surat" value="{{ $sk->no_surat }}" placeholder="nomor surat..." required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tanggal Surat Keluar <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input type="text" class="form-control input-sm" name="tgl_keluar" value="{{ $sk->tgl_keluar }}" placeholder="bulan/tanggal/tahun" required>
                                                            <div class="input-group-addon">
                                                                &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Tanggal Dicatat <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input type="text" class="form-control input-sm" name="tgl_dicatat" value="{{ $sk->tgl_dicatat }}" placeholder="bulan/tanggal/tahun" required>
                                                            <div class="input-group-addon">
                                                                &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Isi Surat <span class="text-danger">*</span></label>
                                                    <textarea class="form-control isi" name="isi" placeholder="" required>
                                                    {!! $sk->isi_surat !!}
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr><div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{route('surk-home')}}" class="btn btn-dark">Cancel</a>
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
    <script src="{{asset('js/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('.datepicker').datepicker({
            format: "mm/dd/yyyy",
            todayBtn: 'linked',
            autoclose: true
        });

        $('#noSurat').inputmask({
            mask: '9{3,7}',
            placeholder: '{{$no_urut}}'
        });

        $('#kodeSurat').inputmask({
            mask: 'AAA',
            placeholder: 'QIS'
        });

        tinymce.init({
            selector: '.isi_alamat',
            height: "100",
            plugins: [
                "autolink link image charmap print preview hr anchor pagebreak",
                "wordcount visualblocks code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft alignceter alignright " +
                "alignjustify | bullist numlist outdent indent | link image media"
        });

        tinymce.init({
            selector: '.isi',
            height: "500",
            plugins: [
                "autolink link image charmap print preview hr anchor pagebreak",
                "wordcount visualblocks code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft alignceter alignright " +
                "alignjustify | bullist numlist outdent indent | link image media"
        });

    </script>
@endsection