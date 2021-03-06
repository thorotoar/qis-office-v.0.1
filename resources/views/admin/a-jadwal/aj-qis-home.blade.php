@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | JADWAL PELAJARAN QIS ENGLISH')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Jadwal Pelajaran QIS English</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Jadwal Pelajaran QIS English</li>
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
                    {{session()->get('edit')}}
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
                            <h4 class="card-title">Daftar Jadwal Pelajaran QIS English</h4><hr>
                            <div class="button-list">
                                <div class="card col-md-12 ">
                                    <div class="button-list">
                                        <div class="row form-group">
                                            <div class="col-md-10">
                                                <label for="status">Filter Tanggal Dicatat</label>
                                                <div class="input-group date">
                                                    <input type="text" class="form-control input-sm datepicker" name="tgl_dicatat" placeholder="bulan/tanggal/tahun" id="tanggal" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="refresh" style="height: 70%"></label>
                                                <button type="button" name="refresh" id="refresh"
                                                        class="btn btn-warning btn-sm">Refresh
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="80px">No</th>
                                        <th>Jadwal</th>
                                        <th>Tanggal Dicatat</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($peg as $index => $value)
                                        @php
                                        $tittle = $value->nama_jadwal;
                                        @endphp
                                        <tr >
                                            <th>{{ $index +1 }}</th>
                                            <th>{{ $value->nama_jadwal }}</th>
                                            <th>{{ $value->tgl_dicatat }}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-deleteSuratMasuk-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                            data-toggle="modal" data-placement="top" title="Lihat Jadwal Pelajaran"
                                                            onclick="lihatJadwal('{{$value->id}}', '{{$tittle}}')">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    {{--<a href="{{route('mdc-edit', ['id' => $value->id])}}" class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Edit">--}}
                                                        {{--<i class="fa fa-edit"></i> Edit--}}
                                                    {{--</a>--}}
                                                    <button onclick="deleteDataPegawai('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
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
    @include('pegawai.jadwal.qis-show')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        function lihatJadwal(id, title){
            $("#tittleABK").text(title);
            $.get('{{route('aj-modal-jadwal', ['id' => ''])}}/' + id, function (data) {
                var $content = '';
                $.each(data, function (i, val) {
                    var $i = i+1;
                    $content +=
                        '<tr>' +
                        '<td>'+$i+'</td>' +
                        '<td>'+val.hari+'</td>' +
                        '<td>'+val.waktu_mulai+'</td>' +
                        '<td>'+val.waktu_akhir+'</td>' +
                        '<td>'+val.kegiatan+'</td>' +
                        '<td>'+val.keterangan+'</td>' +
                        '</tr>';
                });
                $("#jadwal_table").html($content);
            });
            $("#modalJadwal").modal('show');
        }

        function deleteDataPegawai(id) {
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
                $("#form-deleteSuratMasuk-" + id).attr("action", "{{route('aj-hapus', ["id" => ""])}}/" + id).submit()
            })
        }

        $("#tanggal").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function () {
            $('#kebutuhan').prop('selectedIndex', 0);
            $('#status').prop('selectedIndex', 0);
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });

        $('.datepicker').datepicker({
            format: "dd MM yyyy",
            todayBtn: 'linked',
            autoclose: true
        });
    </script>
@endsection