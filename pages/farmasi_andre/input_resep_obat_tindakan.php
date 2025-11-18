<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
?>
<table border="0" cellpadding="0" style="border-collapse: collapse;">
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Nama Tindakan</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<select id="obat_tindakan" name="obat_tindakan" size="1" style="width: 190px;" tabindex="5" onchange="PilihTindakan(this.value)">
			<option value="">--Pilih Tindakan--</option>
			<?php
				$obat = $db->query("select * from tbl_tarif where kode_jns_tarif='2' and status_delete='UD'");
				for ($i = 0; $i < count($obat); $i++) {
					echo '<option value="'.$obat[$i]['kode_tarif'].'">'.$obat[$i]['nama_pelayanan'].'</option>';
				}
			?>
		</select>
		</div></td>
	</tr>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Tarif Tindakan</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;" id="TarifTindakan">
			<input type="text" id="tTindakan" name="tTindakanText" value="0" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
			<input type="hidden" id="tTindakan" name="tTindakan" value="0" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
		</div></td>
	</tr>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Qty/Jml</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
			<input type="text" id="qty" name="qty" value="1" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
		</div></td>
	</tr>
	<tr height="28">
		<td valign="middle" align="center" colspan="2">
		<div style="margin-bottom: 4px; margin-top: 4px; text-align: center">
			<input type="button" value="Simpan Tindakan" onclick="TambahTindakan()" />
		</div></td>
	</tr>
</table>
