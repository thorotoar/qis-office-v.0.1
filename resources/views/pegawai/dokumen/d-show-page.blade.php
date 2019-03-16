@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | LIHAT DOKUMEN')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Lihat Dokumen</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dokumen</a></li>
                    <li class="breadcrumb-item active">Lihat Dokumen</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#file" role="tab">File</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#info" role="tab">Info</a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="file" role="tabpanel">
                                <div class="card-body">
                                    <br><div class="row">
                                        <br>
                                        @foreach($fileDok as $index => $value)
                                            <div class="col-lg-2 col-md-6 m-b-20"><img class="img-responsive radius" src="{{strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "jpg" || strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "jpeg"|| strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "png" || strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "gif" ? asset($value['upload_file']) :  asset('images/icon/file1.png')}}"><br>
                                                <small>{{substr($value['title'], 2)}}</small><br>
                                                <button data-id="{{$value['id']}}" type="button" class="btn btn-sm btn-block btn-primary btn-flat download" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-download"></i> Download
                                                </button></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--second tab-->
                            <div class="tab-pane" id="info" role="tabpanel"><br>
                                <div class="card-body"><div class="row">
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Nama :</small><br>
                                                <strong><span>@if($dokumen->nama_dokumen == null)
                                                            <span>-</span>
                                                        @endif{{$dokumen->nama_dokumen}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Tanggal File :</small><br>
                                                <strong><span>@if($dokumen->tgl_file == null)
                                                            <span>-</span>
                                                        @endif{{$dokumen->tgl_file}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Tanggal Dicatat :</small><br>
                                                <strong><span>@if($dokumen->tgl_dicatat == null)
                                                            <span>-</span>
                                                        @endif{{$dokumen->tgl_dicatat}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Keterangan :</small><br>
                                                <strong><span>@if($dokumen->keterangan == null)
                                                            <span>-</span>
                                                        @endif{{$dokumen->keterangan}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Created By :</small><br>
                                                <strong><span>@if($dokumen->created_by == null)
                                                            <span>-</span>
                                                        @endif{{$dokumen->created_by}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Updated By :</small><br>
                                                <strong><span>@if($dokumen->updated_by == null)
                                                            <span>-</span>
                                                        @endif{{$dokumen->updated_by}}</span></strong>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>

            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        var fForm = $('#form-addDokumen');
        var fConfirm = $('button#addDokumen');

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

        var id;
        var body = $('body');

        body.on('click','.download',function () {
            id=$(this).data('id');
            window.location='{{route('d-download')}}'+'?id='+id;
        });
    </script>
@endsection