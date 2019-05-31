@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | SURAT KELUAR')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Surat Keluar</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Surat Keluar</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('sukses'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session()->get('sukses')}}
                </div>
            @elseif(session()->has('edit'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session()->get('edit')}}
                </div>
            @elseif(session()->has('hapus'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session()->get('hapus')}}
                </div>
            @elseif(session()->has('send'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session()->get('send')}}
                </div>
        @endif
        <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Surat Keluar</h4><hr>
                            <div class="button-list">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Tambah Surat <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        @foreach($jenisSurat as $jenis)
                                            <li><a href="{{route('surk-tambah', ['id' => $jenis->id])}}">{{$jenis->nama_jenis_surat}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a class="btn btn-primary btn-flat" href="{{route('surk-print-all')}}">
                                    <i class="fa fa-print"></i>&nbsp;Print All</a>
                                <button type="button" data-target="#raw" class="btn btn-primary btn-flat" data-toggle="modal" data-placement="top">
                                <i class="fa fa-send"></i> Kirim
                                </button>
                            </div>
                            <div class="card col-md-12 ">
                                <div class="button-list">
                                    <div class="row form-group">
                                        <div class="col-md-5">
                                            <label for="jenis_surat">Filter Jenis Surat</label>
                                            <select class="form-control custom-select form-control-sm" id="jenis_surat" name="jenis_surat" readonly>
                                                <option readonly selected>filter jenis surat</option>
                                                @foreach($jenisSurat as $jenis)
                                                    <option value="{{$jenis->nama_jenis_surat}}" readonly>{{$jenis->nama_jenis_surat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="from_surat">Filter Tanggal Keluar/Dicatat</label>
                                            <input type="text" name="from_surat" id="from_surat" class="form-control input-sm input-date" placeholder="filter tanggal keluar/dicatat.." readonly/>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="refresh" style="height: 70%"></label>
                                            <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="80px">No</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Tanggal Dicatat</th>
                                        <th>Perihal</th>
                                        <th>Jenis Surat Keluar</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    @foreach($keluarView as $index => $value)
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $value->no_surat }} </td>
                                            <td>{{ strftime("%d %B %Y", strtotime($value->tgl_keluar)) }}</td>
                                            <td>{{ strftime("%d %B %Y", strtotime($value->tgl_dicatat)) }}</td>
                                            <td>{{ $value->perihal == null ? '-' : $value->perihal }}</td>
                                            <td>{{ $value->jenisSurat->nama_jenis_surat }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <form id="form-deleteSuratP-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        onclick="return confirm('Hapus data terpilih?')"
                                                    </form>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-suratMasuk-edit" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Kirim" onclick="sendSurat('{{$value->id}}')">
                                                        <i class="fa fa-send"></i> Kirim
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat print" data-toggle="tooltip" data-placement="top" title="Print">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                    <button onclick="deleteDataPegawai('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </div>
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
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
    @include('pegawai.surat-keluar.k-send')

    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        var id;
        var body = $('body');
        body.on('click','.sweet-suratMasuk-edit',function () {
            id=$(this).data('id');
            window.location='{{route('surk-edit')}}'+'?id='+id;
        });

        body.on('click','.print',function () {
            id=$(this).data('id');
            window.location='{{route('surk-print')}}'+'?id='+id;
        });

        function deleteDataPegawai(id) {
            swal({
                title: "Hapus data terpilih?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(){
                $("#form-deleteSuratP-" + id).attr("action", "{{route('surk-hapus', ["id" => ""])}}/" + id).submit()
            })
        }

        var editor_config;
        $(function () {
            editor_config = {
                branding: false,
                path_absolute: '{{url('/')}}',
                selector: '.isi',
                height: 250,
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

        $('.input-date').datepicker({
            todayBtn: 'linked',
            format: 'dd MM yyyy',
            autoclose: true
        }).on('changeDate', function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $("#jenis_surat").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function (){
            $('#jenis_surat').prop('selectedIndex', 0);
            $('#from_surat').val('');
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });

        function sendSurat(id){
            $("#formSuratKeluar input[name=id]").val(id);
            $("#sendSuratKeluar").modal('show');
        }
    </script>
@endsection