<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo "<pre>";
	print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
		//mana yang akan ditambahin
		$paket = $db->query("select * from tbl_paketmcu_header where md5(id)='".$_POST['id']."'");
		print_r($paket);
		if ($_POST['modul_mcu']	!= "" and $_POST['lab']	== "" and $_POST['rad']	== "") {
			$modulmcu = $db->query("select * from tbl_modul_mcu where id='".$_POST['modul_mcu']."'", 0);
			$komponen = $db->query("select * from tbl_tarif where id='".$modulmcu[0]['komponen_id']."'", 1);
			print_r($modulmcu);
			//masukkan ke detal
			$insert = $db->query("insert into tbl_paketmcu_detail (paketmcu_id, paketmcu_nama, kategori, kategori_detail_id, kategori_detail_nama, standard, asuransi) values ('".$paket[0]['id']."', '".$paket[0]['nama']."', 'MODULMCU', '".$modulmcu[0]['komponen_id']."', '".$modulmcu[0]['nama']."', '".$modulmcu[0]['total']."', '".$modulmcu[0]['total']."')", 1);
		}
		elseif ($_POST['modul_mcu']	== "" and $_POST['lab']	!= "" and $_POST['rad']	== "") {
			$komponen = $db->query("select * from tbl_tarif where id='".$_POST['lab']."'");
			print_r($komponen);
			$insert = $db->query("insert into tbl_paketmcu_detail (paketmcu_id, paketmcu_nama, kategori, kategori_detail_id, kategori_detail_nama, standard, asuransi) values ('".$paket[0]['id']."', '".$paket[0]['nama']."', 'LABORATORIUM', '".$_POST['lab']."', '".$komponen[0]['nama_pelayanan']."', '".$komponen[0]['tarif_max']."', '".$komponen[0]['tarif_max']."')");
		}
		elseif ($_POST['modul_mcu']	== "" and $_POST['lab']	== "" and $_POST['rad']	!= "") {
			$komponen = $db->query("select * from tbl_tarif where id='".$_POST['rad']."'");
			print_r($komponen);
			$insert = $db->query("insert into tbl_paketmcu_detail (paketmcu_id, paketmcu_nama, kategori, kategori_detail_id, kategori_detail_nama, standard, asuransi) values ('".$paket[0]['id']."', '".$paket[0]['nama']."', 'RADIOLOGI', '".$_POST['rad']."', '".$komponen[0]['nama_pelayanan']."', '".$komponen[0]['tarif_max']."', '".$komponen[0]['tarif_max']."')", 1);
		}
		header("location:../../index.php?mod=mcu&submod=paket_detail&id=".$_POST['id']);
	}
?>?>