@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | JENJANG')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen Jenjang</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manajemen Jenjang</li>
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
                            {!! session('sukses') !!}
                        </div>
                    @elseif(session()->has('edit'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {!! session('edit') !!}
                        </div>
                    @elseif(session()->has('hapus'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {!! session('hapus') !!}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Jenjang</h4><hr>
                            <a class="btn btn-primary btn-flat" href="{{route('jen-tambah')}}">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Jenjang</a>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jenjang</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jenjang as $index => $value)
                                        @php
                                        $namaJen = $value->nama_jenjang;
                                        $created = $value->created_by == null ? '-' : $value->created_by;
                                        $updated = $value->updated_by == null ? '-' : $value->updated_by;
                                        @endphp
                                        <tr>
                                            <th>{{ $index +1 }}</th>
                                            <th>{{ $value->nama_jenjang }}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-deleteJenjang-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat"
                                                            onclick="lihatJenjang('{{$value->id}}', '{{$namaJen}}', '{{$created}}', '{{$updated}}')">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-jenjang-edit" data-toggle="tooltip"
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

    <!-- Show a modal  -->
    @include('admin.jen-management.jen-show')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        var id;
        $('body').on('click','.sweet-jenjang-edit',function () {
            id=$(this).data('id');
            window.location='{{route('jen-edit')}}'+'?id='+id;
        });

        function lihatJenjang(id, namaJen, created, updated) {
            $("#namaJen").text(namaJen);
            $("#created").text(created);
            $("#updated").text(updated);
            $("#modalJenjang").modal('show');
        }

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
                    $("#form-deleteJenjang-" + id).attr("action", "{{route('jen-hapus', ["id" => ""])}}/" + id).submit()
                })
        }
    </script>
@endsection