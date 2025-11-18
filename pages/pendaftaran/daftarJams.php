<?php
	$ceknmr = $db->queryItem("select max(right(no_daftar, 3)*1) from tbl_pendaftaran_jamsostek where left(no_daftar, 4)='".date("ym")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = date("ym").$ceknmr;
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien_jamsostek.php";
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
    <div class="portlet-header ui-widget-header">Form Tambah Data Pendaftaran Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="210">
                <div align="left" style="margin-top: 20px; width: 210px; overflow: inherit">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="210" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. Pendaftaran</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_daftar" name="no_daftar" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nomor MR</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <!--<select id="nomr" name="nomr" size="1" style="width: 110px; font-size: 12px;" onchange="CariPasien(this.value)">
                            	<option value="">--Pilih KPJ--</option>
                                <?php
									$poli = $db->query("select * from tbl_pasien_jamsostek order by nomr");
									for ($i = 0; $i < count($poli); $i++) {
										echo '<option value="'.$poli[$i]['id'].'">'.$poli[$i]['nomr'].'-'.$poli[$i]['nm_pasien'].'</option>';
									}
								?>
                            </select>-->
                            <input type="text" id="nomr" name="nomr" class="form-control" onblur="CariPasien(this.value)" style="width: 100px" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Pilih Poli</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="kd_poli" name="kd_poli" size="1" style="width: 110px; font-size: 12px;">
                            	<option value="">--Pilih Poli--</option>
                                <?php
									$poli = $db->query("select * from tbl_poli where status_delete='UD'");
									for ($i = 0; $i < count($poli); $i++) {
										echo '<option value="'.$poli[$i]['kd_poli'].'">'.$poli[$i]['nama_poli'].'</option>';
									}
								?>
                            </select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Pilih Dokter</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="kd_dokter" name="kd_dokter" size="1" style="width: 110px; font-size: 12px">
                            	<option value="">--Pilih Dokter--</option>
                                <?php
									$poli = $db->query("select * from tbl_dokter where status_delete='UD'");
									for ($i = 0; $i < count($poli); $i++) {
										echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
									}
								?>
                            </select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 4px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pendaftaran" onclick="simpanData(this.form, 'pages/pendaftaran/daftarJams_insert.php')" />
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
