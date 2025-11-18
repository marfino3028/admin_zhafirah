<?php
	session_start();
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_menu where id='".$_POST['id']."'", 0);
		//cek apakah user sudah terdaftar apa belum
		$cek = $db->queryItem("select id from tbl_user_menu where userid='".$_POST['user']."' and menu_id='".$data[0]['id']."' and kategori_sub_id='".$data[0]['kategori_id']."'");
		if ($cek > 0) {
			$hapus = $db->query("delete from tbl_user_menu where userid='".$_POST['user']."' and menu_id='".$data[0]['id']."' and kategori_sub_id='".$data[0]['kategori_id']."'", 0);
		}
		else {
			$insert = $db->query("insert into tbl_user_menu (userid, menu_id, kategori_sub_id, hak_akses) values ('".$_POST['user']."', '".$data[0]['id']."', '".$data[0]['kategori_id']."', '0')");
		}
	}
	//print_r($_POST);
?>