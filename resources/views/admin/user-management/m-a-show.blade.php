<div class="modal" id="user{{$value->id}}" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        {{--info user--}}
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="h2-responsive product-name">
                                    <strong>{{$value->nama_user}}</strong>
                                </h2>
                                <h4 class="h4-responsive">
                            <span class="green-text">
                                @if($value->ptype == 'pegawai')
                                    <button class="btn btn-sm btn-secondary btn-flat btn-rounded disabled" disabled>{{ ucwords($value->type) }}</button>
                                @elseif($value->type == 'admin')
                                    <button class="btn btn-sm btn-danger btn-flat btn-rounded disabled" disabled>{{ ucwords($value->type) }}</button>
                                @endif
                            </span>
                                </h4><hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="h5-responsive">
                                    <small class="green-text">Username :</small><br>
                                    <strong><span>{{$value->username}}</span></strong>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="h5-responsive">
                                    <small class="green-text">E-mail :</small><br>
                                    <strong>@if($value->email_user == null)
                                            <span>-</span>
                                        @endif
                                        {{$value->email_user}}</strong>
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="h5-responsive">
                                    <small class="green-text">Dimasukkan oleh :</small><br>
                                    <strong>@if($value->created_by == null)
                                            <span>-</span>
                                        @endif
                                        {{$value->created_by}}</strong>
                                </h5>
                            </div>
                            <div class="col-md-3">
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