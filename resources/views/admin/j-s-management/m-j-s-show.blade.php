<div class="modal" id="user{{$value->id}}" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        {{--info jabatan--}}
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="h5-responsive">
                                    <small class="green-text">Nama jenis surat :</small><br>
                                    <strong><span>{{$value->nama_jenis_surat}}</span></strong>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="h5-responsive">
                                    <small class="green-text">Dimasukkan oleh :</small><br>
                                    <strong>@if($value->created_by == null)
                                            <span>-</span>
                                        @endif
                                        {{$value->created_by}}</strong>
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="h5-responsive">
                                    <small class="green-text">Diubah oleh :</small><br>
                                    <strong>@if($value->updated_by == null)
                                            <span>-</span>
                                        @endif
                                        {{$value->updated_by}}</strong>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div style="text-align: center;">
                    <button type="button" class="btn btn-info btn-flat btn-rounded" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>