@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | DATA PESERTA DIDIK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Peserta Didik</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data Peserta Didik</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('sukses'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('sukses')}}
                        </div>
                    </div>
                </div>
            @elseif(session()->has('destroy'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('destroy')}}
                        </div>
                    </div>
                </div>
            @elseif(session()->has('edit'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('edit')}}
                        </div>
                    </div>
                </div>
            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Peserta Didik</h4><hr>
                            <div class="button-list">
                                <a class="btn btn-primary btn-flat" href="{{route('p-tambah')}}">
                                    <i class="fa fa-plus"></i>&nbsp;Tambah Peserta Didik</a>
                                <a class="btn btn-primary btn-flat" href="{{route('p-print-all')}}">
                                    <i class="fa fa-print"></i>&nbsp;Print All</a>
                            </div>
                            <div class="card col-md-12 ">
                                <div class="button-list">
                                    <div class="row form-group">
                                        <div class="col-md-5">
                                            <label for="lembaga">Filter Lembaga</label>
                                            <select class="form-control custom-select form-control-sm" id="lembaga" name="lembaga" readonly>
                                                <option readonly selected>filter nama lembaga...</option>
                                                @foreach(\App\Lembaga::where('id', '!=', 1)->get() as $lemb)
                                                    <option value="{{$lemb->nama_lembaga}}" readonly>{{$lemb->nama_lembaga}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="kelamin">Filter Jenis Kelamin</label>
                                            <select class="form-control custom-select form-control-sm" id="kelamin" name="kelamin" readonly>
                                                <option readonly selected>filter jenis kelamin..</option>
                                                <option value="Laki-laki" readonly>Laki-laki</option>
                                                <option value="Perempuan" readonly>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="refresh" style="height: 70%"></label>
                                            <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>TTL</th>
                                        <th>Lembaga</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $pesertaDidik as $index => $value)
                                        <tr>
                                            <th>{{ $index +1 }}</th>
                                            <th>@if($value->foto === null)
                                                    <img src="{{asset('images/icon/no3x4.png')}}" width="84" height="112">
                                                @else
                                                    <img src="{{asset($value->foto)}}" width="84" height="112">
                                                @endif</th>
                                            <th>{{ $value->nama }}</th>
                                            <th>{{ $value->kelamin }}</th>
                                            <th>{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}</th>
                                            <th>{{ $value->lembaga->nama_lembaga }}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-deletePeserta-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button data-target="#test{{$value->id}}" type="submit" class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat" data-id="pegawaiId">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-peserta-edit" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-print" data-toggle="tooltip" data-placement="top" title="Print">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                    <button onclick="deleteDataPeserta('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </th>
                                            @include('pegawai.peserta.p-show')
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
        var body = $('body');
        body.on('click','.sweet-peserta-edit',function () {
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
                    window.location='{{route('p-edit')}}'+'?id='+id;
                }
            })
        });

        body.on('click','.sweet-print',function () {
            id=$(this).data('id');
            window.location='{{route('p-print')}}'+'?id='+id;
        });

        function deleteDataPeserta(id) {
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
                $("#form-deletePeserta-" + id).attr("action", "{{route('p-hapus', ["id" => ""])}}/" + id).submit()
            })
        }

        $("#kelamin").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $("#lembaga").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function (){
            $('#kelamin').prop('selectedIndex', 0);
            $('#lembaga').prop('selectedIndex', 0);
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });

    </script>
@endsection