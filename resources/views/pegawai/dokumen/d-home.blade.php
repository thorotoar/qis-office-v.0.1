@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | DOKUMEN')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Dokumen</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dokumen</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('sukses'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('sukses') !!}
                </div>
            @elseif(session()->has('edit'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('edit') !!}
                </div>
            @elseif(session()->has('hapus'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('hapus') !!}
                </div>
            @elseif(session()->has('send'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('send') !!}
                </div>
            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Dokumen</h4><hr>
                            <div class="button-list">
                                <a class="btn btn-primary btn-flat" href="{{route('d-tambah')}}">
                                    <i class="fa fa-plus"></i>&nbsp; Tambah Dokumen</a>
                                <a class="btn btn-primary btn-flat" href="{{route('d-print-all')}}">
                                    <i class="fa fa-print"></i>&nbsp;Print All</a>
                                <button type="button" data-target="#raw" class="btn btn-primary btn-flat" data-toggle="modal" data-placement="top">
                                    <i class="fa fa-send"></i> Kirim
                                </button>
                            </div>
                            <div class="card col-md-12 ">
                                <div class="button-list">
                                    <div class="row form-group">
                                        <div class="col-md-5">
                                            <label for="from_surat">Filter Tanggal File/Dicatat</label>
                                            <input type="text" name="from_surat" id="from_surat" class="form-control input-sm input-date" placeholder="filter tanggal file/dicatat.." readonly/>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="kategori">Filter Kategori</label>
                                            <select class="form-control custom-select form-control-sm" id="kategori" name="kategori" readonly>
                                                <option readonly selected>filter kategori dokumen..</option>
                                                @foreach(\App\KategoriDokumen::all() as $kat)
                                                    <option value="{{$kat->nama_kategori}}" readonly>{{$kat->nama_kategori}}</option>
                                                @endforeach
                                            </select>
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
                                        <th>Nama File</th>
                                        <th>Kategori</th>
                                        <th>Tanggal File</th>
                                        <th>Tanggal Dicatat</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $dokumenV as $index => $value )
                                        <tr>
                                            <th>{{$index +1}}</th>
                                            <th>{{$value->nama_dokumen}}</th>
                                            <th>{{$value->kategori->nama_kategori}}</th>
                                            <th>{{ strftime("%d %B %Y", strtotime($value->tgl_file)) }}</th>
                                            <th>{{ strftime("%d %B %Y", strtotime($value->tgl_dicatat)) }}</th>
                                            <th>{{$value->keterangan}}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-deleteDokumen-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    {{--<button data-target="#test{{$value->id}}" type="submit" class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat" data-id="pegawaiId">--}}
                                                        {{--<i class="fa fa-eye"></i> Lihat--}}
                                                    {{--</button>--}}
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat lihat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-dokumen-edit" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print" onclick="sendDokumen('{{$value->id}}')">
                                                        <i class="fa fa-send"></i> Kirim
                                                    </button>
                                                    <button onclick="deleteDataDokumen('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </div>
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
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    @include('pegawai.dokumen.d-send')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script>
        var id;
        var body = $('body');
        body.on('click','.sweet-dokumen-edit',function () {
            id=$(this).data('id');
            window.location='{{route('d-edit')}}'+'?id='+id;
        });

        body.on('click','.lihat',function () {
            id=$(this).data('id');
            window.location='{{route('d-show')}}'+'?id='+id;
        });

        function deleteDataDokumen(id) {
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
                $("#form-deleteDokumen-" + id).attr("action", "{{route('d-hapus', ["id" => ""])}}/" + id).submit()
            })
        }

        $("#kategori").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('.input-date').datepicker({
            todayBtn: 'linked',
            format: 'dd MM yyyy',
            autoclose: true
        }).on('changeDate', function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function (){
            $('#from_surat').val('');
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });

        function sendDokumen(id){
            $("#formDokumen input[name=id]").val(id);
            $("#sendDokumen").modal('show');
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