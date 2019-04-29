@extends('layout-master.app-pegawai')
@section('title', 'QIS OFFICE | DATA PESERTA DIDIK')

@section('content')
    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-primary">Data Peserta Didik</h3></div>
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
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{session()->get('sukses')}}
                        </div>
                    </div>
                </div>
            @elseif(session()->has('destroy'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{session()->get('destroy')}}
                        </div>
                    </div>
                </div>
            @elseif(session()->has('edit'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
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
                            <h4 class="card-title">Daftar Peserta Didik</h4>
                            <hr>
                            <div class="button-list">
                                <a class="btn btn-primary btn-flat" href="{{route('p-tambah')}}">
                                    <i class="fa fa-plus"></i>&nbsp;Tambah Peserta Didik</a>
                                <a class="btn btn-primary btn-flat" href="{{route('p-print-all')}}">
                                    <i class="fa fa-print"></i>&nbsp;Print All</a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-flat" onclick="getSiswa()"><i
                                            class="fa fa-refresh"></i></a>
                            </div>
                            <div class="card col-md-12 ">
                                <div class="button-list">
                                    <div class="row form-group">
                                        <div class="col-md-5">
                                            <label for="lembaga">Filter Lembaga</label>
                                            <select class="form-control custom-select form-control-sm" id="lembaga"
                                                    name="lembaga" readonly>
                                                <option readonly selected>filter nama lembaga...</option>
                                                @foreach(\App\Lembaga::where('id', '!=', 1)->get() as $lemb)
                                                    <option value="{{$lemb->nama_lembaga}}"
                                                            readonly>{{$lemb->nama_lembaga}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="kelamin">Filter Jenis Kelamin</label>
                                            <select class="form-control custom-select form-control-sm" id="kelamin"
                                                    name="kelamin" readonly>
                                                <option readonly selected>filter jenis kelamin..</option>
                                                <option value="Laki-laki" readonly>Laki-laki</option>
                                                <option value="Perempuan" readonly>Perempuan</option>
                                            </select>
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
                                        @php
                                        $img = $value->foto == null ? asset('images/icon/no.png') : asset($value->foto);
                                        $nama = $value->nama;
                                        $nik = $value->nik == null ? '-' : $value->nik;
                                        $nisn = $value->nisn == null ? '-' : $value->nisn;
                                        $ttl = $value->tempat_lahir . ', ' . $value->tgl_lahir;
                                        $kelamin = $value->kelamin;
                                        $agama = $value->agama->nama_agama;
                                        $telp = $value->telpon_rumah == null ? '-' : $value->telpon_rumah;
                                        $hp = $value->telpon_selular == null ? '-' : $value->telpon_selular;
                                        $email = $value->email == null ? '-' : $value->email;
                                        $negara = $value->kewarganegaraan == null ? '-' : $value->kewarganegaraan->nama_negara;
                                        $kebutuhan = $value->kebutuhanKhusus == null ? '-' : $value->kebutuhanKhusus->nama_kebutuhan;
                                        $alamat = $value->alamat;
                                        $rt = $value->rt == null ? '-' : $value->rt;
                                        $rw = $value->rw == null ? '-' : $value->rw;
                                        $dusun = $value->nama_dusun == null ? '-' : $value->nama_dusun;
                                        $desa = $value->desa;
                                        $provinsi = $value->provinsi == null ? '-' : $value->provinsi->nama_provinsi;
                                        $kabupaten = $value->kabupaten == null ? '-' : $value->kabupaten->nama_kabupaten;
                                        $kecamatan = $value->kecamatan == null ? '-' : $value->kecamatan->nama_kecamatan;
                                        $kodePos = $value->kode_pos == null ? '-' : $value->kode_pos;
                                        $jenisTinggal = $value->jenis_tinggal == null ? '-' : $value->jenis_tinggal;
                                        $trans = $value->transportasiPD == null ? '-' : $value->transportasiPD->nama_transportasi;
                                        $anak = $value->anak_ke == null ? '-' : $value->anak_ke;
                                        $kps = $value->kps;
                                        $noKps = $value->no_kps == null ? '-' : $value->no_kps;
                                        $pip = $value->pip;
                                        $kip = $value->kip;
                                        $kks = $value->no_kks == null ? '-' : $value->no_kks;
                                        $akta = $value->reg_akta == null ? '-' : $value->reg_akta;
                                        $lembaga = $value->lembaga != "" ? $value->lembaga->nama_lembaga : '-';
                                        $namaAyah = $value->nama_ayah == null ? '-' : $value->nama_ayah;
                                        $nikAyah = $value->nik_ayah == null ? '-' : $value->nik_ayah;
                                        $lahirAyah = $value->tahun_lahir_ayah == null ? '-' : $value->tahun_lahir_ayah;
                                        $jejangAyah = $value->jenjangPendidikanA == null ? '-' : $value->jenjangPendidikanA->nama_jenjang;
                                        $pekerjaanAyah = $value->pekerjaan_ayah == null ? '-' : $value->pekerjaan_ayah;
                                        $penghasilanAyah = $value->penghasilanA == null ? '-' : $value->penghasilanA->jumlah_penghasilan;
                                        $kebutuhanAyah = $value->kebutuhanKhususA == null ? '-' : $value->kebutuhanKhususA->nama_kebutuhan;

                                        $namaIbu = $value->nama_ibu == null ? '-' : $value->nama_ibu;
                                        $nikIbu = $value->nik_ibu == null ? '-' : $value->nik_ibu;
                                        $lahirIbu = $value->tahun_lahir_ibu == null ? '-' : $value->tahun_lahir_ibu;
                                        $jejangIbu = $value->jenjangPendidikanI == null ? '-' : $value->jenjangPendidikanI->nama_jenjang;
                                        $pekerjaanIbu = $value->pekerjaan_ibu == null ? '-' : $value->pekerjaan_ibu;
                                        $penghasilanIbu = $value->penghasilanI == null ? '-' : $value->penghasilanI->jumlah_penghasilan;
                                        $kebutuhanIbu = $value->kebutuhanKhususI == null ? '-' : $value->kebutuhanKhususI->nama_kebutuhan;

                                        $namaWali = $value->nama_wali == null ? '-' : $value->nama_wali;
                                        $nikWali = $value->nik_wali == null ? '-' : $value->nik_wali;
                                        $lahirWali = $value->tahun_lahir_wali == null ? '-' : $value->tahun_lahir_wali;
                                        $jejangWali = $value->jenjangPendidikanW == null ? '-' : $value->jenjangPendidikanW->nama_jenjang;
                                        $pekerjaanWali = $value->pekerjaan_wali == null ? '-' : $value->pekerjaan_wali;
                                        $penghasilanWali = $value->penghasilanW == null ? '-' : $value->penghasilanW->jumlah_penghasilan;
                                        @endphp
                                        <tr>
                                            <th>{{ $index +1 }}</th>
                                            <th>@if($value->foto === null)
                                                    <img src="{{asset('images/icon/no3x4.png')}}" width="84"
                                                         height="112">
                                                @else
                                                    <img src="{{asset($value->foto)}}" width="84" height="112">
                                                @endif</th>
                                            <th>{{ $value->nama }}</th>
                                            <th>{{ $value->kelamin }}</th>
                                            <th>{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}</th>
                                            <th>{{ $value->lembaga != "" ? $value->lembaga->nama_lembaga : '-'}}</th>
                                            <th>
                                                <div class="table-data-feature">
                                                    <form id="form-deletePeserta-{{$value->id}}"
                                                          class="form-group pull-left" action="" method="post" hidden>
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        {{--onclick="return confirm('Hapus data terpilih?')"--}}
                                                    </form>
                                                    <button class="btn btn-sm btn-rounded btn-primary btn-flat"
                                                            data-placement="top" title="Lihat" onclick="lihatPeserta('{{$value->id}}','{{$img}}', '{{$nama}}', '{{$nik}}', '{{$nisn}}', '{{$ttl}}',
                                                            '{{$kelamin}}', '{{$agama}}', '{{$telp}}', '{{$hp}}', '{{$email}}', '{{$negara}}', '{{$kebutuhan}}', '{{$alamat}}',
                                                            '{{$rt}}', '{{$rw}}', '{{$dusun}}', '{{$desa}}', '{{$provinsi}}', '{{$kabupaten}}', '{{$kecamatan}}', '{{$kodePos}}', '{{$jenisTinggal}}',
                                                            '{{$trans}}', '{{$anak}}', '{{$kps}}', '{{$noKps}}', '{{$pip}}', '{{$kip}}', '{{$kks}}', '{{$akta}}', '{{$lembaga}}',
                                                            '{{$namaAyah}}' , '{{$nikAyah}}' , '{{$lahirAyah}}' , '{{$jejangAyah}}' , '{{$pekerjaanAyah}}' , '{{$penghasilanAyah}}' , '{{$kebutuhanAyah}}',
                                                            '{{$namaIbu}}' , '{{$nikIbu}}' , '{{$lahirIbu}}' , '{{$jejangIbu}}' , '{{$pekerjaanIbu}}' , '{{$penghasilanIbu}}' , '{{$kebutuhanIbu}}',
                                                            '{{$namaWali}}' , '{{$nikWali}}' , '{{$lahirWali}}' , '{{$jejangWali}}' , '{{$pekerjaanWali}}' , '{{$penghasilanWali}}')">
                                                        <i class="fa fa-eye"></i> Lihat
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}"
                                                            class="btn btn-sm btn-rounded btn-primary btn-flat sweet-peserta-edit"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" data-id="{{$value->id}}"
                                                            class="btn btn-sm btn-rounded btn-primary btn-flat sweet-print"
                                                            data-toggle="tooltip" data-placement="top" title="Print">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                    <button onclick="deleteDataPeserta('{{$value->id}}')" type="submit"
                                                            class="btn btn-sm btn-rounded btn-danger btn-flat"
                                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                    <a href="{{route('p-nilai', $value->id)}}" class="btn btn-sm btn-rounded btn-warning btn-flat"
                                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa fa-clipboard"></i> Nilai
                                                    </a>
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
    @include('pegawai.peserta.p-show')
    <!-- End Page wrapper  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>

    <script>
        function lihatPeserta(id, img, nama, nik, nisn, ttl, kelamin, agama, telp, hp, email, negara, kebutuhan, alamat, rt, rw, dusun, desa,
                              provinsi, kabupaten, kecamatan, kodePos, jenisTinggal, trans, anak, kps, noKps, pip, kip, kks, akta, lembaga,
                              namaAyah, nikAyah, lahirAyah, jejangAyah, pekerjaanAyah, penghasilanAyah, kebutuhanAyah,
                              namaIbu, nikIbu, lahirIbu, jejangIbu, pekerjaanIbu, penghasilanIbu, kebutuhanIbu,
                              namaWali, nikWali, lahirWali, jejangWali, pekerjaanWali, penghasilanWali) {
            $("#carousel-thumb img").attr('src', img);
            $("#nama").text(nama);
            $("#nik").text(nik);
            $("#nisn").text(nisn);
            $("#ttl").text(ttl);
            $("#jk").text(kelamin);
            $("#agama").text(agama);
            $("#telp").text(telp);
            $("#hp").text(hp);
            $("#email").text(email);
            $("#negara").text(negara);
            $("#kebutuhan").text(kebutuhan);
            $("#alamat").text(alamat);
            $("#rt").text(rt);
            $("#rw").text(rw);
            $("#dusun").text(dusun);
            $("#desa").text(desa);
            $("#provinsi").text(provinsi);
            $("#kabupaten").text(kabupaten);
            $("#kecamatan").text(kecamatan);
            $("#kodePos").text(kodePos);
            $("#jenisTinggal").text(jenisTinggal);
            $("#trans").text(trans);
            $("#anak").text(anak);
            $("#kps").text(kps);
            $("#noKps").text(noKps);
            $("#pip").text(pip);
            $("#kip").text(kip);
            $("#kks").text(kks);
            $("#akta").text(akta);
            $("#lemb").text(lembaga);
            $("#namaAyah").text(namaAyah);
            $("#nikAyah").text(nikAyah);
            $("#lahirAyah").text(lahirAyah);
            $("#jA").text(jejangAyah);
            $("#pA").text(pekerjaanAyah);
            $("#penghasilanAyah").text(penghasilanAyah);
            $("#kebutuhanAyah").text(kebutuhanAyah);
            $("#namaIbu").text(namaIbu);
            $("#nikIbu").text(nikIbu);
            $("#lahirIbu").text(lahirIbu);
            $("#jI").text(jejangIbu);
            $("#pI").text(pekerjaanIbu);
            $("#penghasilanIbu").text(penghasilanIbu);
            $("#kebutuhanIbu").text(kebutuhanIbu);
            $("#namaWali").text(namaWali);
            $("#nikWali").text(nikWali);
            $("#lahirWali").text(lahirWali);
            $("#jW").text(jejangWali);
            $("#pW").text(pekerjaanWali);
            $("#penghasilanWali").text(penghasilanWali);
            $("#modalPeserta").modal('show');
        }

        var id;
        var body = $('body');
        body.on('click', '.sweet-peserta-edit', function () {
            id = $(this).data('id');
            swal({
                title: "Edit data terpilih?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Iya",
                cancelButtonText: "Tidak",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {

                if (isConfirm) {
                    window.location = '{{route('p-edit')}}' + '?id=' + id;
                }
            })
        });

        body.on('click', '.sweet-print', function () {
            id = $(this).data('id');
            window.location = '{{route('p-print')}}' + '?id=' + id;
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
            }, function () {
                $("#form-deletePeserta-" + id).attr("action", "{{route('p-hapus', ["id" => ""])}}/" + id).submit()
            })
        }

        $("#kelamin").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $("#lembaga").on("change", function () {
            $("#myTable_filter input[type=search]").val($(this).val()).trigger('keyup');
        });

        $('#refresh').on("click", function () {
            $('#kelamin').prop('selectedIndex', 0);
            $('#lembaga').prop('selectedIndex', 0);
            $("#myTable_filter input[type=search]").val('').trigger('keyup');
        });

        {{--function getSiswa() {--}}
            {{--swal({--}}
                {{--title: 'Are you sure?',--}}
                {{--text: "You won't be able to revert this!",--}}
                {{--type: 'warning',--}}
                {{--showCancelButton: true,--}}
                {{--confirmButtonColor: '#fa5555',--}}
                {{--confirmButtonText: 'Yes!',--}}
                {{--showLoaderOnConfirm: true,--}}
                {{--allowOutsideClick: false--}}
            {{--}, function () {--}}
                {{--$.ajax({--}}
                    {{--url: "{{ route('get.siswa') }}",--}}
                    {{--type: "GET",--}}
                    {{--dataType: "JSON",--}}
                    {{--success: function (data) {--}}
                        {{--swal('Success!', 'Data peserta dari lembaga berhasil ditambahkan.', 'success');--}}
                    {{--},--}}
                    {{--error: function () {--}}
                        {{--swal('Error!', 'Terjadi suatu kesalahan! Silahkan refresh browser Anda.', 'error');--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}
            {{--return false;--}}
        {{--}--}}

        function getSiswa() {
            swal({
                    title: "Tambahkan Peserta Didik ?",
                    text: "Data peserta didik dari setiap lembaga akan ditambahkan !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya, tambahkan !!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: "{{ route('get.siswa') }}",
                        type: "GET",
                        dataType: "JSON",
                        success: function (data) {
                            swal('Success!', 'Data peserta dari lembaga berhasil ditambahkan.', 'success');
                        },
                        error: function () {
                            swal('Error!', 'Terjadi suatu kesalahan! Silahkan refresh browser Anda.', 'error');
                        }
                    });
                });

            return false;
        }
    </script>
@endsection