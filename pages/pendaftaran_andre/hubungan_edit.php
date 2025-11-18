<script language="javascript">
	function pilihPoli(id) {
		var data = {id:id};
		
		if (id == 'LANGSUNG') { 
			var url = "pages/pendaftaran/view_langsung.php";
		}
		else {
			var url = "pages/pendaftaran/view_not_langsung.php";
		}
		$('#langsung').load(url,data, function(){
			$('#langsung').fadeIn('fast');
		});
	}

function simpanDataDaftar(t, url) {
	document.getElementById('form_karyawan').action = url;
	t.submit();
}
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Hubungan Keluarga Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/hubungan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
		<table border="1" cellpadding="0" style="border-collapse: collapse; width: 90%;" bordercolor="#000000">
			<tr height="28">
				<td width="160"><span style="margin-left:10px">Nama Suami/Pegawai</span></td>
				<td valign="middle" align="center">
				<div style="margin-bottom: 4px; margin-top: 4px;">
				<select id="hub_nomr" name="hub_nomr" size="1" style="width: 100%;">
					<?php
						$dts = $db->query("select * from tbl_hubungan_keluarga where id='".$_GET['id']."'");
						$poli = $db->query("select nomr, nm_pasien from tbl_pasien where status_delete='UD' and nm_pasien <> '' order by nm_pasien");
						for ($i = 0; $i < count($poli); $i++) {
							if ($dts[0]['nomr'] == $poli[$i]['nomr']) {
								echo '<option value="'.$poli[$i]['nomr'].'" selected>'.$poli[$i]['nm_pasien'].'</option>';
							}
							else {
								echo '<option value="'.$poli[$i]['nomr'].'">'.$poli[$i]['nm_pasien'].'</option>';
							}
						}
					?>
				</select>
				</div></td>
			</tr>
			<tr height="28">
				<td width="110"><span style="margin-left:10px">Nama Keluarga</span></td>
				<td valign="middle" align="center">
				<div style="margin-bottom: 4px; margin-top: 4px;">
				<input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" value="<?php echo $dts[0]['nama']?>" />
				</div></td>
			</tr>
			<tr height="28">
				<td width="110"><span style="margin-left:10px">Hubungan</span></td>
				<td valign="middle" align="center">
				<div style="margin-bottom: 4px; margin-top: 4px;">
				<input type="text" id="nama_hub" name="nama_hub" class="form-control" style="width: 100%;" value="<?php echo $dts[0]['hubungan']?>" />
				</div></td>
			</tr>
			<tr height="28">
				 <td width="110">&nbsp;</td>
				<td valign="top" align="center" >
				<div style="margin-bottom: 14px; margin-top: 4px; margin-left: 15px;">
				 <input type="hidden" id="id" name="id" value="<?php echo $dts[0]['id']?>" />
				 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanDataDaftar(this.form, 'pages/pendaftaran/hubungan_update.php')" />
				</div></td>
			</tr>
		</table>
    </div>
</form>
</div>
