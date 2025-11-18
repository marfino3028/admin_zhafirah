<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
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
          	$bed = $db->query("select * from tbl_kelas_ruang_bed where id='".$_POST['kasur']."'");
          	$dokPengirim = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter_pengirim']."'");
          	if ($bed[0]['kelas_id'] == "") $bed[0]['kelas_id'] = 0;
          	if ($bed[0]['kelas_ruang_id'] == "") $bed[0]['kelas_ruang_id'] = 0;
          	if ($bed[0]['id'] == "") $bed[0]['id'] = 0;


		if ($_FILES['dokumen']['name'] != "") {
			//print_r($_POST);
			$path = $_FILES['dokumen']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$nama_file = 'RUJUKAN-'.date("d_F_Y_H_i_s").'.'.$ext;
			@copy($_FILES['dokumen']['tmp_name'], '../../dokumen/'.$nama_file);
		}
		else {
			$nama_file = "";
		}
			
			//Cek Ststus Pasien jika lebih sekali berobat maka akan berubah Old
			//mengganti no_daftar menjadi nomr
			$cek_status = $db->queryItem("select count(nomr) from tbl_kasir where nomr='".$_POST['nomr']."'");
			if ($cek_status > 0) {
				$st_pasien = 'OLD';
			}
			else {
				$st_pasien = 'NEW';
			}
			
			//untuk rumah sakit rujukan
			if ($_POST['rujukan'] == '01') {
			    $rujukan_kode = '01';
			    $rujukan_nama = 'Inisiatif Sendiri';
			    $rujukan_rsid = '0';
			    $rujukan_rsnama = '-';
			}
			elseif ($_POST['rujukan'] == '02') {
			    $rujukan_kode = '02';
			    $rujukan_nama = 'Luar RS/Klinik';
			    $rujukan_rsid = $_POST['rujukan_nama'];
			    $rujukanrs = $db->query("select nama from tbl_rujukan where id='".$_POST['rujukan_nama']."'");
			    $rujukan_rsnama = $rujukanrs[0]['nama'];
			}
			elseif ($_POST['rujukan'] == '03') {
			    $rujukan_kode = '03';
			    $rujukan_nama = 'Faskes BPJS';
			    $rujukan_rsid = 'BPJS';
			    $rujukan_rsnama = $_POST['rujukan_nama'];
			}
			
			if ($_POST['kd_poli'] == 'LANGSUNG') {
				//$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, dokter_pengirim_kode, dokter_pengirim_nama, dokter_pengirim_fee) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['medis']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['medis']."', '".$dokPengirim[0]['kode_dokter']."', '".$dokPengirim[0]['nama_dokter']."', '".$dokPengirim[0]['professional_fee']."')", 0);
				if ($_POST['medis'] == 'SKS') {
					$biayaAdmin = $db->queryItem("select nilai from tbl_config where kode='ADMSKS'");
					if ($_POST['kd_dokter'] == 'ONCALL') {
					    $_POST['kd_dokter'] = $_POST['kd_dokter_oncall'];
					    $_POST['kd_oncall'] = 'ONCALL';
					}
					else {
					    $_POST['kd_oncall'] = 'NOT';
					}
					$insert = $db->query("update tbl_pendaftaran set kd_poli='".$_POST['kd_poli']."', kode_perusahaan='".$perusahaan_kode."', nama_perusahaan='".$perusahaan."', biayaAdmin='".$biayaAdmin."', kode_dokter='".$_POST['kd_dokter']."', kelas_id='".$bed[0]['kelas_id']."', ruang_id='".$bed[0]['kelas_ruang_id']."', bed_id='".$bed[0]['id']."', nama_bed='".$bed[0]['nama']."', status_dokter='".$_POST['kd_oncall']."', rujukan_kode='$rujukan_kode', rujukan_nama='$rujukan_nama', rujukan_rsid='$rujukan_rsid', rujukan_rsnama='$rujukan_rsnama', dokter_pengirim_kode='".$dokPengirim[0]['kode_dokter']."', dokter_pengirim_nama='".$dokPengirim[0]['nama_dokter']."', dokter_pengirim_fee='".$dokPengirim[0]['professional_fee']."', dokumen_rujukan='$nama_file' where md5(id)='".$_POST['IDDATA']."'", 0);
				}
				else {
					if ($_POST['kd_dokter'] == 'ONCALL') {
					    $_POST['kd_dokter'] = $_POST['kd_dokter_oncall'];
					    $_POST['kd_oncall'] = 'ONCALL';
					}
					else {
					    $_POST['kd_oncall'] = 'NOT';
					}
					$insert = $db->query("update tbl_pendaftaran set kd_poli='".$_POST['kd_poli']."', kode_perusahaan='".$perusahaan_kode."', nama_perusahaan='".$perusahaan."', biayaAdmin='".$biayaAdmin."', kode_dokter='".$_POST['kd_dokter']."', kelas_id='".$bed[0]['kelas_id']."', ruang_id='".$bed[0]['kelas_ruang_id']."', bed_id='".$bed[0]['id']."', nama_bed='".$bed[0]['nama']."', status_dokter='".$_POST['kd_oncall']."', rujukan_kode='$rujukan_kode', rujukan_nama='$rujukan_nama', rujukan_rsid='$rujukan_rsid', rujukan_rsnama='$rujukan_rsnama', dokter_pengirim_kode='".$dokPengirim[0]['kode_dokter']."', dokter_pengirim_nama='".$dokPengirim[0]['nama_dokter']."', dokter_pengirim_fee='".$dokPengirim[0]['professional_fee']."', dokumen_rujukan='$nama_file' where md5(id)='".$_POST['IDDATA']."'", 0);
				}
			}
			else {
				if ($_POST['kd_dokter'] == 'ONCALL') {
				    $_POST['kd_dokter'] = $_POST['kd_dokter_oncall'];
				    $_POST['kd_oncall'] = 'ONCALL';
				}
				else {
				    $_POST['kd_oncall'] = 'NOT';
				}
				$insert = $db->query("update tbl_pendaftaran set kd_poli='".$_POST['kd_poli']."', kode_perusahaan='".$perusahaan_kode."', nama_perusahaan='".$perusahaan."', biayaAdmin='".$biayaAdmin."', kode_dokter='".$_POST['kd_dokter']."', kelas_id='".$bed[0]['kelas_id']."', ruang_id='".$bed[0]['kelas_ruang_id']."', bed_id='".$bed[0]['id']."', nama_bed='".$bed[0]['nama']."', status_dokter='".$_POST['kd_oncall']."', rujukan_kode='$rujukan_kode', rujukan_nama='$rujukan_nama', rujukan_rsid='$rujukan_rsid', rujukan_rsnama='$rujukan_rsnama', dokter_pengirim_kode='".$dokPengirim[0]['kode_dokter']."', dokter_pengirim_nama='".$dokPengirim[0]['nama_dokter']."', dokter_pengirim_fee='".$dokPengirim[0]['professional_fee']."', dokumen_rujukan='$nama_file' where md5(id)='".$_POST['IDDATA']."'", 0);
              
			}			
			header("location:../../index.php?mod=pendaftaran&submod=index");
		}
	}
?>