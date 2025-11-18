<?php

$ceknmr = $db->queryItem("select max(right(no_penerimaan, 3)*1) from tbl_penerimaan where left(right(no_penerimaan, 11), 8)='" . date("dmY") . "'", 0);
$ceknmr = $ceknmr + 1;
if ($ceknmr < 10) $ceknmr = '00' . $ceknmr;
elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0' . $ceknmr;
elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
$nomr = 'PN-' . date("dmY") . $ceknmr;
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Penerimaan Obat
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
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
                                        Form Penerimaan Obat
                                </div>
                                <div class="box-content nopadding">
                                    <form id="form_penerimaan_obat" action="pages/inv/penerimaan_obatPO_insert.php" method="POST" class="form-horizontal form-bordered form-column">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Penerimaan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_penerimaan" name="no_penerimaan" class="form-control" value="<?php echo $nomr ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Faktur</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_faktur" name="no_faktur" class="form-control" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Faktur</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_faktur" name="tgl_faktur" class="form-control" value="<?php echo date("Y-m-d") ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_barang" class="control-label col-sm-4">Jenis Barang</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="jenis_barang" name="jenis_barang">
                                                            <option value=""></option>
                                                            <option value="obat">Obat</option>
                                                            <option value="logistik">Logistik</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Penerimaan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="jenis_penerimaan" name="jenis_penerimaan">
                                                            <option value="">Pilih Jenis Penerimaan</option>
                                                            <option value="po">Penerimaan dengan PO</option>
							    <option value="po_konsi">Penerimaan dengan PO Konsinyasi</option>
                                                            <option value="tanpa_po">Penerimaan tanpa PO</option>
							    <option value="tanpa_po_konsi">Penerimaan tanpa PO Konsinyasi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. PO</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="no_po2" name="no_po[]" style="display: none;">
                                                        <select id="no_po1" name="no_po[]" size="1" class="form-control" onchange="CariPasien(this.value)">
                                                            <option value="">--Pilih No. PO--</option>
                                                            <?php
                                                            $daft = $db->query("select no_po from tbl_po where status_delete='UD'");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                echo '<option value="' . $daft[$i]['no_po'] . '">' . $daft[$i]['no_po'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Vendor</label>
                                                    <div class="col-sm-8">
                                                        <select id="kode_vendor" class="form-control" name="kode_vendor" size="1" tabindex="1" onchange="setNameOfChange('kode_vendor', 'nama_vendor')" required="required">
                                                            <option value="">--Pilih Vendor--</option>
                                                            <?php
                                                            	$lab = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD' order by nama_vendor");
                                                            	for ($i = 0; $i < count($lab); $i++) {
                                                                	echo '<option value="'.$lab[$i]['kode_vendor'].'">'.$lab[$i]['kode_vendor'].' - '.$lab[$i]['nama_vendor'].'</option>';
                                                            	}
                                                            ?>
                                                        </select>
                                                        <input type="hidden" id="nama_vendor" name="nama_vendor" class="form-control" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Supplier</label>
                                                    <div class="col-sm-8">
                                                        <select id="kode_suplier" class="form-control" name="kode_suplier" size="1" tabindex="1" onchange="setNameOfChange('kode_suplier', 'nama_suplier')" required="required">
                                                            <option value="">--Pilih Supplier--</option>
                                                            <?php
                                                            	$lab = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD' order by nama_suplier");
                                                            	for ($i = 0; $i < count($lab); $i++) {
                                                                	echo '<option value="'.$lab[$i]['kode_suplier'].'">'.$lab[$i]['kode_suplier'].' - '. $lab[$i]['nama_suplier'] . '</option>';
                                                            	}
                                                            ?>
                                                        </select>
                                                        <input type="hidden" id="nama_suplier" name="nama_suplier" class="form-control" readonly="readonly" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <span class="loading"></span>
                                                <div id="data-purchase-order" class="container"></div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Penerimaan Obat" />
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
    $(document).ready(function() {
        const no_po1 = $('#no_po1');
        const no_po2 = $('#no_po2');
        const dataPurchaseOrder = $('#data-purchase-order');
        const jenisPenerimaan = $('#jenis_penerimaan');
        const kodeVendor = $('#kode_vendor');
        const namaVendor = $('#nama_vendor');
        const kodeSuplier = $('#kode_suplier');
        const namaSuplier = $('#nama_suplier');

        $(".select2").select2();

        function onChange(element, func) {
            $(element).change(function() {
                func($(this).val());
                console.log($(this).val());
            });
        }

        no_po1.change(function() {
            const id = $(this).val();
            var url = "pages/inv/view_po.php";
            var data = {
                id
            };
            if (id !== null && no_po1.is(':visible')) {
                $('.loading').fadeIn();
                $('#data-purchase-order').fadeOut();
                $('#data-purchase-order').load(url, data, function() {
                    $('.loading').fadeOut('fast');
                    $('#data-purchase-order').fadeIn('fast');
                });
            } else {
                dataPurchaseOrder.innerHTML = '';
            }
        })

        jenisPenerimaan.change(function() {
            if ($(this).val() == "po") {
                no_po1.show();
                no_po2.hide();
            } else {
                no_po1.hide();
                no_po2.show();
                $('#data-purchase-order').fadeOut();
            }
        })

        kodeVendor.change(function() {
            const text = $(this).find("option:selected").text();
            if ($(this).val() != '') {
                namaVendor.val(text);
            } else {
                namaVendor.val('');
            }
        });

        kodeSuplier.change(function() {
            const text = $(this).find("option:selected").text();
            if ($(this).val() != '') {
                namaSuplier.val(text);
            } else {
                namaSuplier.val('');
            }
        });
    });
</script>