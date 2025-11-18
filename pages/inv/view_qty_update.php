<?php
    ini_set("display_errors", 0);
    include "../../3rdparty/engine.php";
	
    $noRO = $db->query("update tbl_ro_to_gudang_detail set qty='".$_POST['nilai']."' where id='".$_POST['id']."'");
    $dataRO = $db->query("select * from tbl_ro_to_gudang_detail where id='".$_POST['id']."'");
    $jmlRO = $db->query("select sum(qty) jumlah from tbl_ro_to_gudang_detail where ro_gudangID='".$dataRO[0]['ro_gudangID']."'");
    $update_jumlah = $db->query("update tbl_ro_to_gudang set total_permintaan='".$jmlRO[0]['jumlah']."' where id='".$dataRO[0]['ro_gudangID']."'");
    echo '<a href="#" onclick="UpdateQTY(\''.$_POST['id'].'\')">'.number_format($_POST['nilai']).'</a>';
    //print_r($_POST);
?>
