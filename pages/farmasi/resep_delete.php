<?php
session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['rg_user'] != '') {
	$delete = $db->query("delete from tbl_resep where md5(no_resep)='" . $_GET['id'] . "'", 1);
	$delete = $db->query("delete from tbl_resep_detail where md5(no_resep)='" . $_GET['id'] . "'", 0);

	$delete = $db->query("DELETE FROM tbl_racikan_detail WHERE racikanId IN (SELECT id FROM tbl_racikan WHERE md5(no_resep) = '" . $_GET['id'] . "')", 0);

	$delete = $db->query("DELETE FROM tbl_racikan WHERE md5(no_resep) = '" . $_GET['id'] . "'", 0);
}
header("location:../../index.php?mod=farmasi&submod=input_resep");
