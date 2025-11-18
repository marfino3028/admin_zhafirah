<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
      $data = $db->query("select * from tbl_lab_detail where md5(no_lab)='".$_POST['no_lab']."'");
      for ($i = 0; $i < count($data); $i++) {
      	$hasil = "hasil".$data[$i]['id'];
      	$normal = "normal".$data[$i]['id'];
      	$satuan = "satuan".$data[$i]['id'];
        $update = $db->query("update tbl_lab_detail set hasil='".$_POST[$hasil]."', normal='".$_POST[$normal]."', satuan='".$_POST[$satuan]."' where id='".$data[$i]['id']."'", 0);
      }
	}
    header("location:../../index.php?mod=penunjang_medis&submod=labInput");
?>