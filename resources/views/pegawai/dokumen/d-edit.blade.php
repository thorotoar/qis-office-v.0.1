@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | EDIT DOKUMEN')


@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Edit Dokumen</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dokumen</a></li>
                    <li class="breadcrumb-item active">Edit Dokumen</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('edit'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('edit') !!}
                </div>
            @elseif(count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                {!! $error !!}
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
                                <form id="form-editDokumen" action="{{route('d-update', $dokumen->id)}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Nama File <span class="text-danger">*</span></label>
                                                <input class="form-control input-sm" name="nama_dokumen" type="Text" value="{{$dokumen->nama_dokumen}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="kategori">Kategori Dokumen <span class="text-danger">*</span></label>
                                                <select class="form-control custom-select" id="kategori" name="kategori" required>
                                                    <option value="" disabled>Pilih Kategori Dokumen</option>
                                                    @foreach (\App\KategoriDokumen::all() as $value)
                                                        <option value="{{$value->id}}"
                                                                @if($value->id == $dokumen->kategori_id)
                                                                selected
                                                                @endif
                                                        >{{$value->nama_kategori}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tanggal File <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input autocomplete="off" type="text" class="form-control" name="tgl_file" placeholder="bulan/tanggal/tahun" value="{{$dokumen->tgl_file}}"  required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tanggal Dicatat <span class="text-danger">*</span></label>
                                                <div class="input-group date datepicker">
                                                    <input autocomplete="off" type="text" class="form-control" name="tgl_dicatat" placeholder="bulan/tanggal/tahun" value="{{$dokumen->tgl_dicatat}}"  required>
                                                    <div class="input-group-addon">
                                                        &nbsp;<button class="btn btn-flat btn-outline-dark" disabled><span class="fa fa-calendar"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <textarea class="form-control input-sm" rows="10" name="keterangan" placeholder="">{{$dokumen->keterangan}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Tandai file yang ingin dhapus!</label><br>
                                                <div class="multipl-image-checkbox">
                                                    <ul>
                                                        @foreach($fileDok as $index => $value)
                                                            <li><input type="checkbox" id="cb{{$index +1}}" value="{{$value['id']}}" name="delete_file[]" />
                                                                <label for="cb{{$index +1}}">
                                                                    <img width="120px" src="{{strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "jpg" || strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "jpeg"|| strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "png" || strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "gif" ? asset($value['upload_file']) :  asset('images/icon/file.png')}}"><br>
                                                                    <small>{{substr(str_limit($value['title'], 18, '...'), 4)}}</small>
                                                                </label>
                                                            </li>

                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Upload File <span class="text-danger">*</span></label>
                                                <div>
                                                    <input name="upload_file[]" type="file" class="form-control input-sm" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button id="editDokumen" type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-primary">Clear</button>
                                                <a href="{{route('d-home')}}" class="btn btn-dark">Cancel</a>
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
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        var fForm = $('#form-editDokumen');
        var fConfirm = $('button#editDokumen');

        // fConfirm.on('click', function(e){
        //     e.preventDefault();
        //     swal({
        //             title: "Simpan perubahan?",
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
        // });

        fConfirm.on('click', function(){
            fForm.submit();
        });

        $('.datepicker').datepicker({
            format: "mm/dd/yyyy",
            todayBtn: 'linked',
            autoclose: true
        });
    </script>
@endsection