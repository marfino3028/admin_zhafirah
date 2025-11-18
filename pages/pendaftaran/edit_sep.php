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
                <a href="javascript:void(0)">Edit Data</a>
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
                                        Form Edit SEP : <span id="noSep"></span>
                                    </h3>
                                    <button onclick="terbitkanSep()" class="btn btn-success">Terbitkan SEP</button>
                                    <button onclick="closeForm()" class="btn btn-warning">Batal</button>
                                </div>
                                <div class="box-content">
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Nomor Kartu</b></span>
                                                <input type="text" class="form-control" id="noKartu" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Tanggal SEP</b></span>
                                                <input type="date" class="form-control" readonly id="tglSep">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>PPK Pelayanan</b></span>
                                                <input type="text" class="form-control" id="ppkPelayanan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Jenis Pelayanan</b></span>
                                                <select class="form-control" id="jnsPelayanan"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Hak Kelas Rawat</b> <a onclick="cekHakKelas()" href="javascript:void(0)"> <i class="fa fa-refresh"></i> Sinkron Kelas BPJS</a></span>
                                                <select class="form-control" id="klsRawatHak"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>No.MR</b></span>
                                                <input type="text" class="form-control" id="noMR" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>No.Rujukan</b> <a onclick="openRujukan()" href="javascript:void(0)"> <i class="fa fa-search"></i> Cari No.Rujukan</a></span>
                                                <input type="text" class="form-control" autocomplete="off" id="noRujukan" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Asal Rujukan</b></span>
                                                <select class="form-control" id="asalRujukan"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Tanggal Rujukan</b></span>
                                                <input type="date" class="form-control" id="tglRujukan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>PPK Asal Rujukan</b></span>
                                                <input type="text" class="form-control" id="ppkRujukan" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Catatan</b></span>
                                                <input type="text" class="form-control" id="catatan" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Diagnosa</b> <a onclick="openDiagnosa()" href="javascript:void(0)"> <i class="fa fa-search"></i> Cari</a></span>
                                                <select class="form-control" id="diagAwal"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Poli Tujuan</b></span>
                                                <select class="form-control" id="tujuan"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Eksekutif</b></span>
                                                <select class="form-control" id="eksekutif"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>COB</b></span>
                                                <select class="form-control" id="cob"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Katarak</b></span>
                                                <select class="form-control" id="katarak"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Tujuan Kunjungan</b></span>
                                                <select class="form-control" id="tujuanKunj"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>Asesmen Pelayanan</b></span>
                                                <select class="form-control" id="assesmentPel"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>No.Surat Kontrol</b> <a onclick="cariKontrol()" href="javascript:void(0)"> <i class="fa fa-search"></i> Cari</a></span>
                                                <input type="text" class="form-control" id="noSurat" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>DPJP Kontrol</b></span>
                                                <select class="form-control" id="kodeDPJP"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>DPJP Pelayanan</b></span>
                                                <select class="form-control" id="dpjpLayan"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>No.Telp.</b></span>
                                                <input type="text" class="form-control" id="noTelp" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><b>User</b></span>
                                                <input type="text" class="form-control" id="user" readonly>
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
<div class="modal fade" id="upRujukan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Daftar Rujukan | <a href="javascript:void(0)" onclick="rujukanFaskes1()">Faskes 1</a> | <a href="javascript:void(0)" onclick="rujukanFaskes2()">Faskes 2</a> | <a href="javascript:void(0)" onclick="rujukanInternal()">Internal atau IGD</a></h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td style="width: 5%;">No.</td>
                            <td>No.Rujukan <span id="ket_faskes">( Faskes 1 )</span></td>
                            <td>Tanggal</td>
                            <td>Spesialis</td>
                            <td style="width: 5%;">#</td>
                        </tr>
                    </thead>
                    <tbody id="daftarRujukan"></tbody>
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
include "pages/pendaftaran/lib_sep/edit_sep_js.php";
?>