<?php
	session_start();
	include "../../3rdparty/engine.php";
	//echo '<pre>';
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("insert into tbl_indikator (unit, bulantahun, jenis, nama, definisi, inklusi, eksklusi, numerator, denominator) values ('".$_POST['unit']."', '".$_POST['bulantahun']."-01', '".$_POST['level']."', '".$_POST['nama']."', '".$_POST['definisi']."', '".$_POST['inklusi']."', '".$_POST['eksklusi']."', '".$_POST['numerator']."', '".$_POST['denominator']."')");
		$id = mysql_insert_id();
		
		for ($i = 1; $i <= 31; $i++) {
			$var11 = 'numerator'.$i;
			$var12 = 'num'.$i;
			$var21 = 'denominator'.$i;
			$var22 = 'den'.$i;
			$update = $db->query("update tbl_indikator set $var12='".$_POST[$var11]."', $var22='".$_POST[$var21]."' where id='".$id."'");
			$total1 = $total1 + $_POST[$var11];
			$total2 = $total2 + $_POST[$var21];
		}
		$update = $db->query("update tbl_indikator set total_numerator='".$total1."', total_denominator='".$total2."' where id='".$id."'");
		header("location:../../index.php?mod=mutu&submod=index");

	}
?>