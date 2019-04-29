@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | JENIS SURAT')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen Jenis Surat</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manajemen Jenis Surat</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    @if(session()->has('sukses'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('sukses')}}
                        </div>
                    @elseif(session()->has('edit'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('edit')}}
                        </div>
                    @elseif(session()->has('hapus'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('hapus')}}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Jenis Surat</h4><hr>
                            <a class="btn btn-primary btn-flat" href="{{route('jsm-tambah')}}">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Jenis Surat</a>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jenis Surat</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jenisSurat as $index => $value)
                                        <tr>
                                            <th>{{ $index +1 }}</th>
                                            <th>{{ $value->nama_jenis_surat }}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-delete-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat lihat" data-toggle="tooltip" data-placement="top" title="Lihat">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-message-edit" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button id="delete" onclick="deleteData('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-trash"></i> Hapus
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
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        var id;
        $('body').on('click','.sweet-message-edit',function () {
            id=$(this).data('id');
            swal({
                title: "Edit data terpilih?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: true
            },function (isConfirm){

                if (isConfirm){
                  window.location='{{route('jsm-edit')}}'+'?id='+id;
                }
            })
        });

        $('body').on('click','.lihat',function () {
            id=$(this).data('id');
            window.location='{{route('jsm-show')}}'+'?id='+id;
        });

        function deleteData(id) {
            swal({
                    title: "Hapus data terpilih?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: false,
                    closeOnCancel: true
            }, function(){
                    $("#form-delete-" + id).attr("action", "{{route('jsm-hapus', ["id" => ""])}}/" + id).submit()
                })
        }
    </script>
@endsection