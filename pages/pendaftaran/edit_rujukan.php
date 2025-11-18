<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Rujukan</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Edit Rujukan : <span id="rujukKe"></span> - <span id="poliRujukKe"></span>
                                    </h3>
                                    <button onclick="terbitkanRujukan()" class="btn btn-success">Terbitkan Rujukan</button>
                                    <button onclick="closeForm()" class="btn btn-warning">Batal</button>
                                </div>
                                <div class="box-content">
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Nomor Rujukan</b></span>
                                                <input type="text" class="form-control" id="noRujukan" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Tanggal Rujukan</b></span>
                                                <input type="date" class="form-control" id="tglRujukan">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Tanggal Rencana Kunjungan</b></span>
                                                <input type="date" class="form-control" id="tglRencanaKunjungan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Rujuk ke</b> <a onclick="cariFaskes()" href="javascript:void(0)"> <i class="fa fa-search"></i> Cari</a></span>
                                                <select class="form-control" id="ppkDirujuk"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Jenis Pelayanan</b></span>
                                                <select class="form-control" id="jnsPelayanan"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Catatan</b></span>
                                                <input type="text" class="form-control" id="catatan" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Diagnosa</b> <a onclick="openDiagnosa()" href="javascript:void(0)"> <i class="fa fa-search"></i> Cari</a></span>
                                                <select class="form-control" id="diagAwal"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Tipe Rujukan</b></span>
                                                <select class="form-control" id="tipeRujukan"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Poli Rujukan</b> <a onclick="cariPoliRujukan()" href="javascript:void(0)"> <i class="fa fa-search"></i> Cari</a></span>
                                                <select class="form-control" id="poliRujukan"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="display: none;">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>User</b></span>
                                                <input type="text" value="<?= $_SESSION['rg_user']; ?>" class="form-control" id="user" readonly>
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
    </div>
</div>

<!-- Modal Rujukan -->
<div class="modal fade" id="upCariFaskes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pencarian Faskes Rujukan</h4>
            </div>
            <div class="modal-body">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <input type="text" class="form-control" autocomplete="off" id="keyFaskes" placeholder="cari kode / nama faskes">
                        </td>
                        <td>
                            <select class="form-control" id="keyJenisFaskes">
                                <option value="1">Faskes 1</option>
                                <option value="2">Faskes 2 (RS)</option>
                            </select>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" onclick="cariFaskesRujukan()" class="btn btn-lg btn-primary"><i class="fa fa-search"></i> Cari</button>
                        </td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered" style="margin-top: 5px;">
                    <tbody id="daftarFaskesRujukan"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upPoliRujukan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pencarian Poli Rujukan</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" autocomplete="off" id="keyPoli" placeholder="cari poli rujukan" onkeyup="cariKeyPoli()">

                <table class="table table-striped table-bordered" style="margin-top: 5px;">
                    <tbody id="dataPoliRujukan"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Diagnosa -->
<div class="modal fade" id="upDiagnosa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Diagnosa</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="cari diagnosa" onkeyup="cariDiagnosa()" autocomplete="off" id="keyDiagnosa">
                <table class="table table-striped table-bordered" style="margin-top: 10px;">
                    <tbody id="daftarDiagnosa"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
include "pages/pendaftaran/lib_sep/edit_rujukan_js.php";
?>