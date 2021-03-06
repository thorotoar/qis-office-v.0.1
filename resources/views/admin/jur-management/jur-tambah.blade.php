@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | JURUSAN PENDIDIKAN')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen Jurusan Pendidikan</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Jurusan Pendidikan</a></li>
                    <li class="breadcrumb-item active">Manajemen Jurusan Pendidikan</li>
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
                                <form class="form-valide" action="{{route('jur-tambah-selesai')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="jurusan">Nama Jurusan <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan jurusan pendidikan..">
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary" id="add">Submit</button>
                                        <a href="{{route('jur-home')}}" class="btn btn-dark">Cancel</a>
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
    <script>
        var fForm = $('#form-add');
        var fConfirm = $('button#add');

        // fConfirm.on('click', function(){
        //     swal({
        //             title: "Tambahkan jenis surat?",
        //             type: "warning",
        //             showCancelButton: true,
        //             confirmButtonColor: "#DD6B55",
        //             confirmButtonText: "Iya",
        //             cancelButtonText: "Tidak",
        //             closeOnConfirm: false,
        //             closeOnCancel: true
        //         },
        //         function(){
        //             fForm.submit();
        //         });
        // })
    </script>
@endsection