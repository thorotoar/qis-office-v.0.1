@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | MANAJEMEN USER')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen User</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah User</a></li>
                    <li class="breadcrumb-item active">Manajemen User</li>
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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                {{ $error }}
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
                                <form class="form-valide" action="{{route('um-tambah-selesai')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="username">Username <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="username..">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-skill">Nama Pegawai <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <select class="form-control custom-select" id="nama-pegawai" name="id_pegawai">
                                                <option readonly="true" disabled>Pilih Pegawai</option>
                                                @foreach(App\Pegawai::all() as $item)
                                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="val-password" name="password" placeholder="password..">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-password">Confirm Password <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="val-password" name="cpassword" placeholder="confirm password..">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="hak-akses">Hak Akses <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <select class="form-control custom-select" id="hak-akses" name="hak_akses">
                                                <option value="" disabled readonly>Pilih hak akses</option>
                                                <option value="admin">Admin</option>
                                                <option value="pegawai">Pegawai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{route('um-home')}}" class="btn btn-dark">Cancel</a>
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
@endsection