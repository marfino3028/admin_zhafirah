<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['rg_user'] != '') {
    $mn = explode("###", $_POST['menu']);
    $insert = $db->query("insert into tbl_user_menu (userid, menu_id, hak_akses, kategori_sub_id) values ('" . $_POST['user'] . "', '" . $mn[0] . "', '" . $_POST['hak_akses'] . "', '" . $mn[1] . "')", 0);
    //print_r($_POST);
}
header("location:../../index.php?mod=user&submod=previlage");
?>