<?php

	$ceknmr = $db->queryItem("select max(right(no_po, 3)*1) from tbl_po where left(right(no_po, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'PO-'.date("dmY").$ceknmr;
	$unit = $db->queryItem("select nilai from tbl_config where kode='SBU'");
	$unit = $db->queryItem("select nama from tbl_sbu where kode='$unit'");
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/inv/view_ro.php";
		var data = {id:id};
		if (id == "" ) {
			document.getElementById('data_pasien').innerHTML = '';
		}
		else {
			$('.loading').fadeIn();
			$('#data_pasien').fadeOut();
			$('#data_pasien').load(url,data, function(){
				$('.loading').fadeOut('fast');
				$('#data_pasien').fadeIn('fast');
			});
		}
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
                <a href="javascript:void(0)">Purchase Order</a>
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
                                        Form Tambah Data PO
                                        </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/inv/input_ro_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. PO</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_po" name="no_po" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal PO</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tgl_input" name="tgl_input" class="form-control" value="<?php echo date("d-m-Y")?>"  readonly="" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Vendor</label>
                                                    <div class="col-sm-8">
                                                        <select id="vendor" name="vendor" size="1" class="form-control">
                                                            <option value="">--pilih Vendor--</option>
                                                            <?php
                                                            $daft = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                echo '<option value="'.$daft[$i]['kode_vendor'].'">'.$daft[$i]['nama_vendor'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Supplier</label>
                                                    <div class="col-sm-8">
                                                        <select id="suplier" name="suplier" size="1" class="form-control">
                                                            <option value="">--pilih Suplier--</option>
                                                            <?php
                                                            $daft = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                echo '<option value="'.$daft[$i]['kode_suplier'].'">'.$daft[$i]['nama_suplier'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. RO</label>
                                                    <div class="col-sm-8">
                                                        <select id="no_ro" name="no_ro" size="1" class="form-control" onchange="CariPasien(this.value)">
                                                            <option value="">--No. RO/Permintaan--</option>
                                                            <?php
                                                            $daft = $db->query("select no_ro from tbl_ro where status_po='NOT' and status_ro='A' and total_permintaan > 0");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                echo '<option value="'.$daft[$i]['no_ro'].'">'.$daft[$i]['no_ro'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data PO" onclick="simpanData(this.form, 'pages/inv/input_po_insert.php')" />
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