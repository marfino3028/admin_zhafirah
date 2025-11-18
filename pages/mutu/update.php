<?php
	session_start();
	include "../../3rdparty/engine.php";
	echo '<pre>';
	print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$insert = $db->query("update tbl_indikator set unit='".$_POST['unit']."', bulantahun='".$_POST['bulantahun']."-01', jenis='".$_POST['level']."', nama='".$_POST['nama']."', definisi='".$_POST['definisi']."', inklusi='".$_POST['inklusi']."', eksklusi='".$_POST['eksklusi']."', numerator='".$_POST['numerator']."', denominator='".$_POST['denominator']."' where md5(id)='".$_POST['id']."'");
		$id = $_POST['id'];
		
		for ($i = 1; $i <= 31; $i++) {
			$var11 = 'numerator'.$i;
			$var12 = 'num'.$i;
			$var21 = 'denominator'.$i;
			$var22 = 'den'.$i;
			$update = $db->query("update tbl_indikator set $var12='".$_POST[$var11]."', $var22='".$_POST[$var21]."' where md5(id)='".$id."'");
			$total1 = $total1 + $_POST[$var11];
			$total2 = $total2 + $_POST[$var21];
		}
		$update = $db->query("update tbl_indikator set total_numerator='".$total1."', total_denominator='".$total2."' where md5(id)='".$id."'");
		header("location:../../index.php?mod=mutu&submod=index");

	}
?>