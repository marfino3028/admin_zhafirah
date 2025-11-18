<?php
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');
session_start();
include "../../3rdparty/engine.php";
print_r($_POST);
ini_set("display_errors", 1);
extract($_POST);
if (isset($_POST)) {
    $subject = $_POST['subject'];
    $object = $_POST['object'];
    $assesment = $_POST['assesment'];
    $planning = $_POST['planning'];
    $id = $_POST['id'];
    $update = $db->query("update tbl_fisio set subject='$subject', object='$object', assesment='$assesment', planning='$planning', tgl_soap='$tgl' where id='$id'", 1);
    //echo "<script>window.location = '../../index.php?mod=dokter&submod=worklist_list'</script>";
}
