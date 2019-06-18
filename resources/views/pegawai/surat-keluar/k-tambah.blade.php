@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | TAMBAH SURAT KELUAR')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">{{ $jenis->nama_jenis_surat }}</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah {{ $jenis->nama_jenis_surat }}</a></li>
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
                                    <form action="{{route('surk-tambah-selesai', ['id' => $jenis->id])}}" enctype="multipart/form-data" method="post">
                                        {{csrf_field()}}
                                        @if($jenis->template_surat == 'Template 1')
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>Nomor Surat <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input class="form-control input-sm" id="noSurat" type="Text" name="no_surat" style="width: 10%" value="{{ $no_urut }}" placeholder="nomor urut surat..." required>
                                                            <input class="form-control input-sm" id="kodeSurat" type="Text" name="kode_surat" style="width: 20%" value="{{ $jenis->kode_surat }}" placeholder="kode surat..">
                                                            <input class="form-control input-sm" id="kodeLembaga" type="Text" name="kode_lembaga" style="width: 20%" value="{{ $jenis->lembaga->kode_lembaga }}" placeholder="kode lembaga/instansi.." required>
                                                            <input class="form-control input-sm" id="kodeJabatan" type="Text" name="kode_jabatan" style="width: 20%" value="" placeholder="kode jabatan..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Lampiran </label>
                                                        <input class="form-control input-sm" type="Text" name="lampiran">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Perihal <span class="text-danger">*</span></label>
                                                        <input class="form-control input-sm" type="Text" name="perihal" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Tempat <span class="text-danger">*</span></label>
                                                        <input class="form-control input-sm" type="Text" value="Surabaya" name="tempat" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Tanggal Surat Keluar <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input autocomplete="off" type="text" class="form-control input-sm" name="tgl_keluar" placeholder="bulan/tanggal/tahun" required>
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
                                                            <input autocomplete="off" type="text" class="form-control input-sm" name="tgl_dicatat" placeholder="bulan/tanggal/tahun" required>
                                                            <div class="input-group-addon">
                                                                &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($jenis->template_surat == 'Template 2')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nomor Surat <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input class="form-control input-sm" id="noSurat" type="Text" name="no_surat" style="width: 10%" value="{{ $no_urut }}" placeholder="nomor urut surat..." required>
                                                            <input class="form-control input-sm" id="kodeSurat" type="Text" name="kode_surat" style="width: 20%" value="{{ $jenis->kode_surat }}" placeholder="kode surat..">
                                                            <input class="form-control input-sm" id="kodeLembaga" type="Text" name="kode_lembaga" style="width: 20%" value="{{ $jenis->lembaga->kode_lembaga }}" placeholder="kode lembaga/instansi.." required>
                                                            <input class="form-control input-sm" id="kodeJabatan" type="Text" name="kode_jabatan" style="width: 20%" value="" placeholder="kode jabatan..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Surat Keluar <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input autocomplete="off" type="text" class="form-control input-sm" name="tgl_keluar" placeholder="bulan/tanggal/tahun" required>
                                                            <div class="input-group-addon">
                                                                &nbsp;<button class="btn btn-flat btn-sm btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Dicatat <span class="text-danger">*</span></label>
                                                        <div class="input-group date datepicker">
                                                            <input autocomplete="off" type="text" class="form-control input-sm" name="tgl_dicatat" placeholder="bulan/tanggal/tahun" required>
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
                                                    {!! $jenis->template_konten !!}
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr><div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="reset" class="btn btn-primary">Clear</button>
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
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        var  $kode = $("#kodeJabatan");

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
            mask: 'A{2,4}',
            placeholder: '____'
        });

        $('#kodeLembaga').inputmask({
            mask: 'AAA',
            placeholder: '___'
        });

        $kode.inputmask({
            mask: 'A{2,4}',
            placeholder: '____'
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

        $kode.autocomplete({
            source: function (request, response) {
                $.getJSON('{{route('surk-search', ["Q" => ''])}}/' + $kode.val(), {
                    name: request.term,
                }, function (data) {
                    response(data);
                });
            },
            focus: function (event, ui) {
                event.preventDefault();
            },
            select: function (event, ui) {
                event.preventDefault();
                $kode.val(ui.item.kode_jabatan);
            }
        });
    </script>
@endsection