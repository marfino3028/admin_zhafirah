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
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data PO</div>
	<form action="javascript:simpanData(this.form, 'pages/inv/input_ro_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="240">
                <div align="left" style="margin-top: 20px;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="240" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px " style="width:10">No. PO</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_po" name="no_po" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Tanggal PO</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tgl_input" name="tgl_input" class="form-control" value="<?php echo date("d-m-Y")?>"  readonly="" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Unit</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="unit" name="unit" class="form-control" value="<?php echo $unit?>"  readonly="" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Vendor</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<select id="vendor" name="vendor" size="1" style="width: 130px;">
									<option value="">--pilih Vendor--</option>
									<?php
										$daft = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
										for ($i = 0; $i < count($daft); $i++) {
											echo '<option value="'.$daft[$i]['kode_vendor'].'">'.$daft[$i]['nama_vendor'].'</option>';
										}
									?>
								</select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Supplier</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<select id="suplier" name="suplier" size="1" style="width: 130px;">
									<option value="">--pilih Suplier--</option>
									<?php
										$daft = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
										for ($i = 0; $i < count($daft); $i++) {
											echo '<option value="'.$daft[$i]['kode_suplier'].'">'.$daft[$i]['nama_suplier'].'</option>';
										}
									?>
								</select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. RO</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<select id="no_ro" name="no_ro" size="1" style="width: 130px;" onchange="CariPasien(this.value)">
									<option value="">--No. RO/Permintaan--</option>
									<?php
										$daft = $db->query("select no_ro from tbl_ro where status_po='NOT' and total_permintaan > 0");
										for ($i = 0; $i < count($daft); $i++) {
											echo '<option value="'.$daft[$i]['no_ro'].'">'.$daft[$i]['no_ro'].'</option>';
										}
									?>
								</select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data PO" onclick="simpanData(this.form, 'pages/inv/input_po_insert.php')" />
							 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List PO" onclick="simpanData(this.form, 'index.php?mod=inv&submod=po')" />
                            </div></td>
                        </tr>
                    </table>
                </div>
                </td>
                <td><div id="data_pasien"></div></td>
            </tr>
        </table>
    </div>
</form>
</div>
