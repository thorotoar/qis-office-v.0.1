@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | TEMPLATE SERTIFIKAT')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Template Sertifikat</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Template Sertifikat</a></li>
                    <li class="breadcrumb-item active">Template Sertifikat</li>
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
                                {!! $error !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- Start Page Content -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" action="{{route('ts-tambah-selesai')}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="versi">Versi Sertifikat <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="versi" name="versi" placeholder="Masukkan versi sertifikat" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="versi">Tanggal Dicatat <span class="text-danger">*</span></label>
                                        <div class="col-lg-6 input-group date datepicker">
                                            <input type="text" class="form-control " name="tgl_catat" placeholder="tanggal/bulan/tahun" required>
                                            <div class="input-group-addon">
                                                &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="versi">Template Sertifikat </label>
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="versi" name="file_sertifikat" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-primary">Clear</button>
                                            <a href="{{route('ts-home')}}" class="btn btn-dark">Cancel</a>
                                        </div>
                                    </div>
                                </form>
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
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $('.datepicker').datepicker({
            todayBtn: 'linked',
            format: "dd MM yyyy",
            autoclose: true

        });
    </script>
@endsection