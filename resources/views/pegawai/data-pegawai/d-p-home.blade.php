@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | DATA PEGAWAI')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper" xmlns="http://www.w3.org/1999/html">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Pegawai</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data Pegawai</li>
                </ol>
            </div>
        </div>
        <!-- End Bread crumb -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            @if(session()->has('pegawai'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('pegawai')}}
                        </div>
                    </div>
                </div>
            @elseif(session()->has('sukses'))
                <div class="alert alert-info alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{session()->get('sukses')}}
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
            @elseif(session()->has('pendidikan'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('pendidikan')}}
                        </div>
                    </div>
                </div>
            @elseif(session()->has('update_r'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{session()->get('update_r')}}
                        </div>
                    </div>
                </div>
            @endif
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Data Pegawai</h4><hr>
                            <div class="button-list">
                                <a class="btn btn-primary btn-flat" href="{{route('d-p-tambah')}}">
                                    <i class="fa fa-plus"></i>&nbsp;Tambah Data Pegawai</a>
                                <a class="btn btn-primary btn-flat" href="{{route('d-p-print-all')}}">
                                    <i class="fa fa-print"></i>&nbsp;Print All</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat" onclick="getPegawai()"><i
                                            class="fa fa-sync"></i></a>
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
                                        <th width="50px">No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>TTL</th>
                                        <th>Lembaga</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pegawai_view as $index => $value)
                                        @php
                                            //$pegawai = App\Pegawai::find($value->pegawai_id); //$pegawai->foto
                                            $img = $value->foto == null ? asset('images/icon/no.png') : asset($value->foto);
                                            $nama = $value->nama;
                                            $type = ucwords($value->user->type);
                                            $nik = $value->nik == null ? '-' : $value->nik;
                                            $nip = $value->nip == null ? '-' : $value->nip;
                                            $ttl = $value->tempat_lahir . ', ' . $value->tgl_lahir;
                                            $kelamin = $value->kelamin;
                                            $agama = $value->agama->nama_agama;
                                            $telp = $value->telpon;
                                            $email = $value->email;
                                            $negara = $value->kewarganegaraan->nama_negara;
                                            $status = $value->status_pernikahan;
                                            $alamat = $value->alamat;
                                            $noRek = $value->no_rek == null ? '-' : $value->no_rek;
                                            $bank = $value->bank_id == null ? '-' : $value->bank_id;
                                            $kcpBank = $value->kcp_bank == null ? '-' : $value->kcp_bank;

                                            $nikA = $value->nik_ayah;
                                            $namaA = $value->ayah;
                                            $nikI = $value->nik_ibu;
                                            $namaI = $value->ibu;
                                            $namaP = $value->pasangan == null ? '-' : $value->pasangan;
                                            $pekerjaanP = $value->pekerjaan_pasangan == null ? '-' : $value->pekerjaan_pasangan;

                                            $nuptk = $value->nuptk == null ? '-' : $value->nuptk;
                                            $sk = $value->no_sk == null ? '-' : $value->no_sk;
                                            $tglM = $value->tgl_masuk;
                                            $jabatanY = $value->jabatanYayasan == null ? '-' : $value->jabatanYayasan->nama_jabatan_yayasan;
                                            $jabatan = $value->jabatan == null ? '-' : $value->jabatan->nama_jabatan;
                                            $lembaga = $value->lembaga->nama_lembaga;
                                            $jenjangT = $value->jenjang == null ? '-' : $value->jenjang->nama_jenjang;
                                            $thnLulus = $value->thn_lulus == null ? '-' : $value->thn_lulus;
                                            $instansi = $value->instansi;
                                            $jurusan = $value->jurusan == null ? '-' : $value->jurusan->nama_jurusan_pendidikan;

                                            $created = $value->created_by == null ? '-' : $value->created_by;
                                            $updated = $value->updated_by == null ? '-' : $value->updated_by;
                                        @endphp
                                        <tr>
                                            <th>{{ $index +1 }}</th>
                                            <th>@if($value->foto == null)
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
                                                    <form id="form-deletePegawai-{{$value->id}}" class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                            data-placement="top" title="Lihat" onclick="lihatPegawai('{{$value->id}}','{{$img}}', '{{$nama}}', '{{$nik}}', '{{$nip}}', '{{$ttl}}',
                                                            '{{$kelamin}}', '{{$agama}}', '{{$telp}}', '{{$email}}', '{{$negara}}', '{{$status}}', '{{$alamat}}',
                                                            '{{$noRek}}', '{{$bank}}', '{{$kcpBank}}', '{{$nikA}}', '{{$namaA}}', '{{$nikI}}', '{{$namaI}}', '{{$namaP}}', '{{$pekerjaanP}}',
                                                            '{{$nuptk}}', '{{$sk}}', '{{$tglM}}', '{{$jabatanY}}', '{{$jabatan}}', '{{$lembaga}}', '{{$jenjangT}}', '{{$thnLulus}}', '{{$instansi}}',
                                                            '{{$jurusan}}', '{{$created}}', '{{$updated}}')">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-pegawai-edit" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}" class="btn btn-sm btn-rounded btn-primary btn-flat sweet-print" data-toggle="tooltip" data-placement="top" title="Print">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
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

    <!-- Show a modal  -->
    @include('pegawai.data-pegawai.d-p-show')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        var id;
        var body = $('body');
        body.on('click','.sweet-pegawai-edit',function () {
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
                    window.location='{{route('d-p-edit')}}'+'?id='+id;
                }
            })
        });

        function lihatPegawai(id, img, nama, nik, nip, ttl, kelamin, agama, telp, email, negara, status, alamat, noRek, bank, kcpBank, nikA,
                              namaA, nikI, namaI, namaP, pekerjaanP, nuptk, sk, tglM, jabatanY, jabatan, lembaga, jenjangT, thnLulus, instansi, jurusan, created, updated) {
            $("#carousel-thumb img").attr('src', img);
            $("#nama").text(nama);
            $("#nik").text(nik);
            $("#nip").text(nip);
            $("#ttl").text(ttl);
            $("#jk").text(kelamin);
            $("#agama").text(agama);
            $("#telp").text(telp);
            $("#email").text(email);
            $("#negara").text(negara);
            $("#alamat").text(alamat);
            $("#statusH").text(status);
            $("#noRek").text(noRek);
            $("#bank").text(bank);
            $("#kcpBank").text(kcpBank);
            $("#nikA").text(nikA);
            $("#namaA").text(namaA);
            $("#nikI").text(nikI);
            $("#namaI").text(namaI);
            $("#namaP").text(namaP);
            $("#pekerjaanP").text(pekerjaanP);
            $("#nuptk").text(nuptk);
            $("#sk").text(sk);
            $("#tglM").text(tglM);
            $("#jabatanY").text(jabatanY);
            $("#jabatan").text(jabatan);
            $("#lembagaP").text(lembaga);
            $("#jenjangT").text(jenjangT);
            $("#thnLulus").text(thnLulus);
            $("#instansi").text(instansi);
            $("#jurusan").text(jurusan);
            $("#created").text(created);
            $("#updated").text(updated);
            $("#modalPegawai").modal('show');
        }

        function getPegawai() {
            swal({
                    title: "Tambahkan Pegawai?",
                    text: "Data pegawai dari setiap lembaga akan ditambahkan !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya, tambahkan !!",
                    closeOnConfirm: false
                },function (isConfirm){
                if (isConfirm){
                    window.location='{{route('get.pegawai')}}';
                }
            });
            return false;
        }

        body.on('click','.sweet-print',function () {
            id=$(this).data('id');
            window.location='{{route('d-p-print')}}'+'?id='+id;
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
                $("#form-deletePegawai-" + id).attr("action", "{{route('h-d-p-pegawai', ["id" => ""])}}/" + id).submit()
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