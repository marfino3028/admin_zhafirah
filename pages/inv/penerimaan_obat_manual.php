<?php
	date_default_timezone_set("Asia/Bangkok");
	$data = $db->query("select * from tbl_penerimaan where id='".$_GET['id']."'");
	$po = $db->query("select * from tbl_penerimaan where id='".$data[0]['id']."'");
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
                <a href="javascript:void(0)">Wharehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Penerimaan Barang</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
            </li>
            <li>
                <a href="javascript:void(0)">Data Detail Penerimaan</a>
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
                                        Form Edit Data Detail Penerimaan
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/inv/penerimaan_update_baru.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Terima</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $po[0]['no_penerimaan']?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. faktur</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $po[0]['no_faktur']?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. PO</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $po[0]['no_po']?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tgl Faktur</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d F Y", strtotime($po[0]['tgl_faktur']))?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Vendor</label>
                                                    <div class="col-sm-8">
                                                        <select id="vendor" name="vendor" size="1" class="form-control">
                                                            <?php
                                                            $daft = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                if ($daft[$i]['kode_vendor'] == $po[0]['kode_vendor'])
                                                                    echo '<option value="'.$daft[$i]['kode_vendor'].'" selected="selected">'.$daft[$i]['nama_vendor'].'</option>';
                                                                //else
                                                                    //echo '<option value="'.$daft[$i]['kode_vendor'].'">'.$daft[$i]['nama_vendor'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Suplier</label>
                                                    <div class="col-sm-8">
                                                        <select id="suplier" name="suplier" size="1" class="form-control">
                                                            <?php
                                                            $daft = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                if ($daft[$i]['kode_suplier'] == $po[0]['kode_suplier'])
                                                                    echo '<option value="'.$daft[$i]['kode_suplier'].'" selected="selected">'.$daft[$i]['nama_suplier'].'</option>';
                                                                //else
                                                                    //echo '<option value="'.$daft[$i]['kode_suplier'].'">'.$daft[$i]['nama_suplier'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
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
                                                                <th style="width:80px">Jml PO</th>
                                                                <th>Harga</th>
                                                                <th>Harga PO</th>
                                                                <th>Total Harga</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $data = $db->query("select * from tbl_po_detail where status_delete='UD' and poID='".$data[0]['id']."'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $total = $data[$i]['harga'] * $data[$i]['qty'];
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $data[$i]['nama_obat']?></td>
                                                                    <td><?php echo $data[$i]['sat']?></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
                                                                    <td align="right"><div align="right">
                                                                            <input type="text" id="qty[<?php echo $i?>]" name="qty[<?php echo $i?>]" value="<?php echo number_format($data[$i]['qty_po'])?>" class="form-control text-right" />
                                                                            <input type="hidden" id="id[<?php echo $i?>]" name="id[<?php echo $i?>]" value="<?php echo $data[$i]['id']?>" />
                                                                        </div></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                                                                    <td align="right"><div align="right">
                                                                            <input type="text" id="harga[<?php echo $i?>]" name="harga[<?php echo $i?>]" value="<?php echo number_format($data[$i]['harga_po'])?>" class="form-control text-right" />
                                                                        </div></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($total)?></div></td>
                                                                </tr>
                                                                <?php
                                                                $tot1 = $tot1 + $data[$i]['qty'];
                                                                $tot1po = $tot1po + $data[$i]['qty_po'];
                                                                $tot2 = $tot2 + $data[$i]['harga'];
                                                                $tot3 = $tot3 + $total;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td colspan="3" style="font-weight: bold; text-align: right">Grand Total</td>
                                                                <td><div align="right" style="font-weight: bold"><?php echo number_format($tot1)?></div></td>
                                                                <td><div align="right" style="font-weight: bold"><?php echo number_format($tot1po)?></div></td>
                                                                <td><div align="right" style="font-weight: bold"><?php echo number_format($tot2)?></div></td>
                                                                <td><div align="right" style="font-weight: bold">-</div></td>
                                                                <td><div align="right" style="font-weight: bold"><?php echo number_format($tot3)?></div></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
					    <input type="hidden" name="nopo" value="<?php echo $po[0]['no_po']?>">
					    <input type="hidden" name="idpo" value="<?php echo $po[0]['id']?>">
                                            <input type="submit" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Detail PO" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List PO" onclick="simpanData(this.form, 'index.php?mod=inv&submod=po')" />
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