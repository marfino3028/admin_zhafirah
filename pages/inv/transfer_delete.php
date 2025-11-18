<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		$dtt = $db->query("select * from tbl_transfer where id='".$_GET['id']."'");
		$dt = $db->query("select * from tbl_transfer_detail where transferID='".$_GET['id']."'");
		$update = $db->query("update tbl_ro_to_gudang set status_pakai='BLM' where no_ro_gudang='".$dtt[0]['no_ro_gudang']."'");
		
		//Hapus header
		$insert = $db->query("delete from tbl_transfer where id='".$_GET['id']."'");
		
		//insert ke detail transfer
		for ($i = 0; $i < count($dt); $i++) {
			$d = $db->query("select * from tbl_transfer_detail where id='".$dt[$i]['id']."'");
			$insert = $db->query("delete from tbl_transfer_detail where id='".$dt[$i]['id']."'");
			
			//update stock obat
			$update = $db->query("update tbl_obat set stock_akhir=stock_akhir-".$dt[0]['qty']." where kode_obat='".$d[0]['kode_obat']."'");
		}
	}
	header("location:../../index.php?mod=inv&submod=transfer");
?>
