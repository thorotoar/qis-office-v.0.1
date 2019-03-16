@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | EDIT DATA PEGAWAI')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Pegawai</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Data Pegawai</a></li>
                    <li class="breadcrumb-item active">Data Pegawai</li>
                </ol>
            </div>
        </div>'
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('pendidikan'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('pendidikan')}}
                        </div>
                    </div>
                </div>
            @elseif(count($errors)>0)
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
                                <form id="form-editPendidikan" action="{{route('u-d-p-pegawai')}}" method="post">
                                    {{csrf_field()}}
                                    {{--Pendidikan Info--}}
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3 class="card-title m-t-15">Info Riwayat Pendidikan</h3>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Pegawai</label>
                                                <input type="text" class="form-control" name="nama" value="{{App\Pegawai::find($rpegawai->pegawai_id)->nama}}" readonly>
                                                <input type="hidden" name="id" value="{{$rpegawai->id}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="bank">Jenjang Terakhir <span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control custom-select" id="bank" name="jenjang" required>
                                                        <option value="{{$rpegawai->jenjang_id}}">{{App\Jenjang::find($rpegawai->jenjang_id)->nama_jenjang}}</option>
                                                            @foreach($jenjang as $jenjangs)
                                                            <option value="{{$jenjangs->id}}">{{$jenjangs->nama_jenjang}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Instansi </label>
                                                <input type="text" class="form-control" name="instansi" value="{{$rpegawai->instansi}}" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tahun Lulus <span class="text-danger">*</span></label>
                                                <input type="text" class="yearpicker form-control" name="thn_lulus" value="{{$rpegawai->thn_lulus}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan</label>
                                                <div>
                                                    <select class="form-control custom-select" id="jurusan" name="jurusan">
                                                        <option value="{{$rpegawai->jurusan_id}}">{{App\JurusanPendidikan::find($rpegawai->jurusan_id)->nama_jurusan_pendidikan}}</option>
                                                        @foreach($jurusan as $jurusan)
                                                            <option value="{{$jurusan->id}}">{{$jurusan->nama_jurusan_pendidikan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--Button--}}
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <button id="editPendidikan" type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-primary">Clear</button>
                                                <a href="{{route('d-pegawai')}}" class="btn btn-dark">Cancel</a>
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
        var fForm = $('#form-editPendidikan');
        var fConfirm = $('button#editPendidikan');

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
        })
    </script>
@endsection