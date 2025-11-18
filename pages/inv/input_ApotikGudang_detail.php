<?php
$data = $db->query("select * from tbl_ro_to_gudang where md5(id)='" . $_GET['id'] . "'");
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
        var url = "pages/inv/info_obat_gudang.php";
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
        var id = document.getElementById('ro_gudangID').value;
        var no_ro = document.getElementById('no_ro_gudang').value;
        var obat = document.getElementById('obat').value;
        var qty = document.getElementById('qty').value;
        var url = "pages/inv/simpan_ApotikGudang_detail.php";
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
                <a href="javascript:void(0)">
                    Permintaan Obat Dari Apotik Ke Gudang
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Data Detail Request</a>
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
                                        Form Tambah Data Detail Request from Apotik to Gudang
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/inv/simpan_ApotikGudang_detail.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Request </label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_ro_gudang'] ?>
                                                        <input type="hidden" id="no_ro_gudang" name="no_ro_gudang" value="<?php echo $data[0]['no_ro_gudang'] ?>" />
                                                        <input type="hidden" id="ro_gudangID" name="ro_gudangID" value="<?php echo $data[0]['id'] ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d-m-Y", strtotime($data[0]['tgl_input_ro_gudang'])) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Jenis </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" tabindex="3" readonly id="jenis" name="jenis" value="<?= $jenis_permintaan; ?>" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Pilih Obat </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="obat" name="obat" onchange="TampilHarga(this.value)" style="width: 100%;" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Qty</label>
                                                    <div class="col-sm-8">
                                                        <div id="DataAdd">
                                                            <div id="TarifTindakan">
                                                                <input type="text" name="qty" id="qty" size="5" value="0" class="form-control" tabindex="3" required="required" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p></p>
                                            <div class="col-sm-7">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Obat</th>
                                                                <th style="width:50px">Satuan</th>
                                                                <th style="width:80px">Jml Pesanan</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $data = $db->query("select * from tbl_ro_to_gudang_detail where status_delete='UD' and ro_gudangID='" . $data[0]['id'] . "'", 0);
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
                                                                    <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ApotikGudang_detail_delete.php?id=<?php echo $data[$i]['id'] . '&subid=' . $_GET['id'] ?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
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
                                                                    <div align="right" style="font-weight: bold">&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" value="Simpan Detail Req" class="btn btn-sm btn-small btn-primary rounded" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Request" onclick="simpanData(this.form, 'index.php?mod=inv&submod=ApotikGudang')" />
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
    if (jenis == "LOGISTIK UMUM") {
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