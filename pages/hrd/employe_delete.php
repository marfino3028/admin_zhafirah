<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['at_user'] != '') {
    $delete = $db->query("delete from tbl_karyawan where id='" . $_GET['id'] . "'", 0);
	$insert_log = $db->query("insert into tbl_log_user (userid, nama, melakukan) values ('".$_SESSION['at_user']."', '".$_SESSION['at_nama']."', 'Hapus Data Karyawan')");
}
header("location:../../index.php?mod=master&submod=employe");
?>