<?php
date_default_timezone_set("Asia/Bangkok");
$data = $db->query("select * from tbl_ro where md5(id)='" . $_GET['id'] . "'");
$jenis_permintaan = $data[0]['jenis'];
?>
<script language="javascript">
    function CariPasien(id) {
        var url = "pages/pendaftaran/view_pasien.php";
        var data = {
            id: id
        };

        $('.loading').fadeIn();
        $('#data_pasien').fadeOut();
        $('#data_pasien').load(url, data, function() {
            $('.loading').fadeOut('fast');
            $('#data_pasien').fadeIn('fast');
        });
    }

    function TampilHarga(kode) {
        document.getElementById('data_pasien').innerHTML = 'Tunggu....';
        var url = "pages/inv/info_obat.php";
        var data = {
            kode: kode
        };
        $('#data_pasien').load(url, data, function() {
            $('#data_pasien').fadeIn('fast');
        });

        var url = "pages/inv/obatQTY.php";
        var data = {
            kode: kode
        };
        $('#DataAdd').load(url, data, function() {
            $('#DataAdd').fadeIn('fast');
        });
    }

    function simpanTindakanGigi() {
        var id = document.getElementById('roID').value;
        var no_ro = document.getElementById('no_ro').value;
        var obat = document.getElementById('obat').value;
        var qty = document.getElementById('qty').value;
        var url = "pages/inv/simpan_ro_detail.php";
        var data = {
            id: id,
            no_ro: no_ro,
            obat: obat,
            qty: qty
        };

        document.getElementById('data_pasien').innerHTML = 'Tunggu....';
        $('#data_pasien').load(url, data, function() {
            $('#data_pasien').fadeIn('fast');
        });
    }
</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">PERMINTAAN OBAT</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Data Detail RO</a>
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
                                        Form Tambah Data Detail RO
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/inv/simpan_ro_detail.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. RO </label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_ro'] ?>
                                                        <input type="hidden" id="no_ro" name="no_ro" value="<?php echo $data[0]['no_ro'] ?>" />
                                                        <input type="hidden" id="roID" name="roID" value="<?php echo $data[0]['id'] ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d-m-Y", strtotime($data[0]['tgl_input_ro'])) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Unit Peminta</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['unit'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Obat </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="obat" name="obat" onchange="TampilHarga(this.value)" style="width: 100%;" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Qty</label>
                                                    <div class="col-sm-8">
                                                        <div id="DataAdd">
                                                            <div id="TarifTindakan">
                                                                <input type="text" name="qty" id="qty" size="5" value="0" class="form-control text-right" tabindex="3" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p></p>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Obat</th>
                                                                <th style="width:50px">Satuan</th>
                                                                <th style="width:80px">Jml Pesanan</th>
                                                                <th>Harga</th>
                                                                <th>Total Harga</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $data = $db->query("select * from tbl_ro_detail where status_delete='UD' and roID='" . $data[0]['id'] . "'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $total = $data[$i]['harga'] * $data[$i]['qty'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $i + 1 ?></td>
                                                                    <td><?php echo $data[$i]['nama_obat'] ?></td>
                                                                    <td><?php echo $data[$i]['sat'] ?></td>
                                                                    <td align="right">
                                                                        <div align="right"><?php echo number_format($data[$i]['qty']) ?></div>
                                                                    </td>
                                                                    <td align="right">
                                                                        <div align="right"><?php echo number_format($data[$i]['harga']) ?></div>
                                                                    </td>
                                                                    <td align="right">
                                                                        <div align="right"><?php echo number_format($total) ?></div>
                                                                    </td>
                                                                    <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ro_detail_delete.php?id=<?php echo $data[$i]['id'] . '&subid=' . $_GET['id'] ?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                                                                </tr>
                                                            <?php
                                                                $tot1 = $tot1 + $data[$i]['qty'];
                                                                $tot2 = $tot2 + $data[$i]['harga'];
                                                                $tot3 = $tot3 + $total;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td colspan="3" style="font-weight: bold; text-align: right">Grand Total</td>
                                                                <td>
                                                                    <div align="right" style="font-weight: bold"><?php echo number_format($tot1) ?></div>
                                                                </td>
                                                                <td>
                                                                    <div align="right" style="font-weight: bold"><?php echo number_format($tot2) ?></div>
                                                                </td>
                                                                <td>
                                                                    <div align="right" style="font-weight: bold"><?php echo number_format($tot3) ?></div>
                                                                </td>
                                                                <td>
                                                                    <div align="right" style="font-weight: bold">&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Detail RO" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Request" onclick="simpanData(this.form, 'index.php?mod=inv&submod=ro')" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
    var jenis = "<?= $jenis_permintaan; ?>";

    if (jenis == "LOGISTIK") {
        var urlData = "pages/functions/logum_gudang.php";
    } else {
        var urlData = "pages/functions/obat_gudang.php";
    }

    $(document).ready(function() {
        $("#obat").select2({
            minimumInputLength: 1,
            ajax: {
                url: urlData,
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function(term) {
                    return {
                        term: term
                    };
                },
                results: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.itemName,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });

    });
</script>