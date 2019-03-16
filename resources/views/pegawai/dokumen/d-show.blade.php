<div class="modal" id="test{{$value->id}}" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Info Dokumen</strong></h5>
                <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <!--Carousel Wrapper-->
                        <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    @foreach($fileDok as $index => $value)
                                        <img src="{{strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "jpg" || strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "jpeg"|| strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "png" || strtolower(pathinfo($value['upload_file'], PATHINFO_EXTENSION)) == "gif" ? asset($value['upload_file']) :  asset('images/icon/file.png')}}"><br>
                                        {{--<small>{{substr(str_limit($value['title'], 18, '...'), 4)}}</small>--}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!--Accordion wrapper-->
                        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Nama Dokumen :</small><br>
                                        <strong><span>{{$value->nama_dokumen}}</span></strong>
                                    </h6>
                                </div>
                                <div class="col-lg-3">
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Tanggal file :</small><br>
                                        <strong><span>{{ $value->tgl_file }}</span></strong>
                                    </h6>
                                </div>
                                <div class="col-lg-3">
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Tanggal dicatat :</small><br>
                                        <strong><span>{{ $value->tgl_dicatat }}</span></strong>
                                    </h6>
                                </div>
                                <div class="col-lg-3">
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Keterangan :</small><br>
                                        <strong><span>{{$value->keterangan}}</span></strong>
                                    </h6>
                                </div>
                                <div class="col-lg-3">
                                    <h6 class="h6-responsive">
                                        <small class="green-text">Dimasukkan oleh :</small><br>
                                        <strong>@if($value->created_by == null)
                                                <span>-</span>
                                            @endif
                                            {{$value->created_by}}</strong>
                                    </h6>
                                </div>
                                <div class="col-lg-3">
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