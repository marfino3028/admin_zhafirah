<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['rg_user'] != '') {
	if ($_POST['status_demo'] == "REGULER") {
		if ($_POST['input-password'] == "") {
			$insert = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', nama='" . $_POST['nama'] . "', code='ADMIN', telp='" . $_POST['telp'] . "', email='" . $_POST['email'] . "' where md5(id)='" . $_POST['id'] . "'", 0);
		}
		else {
    		$insert = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', sandi='" . md5($_POST['input-password']) . "', nama='" . $_POST['nama'] . "', code='ADMIN', telp='" . $_POST['telp'] . "', email='" . $_POST['email'] . "' where md5(id)='" . $_POST['id'] . "'", 0);
		}
	}
	elseif ($_POST['status_demo'] == "DEMO") {
		if ($_POST['input-password'] == "") {
			$insert = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', nama='" . $_POST['nama'] . "', code='ADMIN', telp='" . $_POST['telp'] . "', status_demo='" . $_POST['status_demo'] . "', hingga='" . $_POST['berlaku'] . "', email='" . $_POST['email'] . "', jenis_akun='DEMO' where md5(id)='" . $_POST['id'] . "'", 0);
		}
		else {
			$insert = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', sandi='" . md5($_POST['input-password']) . "', nama='" . $_POST['nama'] . "', code='ADMIN', telp='" . $_POST['telp'] . "', status_demo='" . $_POST['status_demo'] . "', hingga='" . $_POST['berlaku'] . "', email='" . $_POST['email'] . "', jenis_akun='DEMO' where md5(id)='" . $_POST['id'] . "'", 0);
		}
	}
	elseif ($_POST['status_demo'] == "DOKTER") {
		$dokterD = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
		if ($_POST['input-password'] == "") {
			$insert = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', nama='" . $dokterD[0]['nama_dokter'] . "', code='" . $dokterD[0]['kode_dokter'] . "', telp='" . $_POST['telp'] . "', email='" . $_POST['email'] . "', jenis_akun='DOKTER' where md5(id)='" . $_POST['id'] . "'", 0);
		}
		else {
			$insert = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', sandi='" . md5($_POST['input-password']) . "', nama='" . $dokterD[0]['nama_dokter'] . "', code='" . $dokterD[0]['kode_dokter'] . "', telp='" . $_POST['telp'] . "', email='" . $_POST['email'] . "', jenis_akun='DOKTER' where md5(id)='" . $_POST['id'] . "'", 0);
		}
	}
    //$insert = $db->query("INSERT INTO Authassigment (UserID, [AuthItem]) VALUES ('" . $_POST['userid'] . "', '" . $_POST['AuthItem'] . "')", 0);

    
}

header("location:../../index.php?mod=user&submod=user");
?>