@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | MANAJEMEN KEBUTUHAN KHUSUS')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Manajemen Kebutuhan Khusus</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Manajemen Kebutuhan Khusus</li>
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
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Kebutuhan Khusus</h4><hr>
                            <a class="btn btn-primary btn-flat" href="{{route('keb-tambah')}}">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Kebutuhan Khusus</a>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Kebutuhan Khusus</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($kk as $index => $value)
                                        @php
                                            $kodeKeb = $value->kode_kebutuhan;
                                            $namaKeb = $value->nama_kebutuhan;
                                            $created = $value->created_by == null ? '-' : $value->created_by;
                                            $updated = $value->updated_by == null ? '-' : $value->updated_by;
                                        @endphp
                                        <tr>
                                            <th>{{ $index +1 }}</th>
                                            <th>{{ ucfirst($value->kode_kebutuhan) }}</th>
                                            <th>{{ ucfirst($value->nama_kebutuhan) }}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-delete-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat"
                                                            onclick="lihatKebutuhan('{{$value->id}}', '{{$kodeKeb}}', '{{$namaKeb}}', '{{$created}}', '{{$updated}}')">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-jabatan-edit" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button id="delete" onclick="deleteDataJabatan('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
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
    @include('admin.keb-management.keb-show')
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        var id;
        $('body').on('click','.sweet-jabatan-edit',function () {
            id=$(this).data('id');
            window.location='{{route('keb-edit')}}'+'?id='+id;
        });

        function lihatKebutuhan(id, kodeKeb, namaKeb, created, updated) {
            $("#kodeKeb").text(kodeKeb);
            $("#namaKeb").text(namaKeb);
            $("#created").text(created);
            $("#updated").text(updated);
            $("#modalKebutuhan").modal('show');
        }

        function deleteDataJabatan(id) {
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
                $("#form-delete-" + id).attr("action", "{{route('keb-hapus', ["id" => ""])}}/" + id).submit()
            })
        }
    </script>
    <!-- End Page wrapper  -->
@endsection