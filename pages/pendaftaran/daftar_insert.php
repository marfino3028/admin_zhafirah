<?php
	session_start();
	include "../../3rdparty/engine.php";
	//print_r($_POST);
	ini_set("display_errors", 0);
	date_default_timezone_set("Asia/Jakarta");
	
	if ($_SESSION['rg_user'] != '') {
		
	    $sebelum = $db->query("select status_pasien, id from tbl_pendaftaran where nomr='".$_POST['nomr']."' and status_pasien='OPEN' and status_delete='UD'", 0);
	$ceknmr = $db->queryItem("select max(right(no_daftar, 3)*1) from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."'", 0);
	$ceknmr2 = $db->queryItem("select a.panjang from (select LENGTH(no_daftar) as panjang from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."' group by LENGTH(no_daftar)) a order by a.panjang desc", 0);
	if ($ceknmr2 > 7) {
		$ceknmr = $db->queryItem("select max(right(no_daftar, 5)*1) from tbl_pendaftaran where left(no_daftar, 4)='".date("ym")."'", 0);
	}
		$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '000'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 1000) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 10000) $ceknmr = $ceknmr;
	$nomrDaftar = date("ym").$ceknmr;
	$_POST['no_daftar'] = $nomrDaftar;

	    if ($sebelum[0]['id'] < 1) {
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
			if ($dokPengirim[0]['professional_fee'] < 1) $dokPengirim[0]['professional_fee'] = 0;
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
				$paketMCU = $db->query("select id, nama from tbl_paketmcu_header where id='".$_POST['paket_mcu']."'", 0);
				if ($paketMCU[0]['id'] == "") $paketMCU[0]['id'] = 0;
				if ($_POST['medis'] == 'SKS') {
					$biayaAdmin = $db->queryItem("select nilai from tbl_config where kode='ADMSKS'");
					if ($_POST['kd_dokter'] == 'ONCALL') {
					    $_POST['kd_dokter'] = $_POST['kd_dokter_oncall'];
					    $_POST['kd_oncall'] = 'ONCALL';
					}
					else {
					    $_POST['kd_oncall'] = 'NOT';
					}
					$dokMCU_koordinator = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter_pengirim']."'");
					$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, status_hub, nomr_hub, yang_berobat, kelas_id, ruang_id, bed_id, nama_bed, tgl_insert, status_dokter, rujukan_kode, rujukan_nama, rujukan_rsid, rujukan_rsnama, dokter_pengirim_kode, dokter_pengirim_nama, dokter_pengirim_fee, dokumen_rujukan, paket_mcu_id, paket_mcu_nama, mcu_koordinator_kode, mcu_koordinator_nama) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['medis']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['kd_dokter']."', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$_POST['keluarga']."', '".$bed[0]['kelas_id']."', '".$bed[0]['kelas_ruang_id']."', '".$bed[0]['id']."', '".$bed[0]['nama']."', '".date("Y-m-d H:i:s")."', '".$_POST['kd_oncall']."', '$rujukan_kode', '$rujukan_nama', '$rujukan_rsid', '$rujukan_rsnama', '".$dokPengirim[0]['kode_dokter']."', '".$dokPengirim[0]['nama_dokter']."', '".$dokPengirim[0]['professional_fee']."', '$nama_file', '".$paketMCU[0]['id']."', '".$paketMCU[0]['nama']."', '".$_POST['paketmcu_koordinator']."', '".$_POST['paketmcu_koordinator']."')", 0);
					
					if ($_POST['paket_mcu'] != "") {
						$paketMCUDetail = $db->query("select * from tbl_paketmcu_detail where paketmcu_id='".$_POST['paket_mcu']."'", 0);
						$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
						for ($i = 0; $i < count($paketMCUDetail); $i++) {
							$idDokter = $paketMCUDetail[$i]['id'];
							if ($_POST['policy'][$idDokter] == "") $_POST['policy'][$idDokter] = "YES";
							$dokter_mcu = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['doktermcu'][$idDokter]."'");
							$insert = $db->query("insert into tbl_mcu_daftar (mcupaket_id, mcupaket_nama, mcu_paket_kategori, mcupaket, mcupaket_standard, mcupaket_asuransi, no_daftar, nomr, nama, dokter_kode, dokter_nama, status_digunakan) values ('".$paketMCUDetail[$i]['id']."', '".$paketMCUDetail[$i]['kategori_detail_nama']."', '".$paketMCUDetail[$i]['kategori']."', '".$paketMCUDetail[$i]['paketmcu_nama']."', '".$paketMCUDetail[$i]['standard']."', '".$paketMCUDetail[$i]['asuransi']."', '".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$pasien[0]['nm_pasien']."', '".$dokter_mcu[0]['kode_dokter']."', '".$dokter_mcu[0]['nama_dokter']."', '".$_POST['policy'][$idDokter]."')");
						}
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
					$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, status_hub, nomr_hub, yang_berobat, kelas_id, ruang_id, bed_id, nama_bed, tgl_insert, status_dokter, rujukan_kode, rujukan_nama, rujukan_rsid, rujukan_rsnama, dokter_pengirim_kode, dokter_pengirim_nama, dokter_pengirim_fee, dokumen_rujukan, paket_mcu_id, paket_mcu_nama, mcu_koordinator_kode, mcu_koordinator_nama) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['medis']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['kd_dokter']."', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$_POST['keluarga']."', '".$bed[0]['kelas_id']."', '".$bed[0]['kelas_ruang_id']."', '".$bed[0]['id']."', '".$bed[0]['nama']."', '".date("Y-m-d H:i:s")."', '".$_POST['kd_oncall']."', '$rujukan_kode', '$rujukan_nama', '$rujukan_rsid', '$rujukan_rsnama', '".$dokPengirim[0]['kode_dokter']."', '".$dokPengirim[0]['nama_dokter']."', '".$dokPengirim[0]['professional_fee']."', '$nama_file', '".$paketMCU[0]['id']."', '".$paketMCU[0]['nama']."', '".$_POST['paketmcu_koordinator']."', '".$_POST['paketmcu_koordinator']."')", 0);
					
					if ($_POST['paket_mcu'] != "") {
						$paketMCUDetail = $db->query("select * from tbl_paketmcu_detail where paketmcu_id='".$_POST['paket_mcu']."'", 0);
						$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
						for ($i = 0; $i < count($paketMCUDetail); $i++) {
							$idDokter = $paketMCUDetail[$i]['id'];
							if ($_POST['policy'][$idDokter] == "") $_POST['policy'][$idDokter] = "YES";
							$dokter_mcu = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['doktermcu'][$idDokter]."'");
							$insert = $db->query("insert into tbl_mcu_daftar (mcupaket_id, mcupaket_nama, mcu_paket_kategori, mcupaket, mcupaket_standard, mcupaket_asuransi, no_daftar, nomr, nama, dokter_kode, dokter_nama, status_digunakan) values ('".$paketMCUDetail[$i]['id']."', '".$paketMCUDetail[$i]['kategori_detail_nama']."', '".$paketMCUDetail[$i]['kategori']."', '".$paketMCUDetail[$i]['paketmcu_nama']."', '".$paketMCUDetail[$i]['standard']."', '".$paketMCUDetail[$i]['asuransi']."', '".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$pasien[0]['nm_pasien']."', '".$dokter_mcu[0]['kode_dokter']."', '".$dokter_mcu[0]['nama_dokter']."', '".$_POST['policy'][$idDokter]."')");
						}
					}
				}
			}
			else {
				$paketMCU = $db->query("select id, nama from tbl_paketmcu_header where id='".$_POST['paket_mcu']."'", 0);
				if ($paketMCU[0]['id'] == "") $paketMCU[0]['id'] = 0;
				if ($_POST['kd_dokter'] == 'ONCALL') {
				    $_POST['kd_dokter'] = $_POST['kd_dokter_oncall'];
				    $_POST['kd_oncall'] = 'ONCALL';
				}
				else {
				    $_POST['kd_oncall'] = 'NOT';
				}
				//print_r($_POST);
				$insert = $db->query("insert into  tbl_pendaftaran (no_daftar, nomr, kd_poli, status_pasien, tgl_daftar, kode_perusahaan, nama_perusahaan, biayaAdmin, kode_dokter, status_hub, nomr_hub, yang_berobat, kelas_id, ruang_id, bed_id, nama_bed, tgl_insert, status_dokter, rujukan_kode, rujukan_nama, rujukan_rsid, rujukan_rsnama, dokter_pengirim_kode, dokter_pengirim_nama, dokter_pengirim_fee, dokumen_rujukan, paket_mcu_id, paket_mcu_nama, mcu_koordinator_kode, mcu_koordinator_nama) values ('".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$_POST['kd_poli']."', 'OPEN', '".date("Y-m-d")."', '".$perusahaan_kode."', '".$perusahaan."', '".$biayaAdmin."', '".$_POST['kd_dokter']."', '".$_POST['hub']."', '".$_POST['hub_nomr']."', '".$_POST['keluarga']."', '".$bed[0]['kelas_id']."', '".$bed[0]['kelas_ruang_id']."', '".$bed[0]['id']."', '".$bed[0]['nama']."', '".date("Y-m-d H:i:s")."', '".$_POST['kd_oncall']."', '$rujukan_kode', '$rujukan_nama', '$rujukan_rsid', '$rujukan_rsnama', '".$dokPengirim[0]['kode_dokter']."', '".$dokPengirim[0]['nama_dokter']."', '".$dokPengirim[0]['professional_fee']."', '$nama_file', '".$paketMCU[0]['id']."', '".$paketMCU[0]['nama']."', '".$_POST['paketmcu_koordinator']."', '".$_POST['paketmcu_koordinator']."')", 0);
				//input resep baru
				$ceknmr = $db->queryItem("select max(right(no_resep, 3)*1) from tbl_resep where left(right(no_resep, 11), 8)='".date("dmY")."'", 0);
				$ceknmr = $ceknmr + 1;
				if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
				elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
				elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
				$no_resep = 'R-'.date("dmY").$ceknmr;
				$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
				$insert = $db->query("insert into  tbl_resep (no_resep, nomr, nama, tgl_input, total_harga, no_daftar, diagnosa, total_racikan) values ('".$no_resep."', '".$_POST['nomr']."', '".$nama."', '".date("Y-m-d")."', '0', '".$_POST['no_daftar']."', 'BELUM ADA', 0)", 0);
              
				if ($_POST['paket_mcu'] != "") {
					$paketMCUDetail = $db->query("select * from tbl_paketmcu_detail where paketmcu_id='".$_POST['paket_mcu']."'", 0);
					$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
					for ($i = 0; $i < count($paketMCUDetail); $i++) {
						$idDokter = $paketMCUDetail[$i]['id'];
						if ($_POST['policy'][$idDokter] == "") $_POST['policy'][$idDokter] = "YES";
						$dokter_mcu = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['doktermcu'][$idDokter]."'");
						$insert = $db->query("insert into tbl_mcu_daftar (mcupaket_id, mcupaket_nama, mcu_paket_kategori, mcupaket, mcupaket_standard, mcupaket_asuransi, no_daftar, nomr, nama, dokter_kode, dokter_nama, status_digunakan) values ('".$paketMCUDetail[$i]['id']."', '".$paketMCUDetail[$i]['kategori_detail_nama']."', '".$paketMCUDetail[$i]['kategori']."', '".$paketMCUDetail[$i]['paketmcu_nama']."', '".$paketMCUDetail[$i]['standard']."', '".$paketMCUDetail[$i]['asuransi']."', '".$_POST['no_daftar']."', '".$_POST['nomr']."', '".$pasien[0]['nm_pasien']."', '".$dokter_mcu[0]['kode_dokter']."', '".$dokter_mcu[0]['nama_dokter']."', '".$_POST['policy'][$idDokter]."')");
					}
				}
			}			
			$update = $db->query("update tbl_pasien set status_pasien='$st_pasien' where nomr='".$_POST['nomr']."'", 0);
			$diskon = $db->query("select discount from tbl_promo where id='".$_POST['diskon']."'");
			$update_daftar = $db->query("update tbl_pendaftaran set promo_diskon='".$diskon[0]['discount']."' where no_daftar='".$_POST['no_daftar']."'");

			//memasukkan ke tabel jurnal (Administrasi di Jurnal)
			$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
			$nodok = $no_do[0]['no_dokumen_nr'] + 1;
			if ($nodok < 10) $nodokumen = '00000'.$nodok;
			elseif ($nodok >= 10 and $nodok < 100) $nodokumen = '0000'.$nodok;
			elseif ($nodok >= 100 and $nodok < 1000) $nodokumen = '000'.$nodok;
			elseif ($nodok >= 1000 and $nodok < 10000) $nodokumen = '00'.$nodok;
			elseif ($nodok >= 10000 and $nodok < 100000) $nodokumen = '0'.$nodok;
			elseif ($nodok >= 100000 and $nodok < 1000000) $nodokumen = $nodok;
			$no_dokumen = date("y-m-d-").$nodokumen;
			$no_dokumen_nr = $nodokumen * 1;
			$tanggal = date("Y-m-d");
			$statuss = 'NOT POSTED';
			$tipe_dokumen = 'Patient UnBill';
			$petugas = $_SESSION['rg_user'];
			$mata_uang = 'Rupiah';
			$rate = 1;
			$supplier = '';
			$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
			$keterangan = 'Patient Transaction:  No. Reg.'.$_POST['no_daftar'].', Tarif Administrasi Poliklinik PS: '.$pasien[0]['nm_pasien'];
			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11030106'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			$deskripsi = 'Tarif Administrasi Poliklinik PS: '.$pasien[0]['nm_pasien'];
						
			$jml_kunjungan = $db->query("select count(id) jumlah from tbl_kasir where nomr='" . $_POST['nomr'] . "'");
			//print_r($jml_kunjungan[0]['jumlah']);
			if ($jml_kunjungan[0]['jumlah'] > 1) {
				$admPasien = $db->query("select nilai from tbl_config where kode='ADMOLD' and tahun='" . date("Y") . "'");
			} else {
				$admPasien = $db->query("select nilai from tbl_config where kode='ADMNEW' and tahun='" . date("Y") . "'");
			}
			// ($coa[0]['default_pos'] == 'Debit') {
				$debet = $admPasien[0]['nilai'];
				$kredit = 0;
			//}
			//elseif ($coa[0]['default_pos'] == 'Credit') {
				//$debet = 0;
				//$kredit = $admPasien[0]['nilai'];
			//}

			$reg_no = $_POST['no_daftar'];
			$cost_center_kode = '1124';
			$cost_center_nama = 'LAYANAN HEMODIALISA';
			
			//insert Administrasi di Jurnal
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debet."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='41010203'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			if ($coa[0]['default_pos'] == 'Debit') {
				$debet = $admPasien[0]['nilai'];
				$kredit = 0;
			}
			elseif ($coa[0]['default_pos'] == 'Credit') {
				$debet = 0;
				$kredit = $admPasien[0]['nilai'];
			}
			//insert Administrasi di Jurnal
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debet."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);


			//memasukkan ke tabel jurnal (Konsul di Jurnal)
			$no_do = $db->query("select no_dokumen_nr from tbl_jurnal order by no_dokumen_nr desc");
			$nodok = $no_do[0]['no_dokumen_nr'] + 1;
			if ($nodok < 10) $nodokumen = '00000'.$nodok;
			elseif ($nodok >= 10 and $nodok < 100) $nodokumen = '0000'.$nodok;
			elseif ($nodok >= 100 and $nodok < 1000) $nodokumen = '000'.$nodok;
			elseif ($nodok >= 1000 and $nodok < 10000) $nodokumen = '00'.$nodok;
			elseif ($nodok >= 10000 and $nodok < 100000) $nodokumen = '0'.$nodok;
			elseif ($nodok >= 100000 and $nodok < 1000000) $nodokumen = $nodok;
			$no_dokumen = date("y-m-d-").$nodokumen;
			$no_dokumen_nr = $nodokumen * 1;
			$tanggal = date("Y-m-d");
			$statuss = 'NOT POSTED';
			$tipe_dokumen = 'Patient UnBill';
			$petugas = $_SESSION['rg_user'];
			$mata_uang = 'Rupiah';
			$rate = 1;
			$supplier = '';
			$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$_POST['nomr']."'");
			$dokter = $db->query("select nama_dokter, tarif_dokter from tbl_dokter where kode_dokter='".$_POST['kd_dokter']."'");
			$keterangan = 'Patient Transaction:  No. Reg.'.$_POST['no_daftar'].', Konsultasi Dokter: ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];
			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11030106'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			$deskripsi = 'KONSULTASI DOKTER ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];
			$dtarif = $db->query("select * from tbl_poli where kd_poli='".$_POST['kd_poli']."'");
			$reg_no = $_POST['no_daftar'];
			$cost_center_kode = $dtarif[0]['kd_profit'];
			$cost_center_nama = $dtarif[0]['nm_profit'];
			//if ($coa[0]['default_pos'] == 'Debit') {
				$debet = $dtarif[0]['tarif'];
				$kredit = 0;
			//}
			//elseif ($coa[0]['default_pos'] == 'Credit') {
				//$debet = 0;
				//$kredit = $dtarif[0]['tarif'];
			//}

			//insert Administrasi di Jurnal
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debet."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);
			
			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='41010106'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			if ($coa[0]['default_pos'] == 'Debit') {
				$debet = $dtarif[0]['tarif'];
				$kredit = 0;
			}
			elseif ($coa[0]['default_pos'] == 'Credit') {
				$debet = 0;
				$kredit = $dtarif[0]['tarif'];
			}
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '$debet', '$kredit', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='51010105'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			if ($coa[0]['default_pos'] == 'Debit') {
				$debet = $dokter[0]['tarif_dokter'];
				$kredit = 0;
			}
			elseif ($coa[0]['default_pos'] == 'Credit') {
				$debet = 0;
				$kredit = $dokter[0]['tarif_dokter'];
			}
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '$debet', '$kredit', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

			$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='21020013'");
			$gl_kode = $coa[0]['kd_coa'];
			$gl_nama = $coa[0]['nm_coa'];
			if ($coa[0]['default_pos'] == 'Debit') {
				$debet = $dokter[0]['tarif_dokter'];
				$kredit = 0;
			}
			elseif ($coa[0]['default_pos'] == 'Credit') {
				$debet = 0;
				$kredit = $dokter[0]['tarif_dokter'];
			}
			$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '$debet', '$kredit', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

			if ($_POST['idOTC'] != "") {
			    $update = $db->query("update tbl_perjanjian set status_daftar='SDH', no_daftar='".$_POST['no_daftar']."' where md5(id)='".$_POST['idOTC']."'", 0);
			}
			header("location:../../index.php?mod=pendaftaran&submod=index");
		}
	    }
	    else {
		//echo 'test';
?>
	<script>
		//alert("Hello! I am an alert box!!");
		alert("Data Registrasi Sudah Ada, Silahkan selesaikan terlebih dahulu Registrasinya,!!");
		window.location = "../../index.php?mod=pendaftaran&submod=daftar";
	</script>
<?php
	    }
	}
?>