	<?php
		//include "../../header-sub.php";
		include "../../3rdparty/engine.php";
		$layanan = $db->query("select id as kode, name as nama from tbl_daerah_kec where regency_id='".$_POST['id']."'");
		
		if ($_POST['id'] != '') {
		    echo '<option value="">--Pilih Kecamatan--</option>';
			for ($i = 0; $i < count($layanan); $i++) {
				echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['nama'].'</option>';
			}
		}
		else {
		    echo '<option value="">--Pilih Kabupaten terlebih dahulu--</option>';
		}
	?>