<div class="modal" id="sendSertifikat" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Kirim Sertfikat</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{route('p-kirim')}}" enctype="multipart/form-data" method="post" id="formSertifikat">
                            {{csrf_field()}}
                            <input type="hidden" name="id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Penerima </label>
                                        <input class="form-control input-sm" type="Text" id="email" name="penerima">
                                    </div>
                                    <div class="form-group">
                                        <label>Subjek </label>
                                        <input class="form-control input-sm" type="Text" name="subjek">
                                    </div>
                                    <div class="form-group">
                                        <label>Isi Email</label>
                                        <textarea class="form-control isi" name="isi_email" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label hidden>Subjek </label>
                                        <input class="form-control" type="file" name="file_pdf" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                                        <button type="reset" class="btn btn-primary btn-sm">Clear</button>
                                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>