<?php

session_start();
include "../../3rdparty/engine.php";

if ($_SESSION['at_user'] != '') {
    $insert = $db->query("insert into tbl_user (userid, nip, sandi, nama, code) values ('" . $_POST['userid'] . "', '" . $_POST['nip'] . "', '" . md5($_POST['password']) . "', '" . $_POST['nama'] . "', 'ADMIN')", 0);
    $insert = $db->query("INSERT INTO Authassigment (UserID, [AuthItem]) VALUES ('" . $_POST['userid'] . "', '" . $_POST['AuthItem'] . "')", 0);

    
}

header("location:../../index.php?mod=user&submod=user");
?>