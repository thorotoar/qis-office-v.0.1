<div class="modal" id="modalPeserta" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Data Peserta Didik</strong></h5>
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
                                    <div style="text-align: center">
                                        <img class="d-block w-100" src="" alt="First slide">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.Carousel Wrapper-->
                    </div>
                    <div class="col-lg-7">
                        <h2 class="h2-responsive product-name">
                            <strong id="nama"></strong>&nbsp;<button id="full" class="btn btn-sm btn-outline-danger btn-flat btn-rounded disabled" disabled></button>
                        </h2>

                        <!--Accordion wrapper-->
                        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                            {{--info personal--}}
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="h2-responsive product-name">
                                                <strong>Info Personal</strong>
                                            </h6><hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">NIK :</small><br>
                                                <strong><span id="nik"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">NISN :</small><br>
                                                <strong><span id="nisn"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">TTL :</small><br>
                                                <strong><span id="ttl"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Jenis Kelamin :</small><br>
                                                <strong id="jk"></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Agama :</small><br>
                                                <strong><span id="agama"></span></strong>
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Telepon Rumah  :</small><br>
                                                <strong><span id="telp"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Telepon Seluler :</small><br>
                                                <strong><span id="hp"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Email :</small><br>
                                                <strong><span id="email"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Kewarganegaraan :</small><br>
                                                <strong><span id="negara"></span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Kebutuhan Khusus :</small><br>
                                                <strong id="kebutuhan"></strong>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Alamat :</small><br>
                                                <strong><span id="alamat"></span></strong>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="h2-responsive product-name">
                                        <strong>Info Alamat</strong>
                                    </h6><hr>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">RT/RW :</small><br>
                                            <strong><span id="rt"></span>/<span id="rw"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama Dusun :</small><br>
                                            <strong><span id="dusun"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Desa/Kelurahan:</small><br>
                                            <strong id="desa"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Provinsi :</small><br>
                                            <strong id="provinsi"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kabupaten :</small><br>
                                            <strong id="kabupaten"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kecamatan :</small><br>
                                            <strong id="kecamatan"></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kode Pos :</small><br>
                                            <strong><span id="kodePos"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenis Tinggal :</small><br>
                                            <strong><span id="jenisTinggal"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Alat Transportasi :</small><br>
                                            <strong id="trans"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Anak ke :</small><br>
                                            <strong><span id="anak"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penerima KPS :</small><br>
                                            <strong id="kps"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nomor KPS :</small><br>
                                            <strong><span id="noKps"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Layak PIP :</small><br>
                                            <strong id="pip"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penerima KIP :</small><br>
                                            <strong id="kip"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nomor KKS :</small><br>
                                            <strong><span id="kks"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Reg Akta Lahir :</small><br>
                                            <strong><span id="akta"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Lembaga :</small><br>
                                            <strong><span id="lemb"></span></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="h2-responsive product-name">
                                        <strong>Info Ayah</strong>
                                    </h6><hr>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama :</small><br>
                                            <strong><span id="namaAyah"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span id="nikAyah"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lahir :</small><br>
                                            <strong><span id="lahirAyah"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang pendidikan :</small><br>
                                            <strong id="jA"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan :</small><br>
                                            <strong><span id="pA"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penghasilan :</small><br>
                                            <strong id="penghasilanAyah"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kebutuhan Khusus :</small><br>
                                            <strong id="kebutuhanAyah"></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="h2-responsive product-name">
                                        <strong>Info Ibu</strong>
                                    </h6><hr>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama :</small><br>
                                            <strong><span id="namaIbu"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span id="nikIbu"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lahir :</small><br>
                                            <strong><span id="lahirIbu"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang pendidikan :</small><br>
                                            <strong id="jI"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan :</small><br>
                                            <strong><span id="pI"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penghasilan :</small><br>
                                            <strong id="penghasilanIbu"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kebutuhan Khusus :</small><br>
                                            <strong id="kebutuhanIbu"></strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="h2-responsive product-name">
                                        <strong>Info Wali</strong>
                                    </h6><hr>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama :</small><br>
                                            <strong><span id="namaWali"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span id="nikWali"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lahir :</small><br>
                                            <strong><span id="lahirWali"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang pendidikan :</small><br>
                                            <strong id="jW"></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan :</small><br>
                                            <strong><span id="pW"></span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penghasilan :</small><br>
                                            <strong id="penghasilanWali"></strong>
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