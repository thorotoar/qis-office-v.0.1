<div class="modal" id="modalHarian" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Report Peserta Didik</strong></h5>
                <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white" id="title"></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Intruksi</th>
                                            <th>Respon</th>
                                            <th>Nilai*</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row" id="no"></th>
                                            <th id="kode"></th>
                                            <th id="ins"></th>
                                            <th id="res"></th>
                                            <th id="nilai"></th>
                                            <th id="ket"></th>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p>*Keterangan Nilai : A (Sangat Baik), B (Baik), C (Cukup), D (Kurang), E (Sangat Kurang)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalKonsultasi" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Report Peserta Didik</strong></h5>
                <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white" id="title1"></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Aspek</th>
                                            <th>Hasil</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row" id="no1"></th>
                                            <th id="aspek"></th>
                                            <th id="hasil"></th>
                                            <th id="ket1"></th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalMonitoring" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Hasil Monitoring Peserta Didik</strong></h5>
                <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white" id="titleMo"></h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Perstasi</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td id="nilaiMo"></td>
                                            <td id="presMo"></td>
                                            <td id="ketMo"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modalEvaluasi" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Hasil Evaluasi Peserta Didik</strong></h5>
                <button type="button" class="btn btn-info btn-flat btn-rounded btn-sm" data-dismiss="modal">
                    <i class="fa fa-close"></i> Close</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white" id="titleEv"></h4>
                            </div>
                            <div class="card-body">
                                <div class="card" id="detailEv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>