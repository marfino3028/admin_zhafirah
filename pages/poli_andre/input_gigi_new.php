<?php

	$ceknmr = $db->queryItem("select max(right(no_gigi, 3)*1) from tbl_gigi where left(right(no_gigi, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'GIG-'.date("dmY").$ceknmr;
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Transaksi Poli Gigi </div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="210">
                <div align="left" style="margin-top: 20px;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="210" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. Gigi</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_resep" name="no_resep" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">NoMR</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<select id="nodaftar" name="nodaftar" size="1" style="width: 130px;" onchange="CariPasien(this.value)">
									<option value="">--NoMR--</option>
									<?php
										$daft = $db->query("select * from tbl_pendaftaran where status_pasien='OPEN' and status_delete='UD'");
										for ($i = 0; $i < count($daft); $i++) {
											$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$daft[$i]['nomr']."'");
											echo '<option value="'.$daft[$i]['no_daftar'].'###'.$daft[$i]['nomr'].'">'.$daft[$i]['nomr'].'-'.$nama.'</option>';
										}
									?>
								</select>
                            </div></td>
                        </tr>
                        <!--<tr height="28">
                            <td width="110"><span style="margin-left:10px">Nomor MR</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nomr" name="nomr" class="form-control" onblur="CariPasien(this.value)" style="width: 120px" />
                            </div></td>
                        </tr>-->
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Poli Gigi" onclick="simpanData(this.form, 'pages/poli/input_gigi_insert.php')" />
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
