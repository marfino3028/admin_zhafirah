<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['at_user'] != '') {
	if ($_POST['password'] == '') {
		$update = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', nama='" . $_POST['nama'] . "' where id='" . $_POST['id'] . "'", 0);
	}
	else {
    	$update = $db->query("update tbl_user set nip='" . $_POST['nip'] . "', sandi='" . md5($_POST['password']) . "', nama='" . $_POST['nama'] . "' where id='" . $_POST['id'] . "'", 0);
	}
}
header("location:../../index.php?mod=user&submod=user");
?>