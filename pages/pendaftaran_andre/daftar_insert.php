<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		
		if ($_POST['idmr'] == "") {
			echo '<script language="javascript">alert("Silahkan Gunakan NoMR yang Lain"); back(-1);</script>';
		}
		else {
			$biayaAdmin = $db->queryItem("select nilai from tbl_config where kode='ADMUMUM' and tahun='".date("Y")."'");
			$t1 = explode("/", $_POST['tgl_lahir']);
			$tanggal = $t1[2].'-'.$t1[0].'-'.$t1[1];
			$perusahaan = $db->queryItem("select nama_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
			$perusahaan_kode = $db->queryItem("select kode_perusahaan from tbl_perusahaan where id='".$_POST['kode_perusahaan']."'");
			
			//Cek Ststus Pasien jika lebih sekali berobat maka akan berubah Old
			//mengganti no_daftar menjadi nomr
			$cek_status = $db->queryItem("select count(nomr) from tbl_kasir where nomr='".$_POST['nomr']."'");
			if ($cek_status > 0) {
				$st_pasien = 'OLD';
			}
			else {
				$st_pasien = 'NEW';
			}
			
			if ($_POST['kd_poli'] == 'LANGSUNG') {
				//$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['medis']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['medis']."')", 0);
				if ($_POST['medis'] == 'SKS') {
					$biayaAdmin = $db->queryItem("select nilai from tbl_config where kode='ADMSKS'");
					$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, status_hub, nomr_hub, yang_berobat) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['medis']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['kd_dokter']."', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$_POST['keluarga']."')", 0);
				}
				else {
					$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, status_hub, nomr_hub, yang_berobat) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['medis']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['medis']."', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$_POST['keluarga']."')", 0);
				}
			}
			else {
				$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, status_hub, nomr_hub, yang_berobat) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['kd_poli']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['kd_dokter']."', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$_POST['keluarga']."')", 0);
			}			
			$update = $db->query("update tbl_pasien set status_pasien='$st_pasien' where nomr='".$_POST['nomr']."'", 0);
			header("location:../../index.php?mod=pendaftaran&submod=index");
		}
	}
?>