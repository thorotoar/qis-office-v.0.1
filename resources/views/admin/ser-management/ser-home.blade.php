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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Template Sertifikat</li>
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

            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Template Sertifikat</h4><hr>
                            <div class="btn-list">
                                <a class="btn btn-primary btn-flat" href="{{route('ts-tambah')}}">
                                    <i class="fa fa-plus"></i>&nbsp;Ganti Template Sertifikat</a>
                                <a href="/images/sertifikat/s-depan.jpg" download="s-depan.jpg"
                                   class="btn btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Download">
                                    <i class="fa fa-download"></i> Download
                                </a>
                                <button type="button" data-target="#about" class="btn btn-primary btn-flat" data-toggle="modal" data-placement="top">
                                    <i class="fa fa-exclamation-circle"></i>
                                </button>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Template</th>
                                        <th>Tanggal Dicatat</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ser as $index => $value)
                                        @php
                                        $versi = $value->versi_sertifikat;
                                        $tgl = $value->tgl_dicatat;
                                        $created = $value->created_by == null ? '-' : $value->created_by;
                                        $img = $value->template_sertifikat == null ? asset('images/icon/no.png') : asset($value->template_sertifikat);
                                        @endphp
                                        <tr>
                                            <th>{{ ucwords($value->versi_sertifikat) }}</th>
                                            <th>{{ ucwords($value->tgl_dicatat) }}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat"
                                                            onclick="lihatSertifikat('{{$value->id}}', '{{$versi}}', '{{$tgl}}', '{{$created}}', '{{$img}}')">
                                                        <i class="fa fa-eye"></i> Lihat
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

    <!-- Show a modal  -->
    @include('admin.ser-management.ser-show')
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        function lihatSertifikat(id, versi, tgl, created, img) {
            $("#versiSer").text(versi);
            $("#tglSer").text(tgl);
            $("#createdSer").text(created);
            $("#carousel-thumb1 img").attr('src', img);
            $("#modalSertifikat").modal('show');
        }
    </script>
    <!-- End Page wrapper  -->
@endsection