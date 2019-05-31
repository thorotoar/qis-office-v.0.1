@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | EDIT JADWAL PELAJARAN MOSLEM DAY CARE')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Edit Jadwal Peserta Didik</h3></div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Edit Jadwal Peserta Didik</a></li>
                    <li class="breadcrumb-item active">Jadwal Peserta Didik</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <div class="container-fluid">
                @if(session()->has('edit'))
                    <div class="alert alert-info alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{session('sukses')}}
                    </div>
                @elseif(session()->has('hapus'))
                    <div class="alert alert-info alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!! session('hapus') !!}
                    </div>
            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-elements">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Peserta Didik </label>
                                            <input type="text" class="form-control" value="{{$pes->nama}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status </label>
                                            <input type="text" class="form-control" value="{{ucfirst($pes->status)}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card card-outline-primary">
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th width="80px">No</th>
                                                        <th>Waktu Mulai</th>
                                                        <th>Waktu Akhir</th>
                                                        <th>Kegiatan</th>
                                                        <th>Ruangan</th>
                                                        <th>Keterangan</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($jadwal as $index => $value)
                                                        @php
                                                            $wm = $value->waktu_mulai;
                                                            $wa = $value->waktu_akhir;
                                                            $keg = $value->kegiatan;
                                                            $ru = $value->ruangan;
                                                            $ket = $value->keterangan;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$index +1}}</td>
                                                            <td>{{$value->waktu_mulai}}</td>
                                                            <td>{{$value->waktu_akhir}}</td>
                                                            <td>{{$value->kegiatan}}</td>
                                                            <td>{{$value->ruangan}}</td>
                                                            <td>{{$value->keterangan}}</td>
                                                            <td>
                                                                <form id="form-deleteJadwal-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                                    {{csrf_field()}} {{method_field('DELETE')}}
                                                                    {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                                </form>
                                                                <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                                        data-toggle="modal" data-placement="top" title="Edit Jadwal Pelajaran"
                                                                        onclick="lihatEditJadwal('{{$value->id}}', '{{$wm}}', '{{$wa}}', '{{$keg}}', '{{$ru}}', '{{$ket}}')">
                                                                    <i class="fa fa-eye"></i> Edit
                                                                </button>
                                                                <button onclick="deleteJadwal('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    </div>
    <!-- End Page wrapper  -->
    <!-- Modal Page wrapper  -->
    <div class="modal" id="modalJadwalEdit" tabindex="1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Jadwal Peserta Didik</strong></h5>
                    <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                        <i class="fa fa-close"></i> Close</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Edit Jadwal Monitoring Pengasuhan</h4>
                                </div>
                                <br>
                                <div class="card-body">
                                    <form action="{{route('mdc-update')}}" method="post" id="formJadwalMonitoring">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Waktu Mulai</th>
                                                <th>Waktu Akhir</th>
                                                <th>Kegiatan</th>
                                                <th>Ruangan</th>
                                                <th>Keterangan</th>
                                            </tr>
                                            </thead>
                                            <tbody id="editjadwal">
                                            <tr>
                                                <td><input id="wm" type="time" name="waktu_mulai" class="form-control" placeholder="Waktu Mulai" required autofocus></td>
                                                <td><input id="wa" type="time" name="waktu_akhir" class="form-control" placeholder="Waktu Akhir" required autofocus></td>
                                                <td><input id="keg" type="text" name="kegiatan" class="form-control" placeholder="Kegiatan" required autofocus></td>
                                                <td><input id="ru" type="text" name="ruangan" class="form-control" placeholder="Ruang" required autofocus></td>
                                                <td><input id="ket2" type="text" name="keterangan" class="form-control" placeholder="Keterangan" required autofocus></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        function lihatEditJadwal(id, wm, wa, keg, ru, ket) {
            $("#formJadwalMonitoring input[name=id]").val(id);
            $("#wm").val(wm);
            $("#wa").val(wa);
            $("#keg").val(keg);
            $("#ru").val(ru);
            $("#ket2").val(ket);
            $("#modalJadwalEdit").modal('show');
        }

        $('.datepicker').datepicker({
            format: "mm/dd/yyyy",
            todayBtn: 'linked',
            autoclose: true
        });

        function deleteJadwal(id) {
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
                $("#form-deleteJadwal-" + id).attr("action", "{{route('mdc-j-hapus', ["id" => ""])}}/" + id).submit()
            });
        }
    </script>
@endsection