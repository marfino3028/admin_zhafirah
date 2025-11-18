<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['rg_user'] != '') {
	if ($_POST['status_demo'] == "REGULER") {
    	$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, email) values ('" . $_POST['userid'] . "', '" . $_POST['nip'] . "', '" . md5($_POST['input-password']) . "', '" . $_POST['nama'] . "', 'ADMIN', '" . $_POST['telp'] . "', '2', '" . $_POST['email'] . "')", 0);
	}
	elseif ($_POST['status_demo'] == "DEMO") {
		$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, status_demo, hingga, email, jenis_akun) values ('" . $_POST['userid'] . "', '" . $_POST['nip'] . "', '" . md5($_POST['input-password']) . "', '" . $_POST['nama'] . "', 'ADMIN', '" . $_POST['telp'] . "', '2', '" . $_POST['status_demo'] . "', '" . $_POST['berlaku'] . "', '" . $_POST['email'] . "', 'DEMO')", 0);
	}
	elseif ($_POST['status_demo'] == "DOKTER") {
		$dokterD = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
		$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, email, jenis_akun) values ('" . $_POST['userid'] . "', '" . $_POST['nip'] . "', '" . md5($_POST['input-password']) . "', '" . $dokterD[0]['nama_dokter'] . "', '" . $dokterD[0]['kode_dokter'] . "', '" . $_POST['telp'] . "', '2', '" . $_POST['email'] . "', 'DOKTER')", 0);
	}
	elseif ($_POST['status_demo'] == "MCU") {
    	$insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code, telp, force_ganti, email, jenis_akun) values ('" . $_POST['userid'] . "', '" . $_POST['nip'] . "', '" . md5($_POST['input-password']) . "', '" . $_POST['nama'] . "', 'MCU', '" . $_POST['telp'] . "', '2', '" . $_POST['email'] . "', 'MCU')", 0);
	}
    //$insert = $db->query("INSERT INTO Authassigment (UserID, [AuthItem]) VALUES ('" . $_POST['userid'] . "', '" . $_POST['AuthItem'] . "')", 0);

    
}

header("location:../../index.php?mod=user&submod=user");
?>