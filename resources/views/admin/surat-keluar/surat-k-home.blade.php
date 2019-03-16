@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | SURAT KELUAR')

@section('content')
    <head>
        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>
    </head>
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
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Surat Keluar</h4>
                            <div class="dropdown">
                                <button class="btn btn-primary btn-flat dropdown-toggle" type="button" data-toggle="dropdown">Tambah Surat Keluar&nbsp;
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Surat Pemberitahuan</a></li>
                                    <li><a href="#">Surat Penagihan</a></li>
                                    <li><a href="#">Surat Peringatan</a></li>
                                    <li><a href="#">Surat Pengajuan Dana</a></li>
                                    <li><a href="#">Surat Pengangkatan</a></li>
                                    <li><a href="#">Surat Keterangan Pengalaman</a></li>
                                    <li><a href="#">Surat Keputusan Instruktur</a></li>
                                    <li><a href="#">Surat Keputusan Penyusun Sylabus</a></li>
                                    <li><a href="#">Surat Keputusan Penyusun RPP</a></li>
                                </ul>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Diterima</th>
                                        <th>Asal</th>
                                        <th>Jenis Surat</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>1</th>
                                        <th>123</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <th>122</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <th>133</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <th>121</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <th>223</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <th>333</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <th>234</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>8</th>
                                        <th>333</th>
                                        <th>12 Juli 2018</th>
                                        <th>PT. Siap Techno</th>
                                        <th>Surat Penagihan</th>
                                        <th>
                                            <div class="table-data-feature">
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Kirim">
                                                    <i class="fa fa-send"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Print">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End PAge Content -->
            <div class="row">
                <h1>TinyMCE Quick Start Guide</h1>
                <form method="post">
                    <textarea id="mytextarea">Hello, World!</textarea>
                </form>
            </div>
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper  -->
@endsection