@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | LIHAT JENIS SURAT')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Lihat Jenis Surat</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Jenis Surat</a></li>
                    <li class="breadcrumb-item active">Lihat Jenis Surat</li>
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
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Isi Surat :</small><br>
                                                <div class="card card-body">{!! $js->template_konten !!}</div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--second tab-->
                            <div class="tab-pane" id="info" role="tabpanel"><br>
                                <div class="card-body"><div class="row">
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Nama Jenis Surat :</small><br>
                                                <strong><span>{{ $js->nama_jenis_surat }}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Kode Jenis Surat :</small><br>
                                                <strong><span><span>@if($js->kode_surat == null)
                                                                <span>-</span>
                                                            @endif{{ $js->kode_surat }}</span></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Template Jenis Surat :</small><br>
                                                <strong><span>{{ $js->template_surat }}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Yayasan/Lembaga Jenis Surat :</small><br>
                                                <strong><span>{{ $js->lembaga->nama_lembaga }}</strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Created By :</small><br>
                                                <strong><span>@if($js->created_by == null)
                                                            <span>-</span>
                                                        @endif{{$js->created_by}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Updated By :</small><br>
                                                <strong><span>@if($js->updated_by == null)
                                                            <span>-</span>
                                                        @endif{{$js->updated_by}}</span></strong>
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
@endsection