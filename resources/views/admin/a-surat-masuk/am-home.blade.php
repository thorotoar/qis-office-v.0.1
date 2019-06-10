@extends('layout-master.app-admin')
@section('title', 'QIS ADMIN | SURAT MASUK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Surat Masuk</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Surat Masuk</li>
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
            @elseif(session()->has('send'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('send') !!}
                </div>
        @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Surat Masuk</h4><hr>
                            <div class="card col-md-12 ">
                                <div class="button-list">
                                    <div class="row form-group">
                                        <div class="col-md-10">
                                            <label for="from_surat">Filter Tanggal Diterima/Dicatat</label>
                                            <input type="text" name="from_surat" id="from_surat" class="form-control input-sm input-date" placeholder="filter tanggal diterima/dicatat.." readonly/>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="refresh" style="height: 70%"></label>
                                            <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="80px">No</th>
                                        <th>Nomor Surat</th>
                                        <th>Diterima</th>
                                        <th>Dicatat</th>
                                        <th>Pengirim</th>
                                        <th>Prihal</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($smasukView as $index => $value)
                                        @php
                                        $img = substr($value->upload_file, '21');
                                        $noSM = $value->no_surat;
                                        $tglT = $value->tgl_diterima;
                                        $tglC = $value->tgl_dicatat;
                                        $pengirim = $value->pengirim;
                                        $penerima = $value->penerima;
                                        $prihal = $value->prihal;
                                        $created = $value->created_by == null ? '-' : $value->created_by;
                                        $updated = $value->updated_by == null ? '-' : $value->updated_by;
                                        @endphp
                                        <tr>
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ $value->no_surat }} </td>
                                            <td>{{ strftime("%d %B %Y", strtotime($value->tgl_diterima)) }}</td>
                                            <td>{{ strftime("%d %B %Y", strtotime($value->tgl_dicatat)) }}</td>
                                            <td>{{ $value->pengirim }}</td>
                                            <td>{{ $value->prihal }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <form id="form-deleteSuratMasuk-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="modal" data-placement="top" title="Lihat" onclick="lihatSurat('{{$value->id}}', '{{$img}}', '{{$noSM}}', '{{$tglT}}', '{{$tglC}}', '{{$pengirim}}', '{{$penerima}}', '{{$prihal}}', '{{$created}}' ,'{{$updated}}')">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-suratMasuk-edit" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <a href="/{{ $value->upload_file }}" download="{{ substr($value->upload_file, '17') }}" class="btn btn-sm btn-rounded btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Download">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                    <button onclick="deleteDataPegawai('{{$value->id}}')" type="submit" class="btn btn-sm btn-rounded btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </div>
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
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
    </div>
    @include('admin.a-surat-masuk.am-show')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/lib/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        var id;
        var body = $('body');
        body.on('click','.sweet-suratMasuk-edit',function () {
            id=$(this).data('id');
            window.location='{{route('a-surm-edit')}}'+'?id='+id;
        });

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
                $("#form-deleteSuratMasuk-" + id).attr("action", "{{route('a-surm-hapus', ["id" => ""])}}/" + id).submit()
            })
        }

        function lihatSurat(id, img, noSM, tglT, tglC, pengirim, penerima, prihal, created, updated){
            $("#img-masuk").text(img);
            $("#noSM").text(noSM);
            $("#tgl-diterima").text(tglT);
            $("#tgl-dicatat").text(tglC);
            $("#pengirim").text(pengirim);
            $("#penerima").text(penerima);
            $("#prihal").text(prihal);
            $("#created").text(created);
            $("#updated").text(updated);
            $("#modalSuratMasuk").modal('show');
        }

        $('.input-date').datepicker({
            todayBtn: 'linked',
            format: 'dd MM yyyy',
            autoclose: true
        }).on('changeDate', function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function (){
            $('#from_surat').val('');
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });
    </script>
@endsection