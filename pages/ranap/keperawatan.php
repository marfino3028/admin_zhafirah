<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_resep where md5(id)='".$_GET['id']."'");
		//print_r($data);
      	$cek = $db->queryItem("select id from tbl_rawat where no_daftar='".$data[0]['no_daftar']."'");
      	if ($cek > 0) {
			header("location:../../index.php?mod=ranap&submod=input_rawat_tindakan&id=".$cek);
        }
      	else {
            $ceknmr = $db->queryItem("select max(right(no_rawat, 3)*1) from tbl_rawat where left(right(no_rawat, 11), 8)='".date("dmY")."'", 1);
            $ceknmr = $ceknmr + 1;
            if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
            elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
            elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
            $nolab = 'RAWAT-'.date("dmY").$ceknmr;
          	//echo "Buat Rad Baru dengan nomor $nolab";
          	//Masukkan ke tabel RAD
          	$insert = $db->query("insert into tbl_rawat (no_rawat, nomr, nama, tgl_input_rawat, total_harga_rawat, no_daftar) values ('$nolab', '".$data[0]['nomr']."', '".$data[0]['nama']."', '".date("Y-m-d")."', '0', '".$data[0]['no_daftar']."')", 0);
          	$id = mysql_insert_id();
          	header("location:../../index.php?mod=ranap&submod=input_rawat_tindakan&id=".$id);
        }
		
	}
?>