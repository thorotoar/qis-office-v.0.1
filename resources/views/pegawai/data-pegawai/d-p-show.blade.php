<div class="modal" id="modalPegawai" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Data Pegawai</strong></h5>
                <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <!--Carousel Wrapper-->
                        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" alt="First slide">
                                </div>
                            </div>
                        </div>
                        <!--/.Carousel Wrapper-->
                    </div>
                    <div class="col-lg-7">
                        <h2 class="h2-responsive product-name">
                            <strong id="nama"></strong>
                        </h2>
                        <h4 class="h4-responsive">
                            <span class="green-text">
                                    <button id="type" class="btn btn-sm btn-danger btn-flat btn-rounded disabled" disabled></button>
                            </span>
                        </h4>

                        <!--Accordion wrapper-->
                        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                            {{--info personal--}}
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 class="h2-responsive product-name">
                                            <strong>Info Personal</strong>
                                        </h6><hr>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">NIK :</small><br>
                                                <strong id="nik"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">NIP :</small><br>
                                                <strong id="nip"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">TTL :</small><br>
                                                <strong id="ttl"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Jenis Kelamin :</small><br>
                                                <strong id="kelamin"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Agama :</small><br>
                                                <strong id="agama"></strong>
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">No. Telp :</small><br>
                                                <strong id="telp"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Email :</small><br>
                                                <strong id="email"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Kewarganegaraan :</small><br>
                                                <strong id="negara"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Status Hubungan :</small><br>
                                                <strong id="statusH"></strong>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Alamat :</small><br>
                                                <strong id="alamat"></strong>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion wrapper -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    {{--info bank--}}
                                    <div class="col-md-3">
                                        <h6 class="h2-responsive product-name">
                                            <strong>Info Bank</strong>
                                        </h6><hr>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nomor Rekening :</small><br>
                                            <strong id="noRek"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Bank :</small><br>
                                            <strong id="bank"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">KCP Bank :</small><br>
                                            <strong id="kcpBank"></strong>
                                        </h6><hr>
                                    </div>

                                    {{--info keluarga--}}
                                    <div class="col-md-3">
                                        <h6 class="h2-responsive product-name">
                                            <strong>Info Keluarga</strong>
                                        </h6><hr>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK Ayah :</small><br>
                                            <strong id="nikA"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama Ayah :</small><br>
                                            <strong id="namaA"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK Ibu :</small><br>
                                            <strong id="nikI"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama Ibu :</small><br>
                                            <strong id="namaI"></strong>
                                        </h6><hr>
                                    </div>

                                    {{--info pasangan--}}
                                    <div class="col-md-3">
                                        <h6 class="h2-responsive product-name">
                                            <strong>Info Pasangan</strong>
                                        </h6><hr>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama Pasangan :</small><br>
                                            <strong id="namaP"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan Pasangan :</small><br>
                                            <strong id="pekerjaanP"></strong>
                                        </h6><hr>
                                    </div>

                                    {{--info kepegawaian--}}
                                    <div class="col-md-3">
                                        <h6 class="h2-responsive product-name">
                                            <strong>Info Kepegawaian</strong>
                                        </h6><hr>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NUPTK :</small><br>
                                            <strong id="nuptk"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">No. SK :</small><br>
                                            <strong id="sk"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tanggal Masuk :</small><br>
                                            <strong id="tglM"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jabatan Yayasan :</small><br>
                                            <strong id="jabatanY"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jabatan :</small><br>
                                            <strong id="jabatan"></strong>
                                        </h6>
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Lembaga :</small><br>
                                            <strong id="lembagaP"></strong>
                                        </h6><hr>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--info pendidikan--}}
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="h2-responsive product-name">
                                        <strong>Info Pendidikan</strong>
                                    </h6><hr>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang Terkhir :</small><br>
                                            <strong id="jenjangT"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lulus :</small><br>
                                            <strong id="thnLulus"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Instansi :</small><br>
                                            <strong id="instansi"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jurusan :</small><br>
                                            <strong id="jurusan"></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Dimasukkan oleh :</small><br>
                                            <strong id="created"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Diubah oleh :</small><br>
                                            <strong id="updated"></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>