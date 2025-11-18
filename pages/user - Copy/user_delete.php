<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['at_user'] != '') {
    $delete = $db->query("delete from tbl_user where id='" . $_GET['id'] . "'", 0);
}
header("location:../../index.php?mod=user&submod=user");
?>