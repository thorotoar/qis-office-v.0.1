<div class="modal" id="test{{$value->id}}" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Info Surat Masuk</strong></h5>
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
                                    <img class="d-block w-100" src="{{asset($value->upload_file)}}" alt="First slide">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <!--Accordion wrapper-->
                        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Nomor Surat :</small><br>
                                        <strong><span>{{$value->no_surat}}</span></strong>
                                    </h6>
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Tanggal diterima :</small><br>
                                        <strong><span>{{ $value->tgl_diterima }}</span></strong>
                                    </h6>
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Tanggal dicatat :</small><br>
                                        <strong><span>{{ $value->tgl_dicatat }}</span></strong>
                                    </h6>
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Pengirim :</small><br>
                                        <strong><span>{{ $value->pengirim }}</span></strong>
                                    </h6>
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Penerima :</small><br>
                                        <strong><span>{{$value->penerima}}</span></strong>
                                    </h6>
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Prihal :</small><br>
                                        <strong><span>{{$value->prihal}}</span></strong>
                                    </h6>
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Dimasukkan oleh :</small><br>
                                        <strong>@if($value->created_by == null)
                                                <span>-</span>
                                            @endif
                                            {{$value->created_by}}</strong>
                                    </h6>
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
                        <!-- Accordion wrapper -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>