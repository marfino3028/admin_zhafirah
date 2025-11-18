	<div style="margin-bottom: 4px; margin-top: 4px;">
	<select id="keluarga" name="keluarga" size="1" style="width: 140px; font-size: 12px">
		<option value="">--Pilih Keluarga--</option>
		<?php
			include "../../3rdparty/engine.php";
			$poli = $db->query("select * from tbl_hubungan_keluarga where nomr='".$_POST['id']."'");
			echo '<option value="'.$poli[0]['nomr_nama'].' (Diri Sendiri)">'.$poli[0]['nomr_nama'].' (Diri Sendiri)</option>';
			for ($i = 0; $i < count($poli); $i++) {
				echo '<option value="'.$poli[$i]['nama'].' - '.$poli[$i]['hubungan'].'">'.$poli[$i]['nama'].' - '.$poli[$i]['hubungan'].'</option>';
			}
		?>
	</select>
	</div>