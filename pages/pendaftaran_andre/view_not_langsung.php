<tr height="28">
	<td width="110"><span style="margin-left:10px">Pilih Dokter</span></td>
	<td valign="middle" align="center">
	<div style="margin-bottom: 4px; margin-top: 4px;">
	<select id="kd_dokter" name="kd_dokter" size="1" style="width: 140px; font-size: 12px">
		<option value="">--Pilih Dokter--</option>
		<?php
			include "../../3rdparty/engine.php";
			$poli = $db->query("select * from tbl_dokter where status_delete='UD'");
			for ($i = 0; $i < count($poli); $i++) {
				echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
			}
		?>
	</select>
	</div></td>
</tr>