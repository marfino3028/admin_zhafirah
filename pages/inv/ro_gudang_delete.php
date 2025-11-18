<?php
session_start();
include "../../3rdparty/engine.php";
ini_set("display_errors", 0);

if ($_SESSION['rg_user'] != '') {
    $id =  $_GET['id'];
    $header = $db->query("SELECT * FROM tbl_ro_to_gudang WHERE id = $id", 0)[0];
    $no_PO = $header['no_ro_gudang'];

    $cekTransfer = $db->query("SELECT * FROM tbl_transfer WHERE no_ro_gudang = '$no_PO'");

    if (count($cekTransfer) > 0) {
    } else {
        $db->query("DELETE FROM tbl_ro_to_gudang WHERE no_ro_gudang = '$no_PO'");
        $db->query("DELETE FROM tbl_ro_to_gudang_detail WHERE no_ro_gudang = '$no_PO'");
    }

    header("location:../../index.php?mod=inv&submod=ApotikGudang");
}
