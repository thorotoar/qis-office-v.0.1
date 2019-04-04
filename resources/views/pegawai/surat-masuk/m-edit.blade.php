@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | EDIT SURAT MASUK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Surat Masuk</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Surat Masuk</a></li>
                    <li class="breadcrumb-item active">Surat Masuk</li>
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
                                <form id="form-editSuratMasuk" action="{{route('surm-update', $suratM->id)}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    {{--surat masuk--}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nomor Surat <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="no_surat" value="{{$suratM->no_surat}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Diterima <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control"  name="tgl_diterima" value="{{$suratM->tgl_diterima}}" placeholder="bulan/tanggal/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Pengirim <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="pengirim" value="{{$suratM->pengirim}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="status">Upload File Surat Masuk</label><b> (<i>{{$suratM->upload_file}}</i>)</b><input type="hidden" value="{{$suratM->upload_file}}" name="upload_file">
                                                <div>
                                                    <input type="file" name="upload_file_new" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Dicatat <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input type="text" class="form-control" name="tgl_dicatat" value="{{$suratM->tgl_dicatat}}" placeholder="bulan/tanggal/tahun" required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Penerima <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="penerima" value="{{$suratM->penerima}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Prihal</label>
                                                <textarea name="prihal" class="form-control" cols="30" rows="10">{{$suratM->prihal}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Button--}}
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <button id="editSuratMasuk" type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-primary">Clear</button>
                                                <a href="{{route('surm-home')}}" class="btn btn-dark">Cancel</a>
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

    <script>
        var fForm = $('#form-editSuratMasuk');
        var fConfirm = $('button#editSuratMasuk');

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
            format: "mm/dd/yyyy",
            todayBtn: 'linked',
            autoclose: true
        });
    </script>
@endsection