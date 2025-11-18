<?php
ini_set("display_errors", 0);
$daftar =  $db->query("select no_daftar, nomr from tbl_pendaftaran where md5(no_daftar)='" . $_GET['id'] . "'", 0);
?>
<script language="javascript">
    function pilihBHP(id) {
        var url = "pages/hd/medication_bhp.php";
        var data = {
            id: id
        };

        $('#data_pasien').load(url, data, function() {
            $('#data_pasien').fadeIn('fast');
        });
    }
</script>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Layanan Hemodialisa</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Medication Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Medication Pasien</a>
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
                                        Form Tambah Data Detail Medication Pasien
                                </div>
                                <div class="box-content nopadding">

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <form class="form-horizontal form-bordered form-column">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Medication</label>
                                                    <div class="col-sm-8">
                                                        <span id="noMedicID" hidden></span><span id="noMedic"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <span id="nomr"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <span id="nama"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <span id="tgl_input"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Unit</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="unit">
                                                            <option value=""></option>
                                                            <option value="Apotik">Apotik</option>
                                                            <option value="Fisioterapi">Fisioterapi</option>
                                                            <option value="Keperawatan">Keperawatan</option>
                                                            <option value="Gudang">Gudang</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Paket BHP</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="idPaket"></select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Transaksi</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="transaksi"></select>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="button" onclick="simpan()" class="btn btn-sm btn-small btn-primary rounded">Simpan Data Medication</button>
                                                     &nbsp; <button onclick="kembali()" type="button" class="btn btn-sm btn-small btn-success rounded">List/Daftar Medication</button> 
                                                </div>
                                                <br>
                                            </form>
                                        </div>
                                        <p></p>
                                        <div class="col-sm-8">
                                            <div id="tambahan" style="display: none;">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td>
                                                            <select id="obat" name="obat" size="1" style="height: 25px; width: 100%;">
                                                                <option value="">--Pilih Obat--</option>
                                                                <?php
                                                                $dt = $db->query("select kode_obat, nama_obat, jenis from tbl_obat where nama_obat <> '' order by nama_obat");
                                                                for ($i = 0; $i < count($dt); $i++) {
                                                                    echo '<option value="' . $dt[$i]['kode_obat'] . '">' . $dt[$i]['nama_obat'] . ' (' . $dt[$i]['jenis'] . ')' . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <button onclick="tambahItem()" class="btn btn-primary">Tambah Item</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>
                                            </div>
                                            <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">No</th>
                                                        <th>#</th>
                                                        <th>Nama Obat</th>
                                                        <th style="width:12%">Sat</th>
                                                        <th style="width:13%">QTY*</th>
                                                        <th style="width:6%">Stok</th>
                                                        <th style="width:13%">Harga</th>
                                                        <th style="width:13%">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dataPaket"></tbody>
                                                <tbody style="display: none;" id="dataPaketSave"></tbody>
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
    </div>
</div>
<?php
include "dataMedication.php";
?>

<script>
    $('#obat').select2({
        placeholder: 'Pilih obat...',
        allowClear: true
    });
</script>