<div class="modal" id="test{{$value->id}}" tabindex="1" role="dialog" aria-hidden="true">
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
                                        @if($value->foto === null)
                                            <img class="d-block w-100" src="{{asset('images/icon/no.png')}}" alt="First slide">
                                        @else
                                            <img class="d-block w-100" src="{{asset($value->foto)}}" alt="First slide">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.Carousel Wrapper-->
                    </div>
                    <div class="col-lg-7">
                        <h2 class="h2-responsive product-name">
                            <strong>{{$value->nama}}</strong>
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
                                                <strong><span>@if($value->nik == null)
                                                            <span>-</span>
                                                        @endif{{$value->nik}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">NISN :</small><br>
                                                <strong><span>@if($value->nisn == null)
                                                            <span>-</span>
                                                        @endif{{$value->nisn}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">TTL :</small><br>
                                                <strong><span>{{ $value->tempat_lahir }}, {{ $value->tgl_lahir }}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Jenis Kelamin :</small><br>
                                                <strong><span>{{ $value->kelamin }}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Agama :</small><br>
                                                <strong><span>{{ $value->agama->nama_agama }}</span></strong>
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Telepon Rumah  :</small><br>
                                                <strong><span>@if($value->telpon_rumah == null)
                                                            <span>-</span>
                                                        @endif{{$value->telpon_rumah}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Telepon Seluler :</small><br>
                                                <strong><span>@if($value->telpon_selular == null)
                                                            <span>-</span>
                                                        @endif{{$value->telpon_selular}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Email :</small><br>
                                                <strong><span>@if($value->email == null)
                                                            <span>-</span>
                                                        @endif{{$value->email}}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Kewarganegaraan :</small><br>
                                                <strong><span>{{ $value->kewarganegaraan->nama_negara }}</span></strong>
                                            </h6>
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Kebutuhan Khusus :</small><br>
                                                <strong>{{isset($value->kebutuhanKhusus)?$value->kebutuhanKhusus->nama_kebutuhan:'-'}}</strong>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="h6-responsive">
                                                <small class="green-text">Alamat :</small><br>
                                                <strong><span>{{$value->alamat}}</span></strong>
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
                        {{--info alamat--}}
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">RT/RW :</small><br>
                                            <strong>@if($value->rt == null)
                                                        <span>-</span>
                                                    @endif{{$value->rt}}/@if($value->rw == null)
                                                    <span>-</span>
                                                @endif{{$value->rw}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nama Dusun :</small><br>
                                            <strong><span>@if($value->nama_dusun == null)
                                                        <span>-</span>
                                                    @endif{{$value->nama_dusun}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Desa/Kelurahan:</small><br>
                                            <strong>{{$value->desa}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Provinsi :</small><br>
                                            <strong>{{$value->provinsi->nama_provinsi}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kabupaten :</small><br>
                                            <strong>{{isset($value->kabupaten)?$value->kabupaten->nama_kabupaten:'-'}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kecamatan :</small><br>
                                            <strong>{{isset($value->kecamatan)?$value->kecamatan->nama_kecamatan:'-'}}</strong>
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
                                            <strong>@if($value->kode_pos == null)
                                                    <span>-</span>
                                                @endif{{$value->kode_pos}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenis Tinggal :</small><br>
                                            <strong>@if($value->jenis_tinggal == null)
                                                        <span>-</span>
                                                    @endif{{$value->jenis_tinggal}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Alat Transportasi :</small><br>
                                            <strong>{{$value->transportasiPD->nama_transportasi}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Anak ke :</small><br>
                                            <strong>@if($value->anak_ke == null)
                                                    <span>-</span>
                                                @endif{{$value->anak_ke}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penerima KPS :</small><br>
                                            <strong>{{$value->kps}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nomor KPS :</small><br>
                                            <strong>@if($value->no_kps == null)
                                                    <span>-</span>
                                                @endif{{$value->no_kps}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Layak PIP :</small><br>
                                            <strong>{{$value->pip}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penerima KIP :</small><br>
                                            <strong>{{$value->kip}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Nomor KKS :</small><br>
                                            <strong>@if($value->no_kks == null)
                                                    <span>-</span>
                                                @endif{{$value->no_kks}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Reg Akta Lahir :</small><br>
                                            <strong>@if($value->reg_akta == null)
                                                    <span>-</span>
                                                @endif{{$value->reg_akta}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Lembaga :</small><br>
                                            <strong>{{$value->lembaga->nama_lembaga}}</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--info ayah--}}
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
                                            <strong><span>@if($value->nama_ayah == null)
                                                        <span>-</span>
                                                    @endif{{$value->nama_ayah}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span>@if($value->nik_ayah == null)
                                                        <span>-</span>
                                                    @endif{{$value->nik_ayah}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lahir :</small><br>
                                            <strong><span>@if($value->tahun_lahir_ayah == null)
                                                        <span>-</span>
                                                    @endif{{$value->tahun_lahir_ayah}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang pendidikan :</small><br>
                                            <strong>{{isset($value->jenjangPendidikanA)?$value->jenjangPendidikanA->nama_jenjang:'-'}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan :</small><br>
                                            <strong><span>@if($value->pekerjaan_ayah == null)
                                                        <span>-</span>
                                                    @endif{{$value->pekerjaan_ayah}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penghasilan :</small><br>
                                            <strong>{{isset($value->penghasilanA)?$value->penghasilanA->jumlah_penghasilan:'-'}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kebutuhan Khusus :</small><br>
                                            <strong>{{isset($value->kebutuhanKhususA)?$value->kebutuhanKhususA->nama_kebutuhan:'-'}}</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--info ibu--}}
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
                                            <strong><span>{{$value->nama_ibu}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span>@if($value->nik_ibu == null)
                                                        <span>-</span>
                                                    @endif{{$value->nik_ibu}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lahir :</small><br>
                                            <strong><span>@if($value->tahun_lahir_ibu == null)
                                                        <span>-</span>
                                                    @endif{{$value->tahun_lahir_ibu}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang pendidikan :</small><br>
                                            <strong>{{isset($value->jenjangPendidikanI)?$value->jenjangPendidikanI->nama_jenjang:'-'}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan :</small><br>
                                            <strong><span>@if($value->pekerjaan_ibu == null)
                                                        <span>-</span>
                                                    @endif{{$value->pekerjaan_ibu}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penghasilan :</small><br>
                                            <strong>{{isset($value->penghasilanI)?$value->penghasilanI->jumlah_penghasilan:'-'}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Kebutuhan Khusus :</small><br>
                                            <strong>{{isset($value->kebutuhanKhususI)?$value->kebutuhanKhususI->nama_kebutuhan:'-'}}</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--inf0 wali--}}
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
                                            <strong><span>@if($value->nama_wali == null)
                                                        <span>-</span>
                                                    @endif{{$value->nama_wali}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">NIK :</small><br>
                                            <strong><span>@if($value->nik_wali == null)
                                                        <span>-</span>
                                                    @endif{{$value->nik_wali}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Tahun Lahir :</small><br>
                                            <strong><span>@if($value->tahun_lahir_wali == null)
                                                        <span>-</span>
                                                    @endif{{$value->tahun_lahir_wali}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Jenjang pendidikan :</small><br>
                                            <strong>{{isset($value->jenjangPendidikanW)?$value->jenjangPendidikanW->nama_jenjang:'-'}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Pekerjaan :</small><br>
                                            <strong><span>@if($value->pekerjaan_wali == null)
                                                        <span>-</span>
                                                    @endif{{$value->pekerjaan_wali}}</span></strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Penghasilan :</small><br>
                                            <strong>{{isset($value->penghasilanW)?$value->penghasilanW->jumlah_penghasilan:'-'}}</strong>
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
                                            <strong>@if($value->created_by == null)
                                                    <span>-</span>
                                                @endif
                                                {{$value->created_by}}</strong>
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="h6-responsive">
                                            <small class="green-text">Diubah oleh :</small><br>
                                            <strong>@if($value->updated_by == null)
                                                    <span>-</span>
                                                @endif
                                                {{$value->updated_by}}</strong>
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