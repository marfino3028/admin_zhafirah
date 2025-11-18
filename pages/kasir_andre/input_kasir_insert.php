<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$tst = explode("JAMSOSTEK", $_POST['nodaftar']);
		if ($tst[0] == 1) {
			$data = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$insert = $db->query("insert into tbl_kasir (no_kwitansi, no_daftar, nomr, nama, kode_perusahaan, nama_perusahaan, subtotal, diskon, total, metode_payment, no_kartu, nama_bank, user_insert, user_shift, penjamin, pembulatan, jml_pembulatan) values ('".$_POST['no_kwitansi']."', 'JAM-".$tst[1]."', '".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', 'JJJ030', 'JAMSOSTEK', '".$_POST['total_bayar']."', '".$_POST['diskon']."', '".$_POST['total_bayar_all']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['NamaBank']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".$_POST['penjamin']."', '".$_POST['pembulatan']."', '".$_POST['jml_bulat']."')", 0);
			$id = mysql_insert_id();
			$update = $db->query("update tbl_pendaftaran_jamsostek set status_pasien='CLOSED' where no_daftar='".$tst[1]."'", 0);
			
			//insert ke tabel Detail
			// dimulai dengan pengecekan dari admin, pharmacy, tindakan, lab, gigi, rad, fis
			if (count($_POST['admin']) > 0) {
				//insert admin
				for ($i = 0; $i < count($_POST['admin']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['admin'][$i]['nilai'] - $_POST['admin'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$_POST['admin'][$i]['nilai']."', 'TOTAL', 'Administrasi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$_POST['admin'][$i]['asuransi']."', 'ASURANSI', 'Administrasi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Administrasi')");
				}
			}
			
			if (count($_POST['pharmacy']) > 0) {
				//insert pharmacy
				for ($i = 0; $i < count($_POST['pharmacy']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['pharmacy'][$i]['nilai'] - $_POST['pharmacy'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['nilai']."', 'TOTAL', 'Pharmacy')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['asuransi']."', 'ASURANSI', 'Pharmacy')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Pharmacy')");
				}
			}
			
			if (count($_POST['tindakan']) > 0) {
				//insert tindakan
				for ($i = 0; $i < count($_POST['tindakan']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['tindakan'][$i]['nilai'] - $_POST['tindakan'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['nilai']."', 'TOTAL', 'Tindakan Medis')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['asuransi']."', 'ASURANSI', 'Tindakan Medis')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Tindakan Medis')");
				}
			}
			
			if (count($_POST['lab']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['lab']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['lab'][$i]['nilai'] - $_POST['lab'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['nilai']."', 'TOTAL', 'Laboratorium')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['asuransi']."', 'ASURANSI', 'Laboratorium')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Laboratorium')");
				}
			}
			
			if (count($_POST['gigi']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['gigi']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['gigi'][$i]['nilai'] - $_POST['gigi'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['nilai']."', 'TOTAL', 'Poli Gigi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['asuransi']."', 'ASURANSI', 'Poli Gigi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Poli Gigi')");
				}
			}
			
			if (count($_POST['rad']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['rad']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['rad'][$i]['nilai'] - $_POST['rad'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['nilai']."', 'TOTAL', 'Radiologi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['asuransi']."', 'ASURANSI', 'Radiologi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Radiologi')");
				}
			}
			
			if (count($_POST['fis']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['fis']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['fis'][$i]['nilai'] - $_POST['fis'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['nilai']."', 'TOTAL', 'Fisioterapi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['asuransi']."', 'ASURANSI', 'Fisioterapi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Fisioterapi')");
				}
			}
			
			if (count($_POST['obygn']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['obygn']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['obygn'][$i]['nilai'] - $_POST['obygn'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['nilai']."', 'TOTAL', 'OBYGN')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['asuransi']."', 'ASURANSI', 'OBYGN')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$pasien."', 'PASIEN', 'OBYGN')");
				}
			}
			
			if (count($_POST['bedah']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['bedah']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['bedah'][$i]['nilai'] - $_POST['bedah'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['nilai']."', 'TOTAL', 'BEDAH')", 0);
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['asuransi']."', 'ASURANSI', 'BEDAH')", 0);
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$pasien."', 'PASIEN', 'BEDAH')", 0);
				}
			}

			if (count($_POST['alkes']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['alkes']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['alkes'][$i]['nilai'] - $_POST['alkes'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['nilai']."', 'TOTAL', 'Alkes')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['asuransi']."', 'ASURANSI', 'Alkes')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Alkes')");
				}
			}
			
		}
		else {
			$data = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='".$_POST['nodaftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$insert = $db->query("insert into tbl_kasir (no_kwitansi, no_daftar, nomr, nama, kode_perusahaan, nama_perusahaan, subtotal, diskon, total, metode_payment, no_kartu, nama_bank, user_insert, user_shift, penjamin, pembulatan, jml_pembulatan, nofr) values ('".$_POST['no_kwitansi']."', '".$_POST['nodaftar']."', '".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', '".$data[0]['kode_perusahaan']."', '".$data[0]['nama_perusahaan']."', '".$_POST['total_bayar']."', '".$_POST['diskon']."', '".$_POST['total_bayar_all']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['NamaBank']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".$_POST['penjamin']."', '".$_POST['pembulatan']."', '".$_POST['jml_bulat']."', '".$_POST['nofr']."')", 0);
			$id = mysql_insert_id();
			$update = $db->query("update tbl_pendaftaran set status_pasien='CLOSED' where no_daftar='".$_POST['nodaftar']."'", 0);
			
			//pengurangan stok obat biasa
			$no_resep = $db->queryItem("select no_resep from tbl_resep where no_daftar='".$_POST['nodaftar']."'");
			$obat = $db->query("select kode_obat, qty from tbl_resep_detail where status_delete='UD' and no_resep='$no_resep'");
			for ($i = 0; $i < count($obat); $i++) {
				$stObat = $obat[$i]['qty'];
				$update = $db->query("update tbl_obat set stock_akhir = stock_akhir - $stObat where kode_obat = '".$obat[$i]['kode_obat']."'");
			}
			
			//pengurangan stok obat racikan
			$no_resep = $db->queryItem("select id from tbl_racikan where no_daftar='".$_POST['nodaftar']."'");
			$obat = $db->query("select kode_obat, qty from tbl_racikan_detail where status_delete='UD' and racikanId='$no_resep'");
			for ($i = 0; $i < count($obat); $i++) {
				$stObat = $obat[$i]['qty'];
				$update = $db->query("update tbl_obat set stock_akhir = stock_akhir - $stObat where kode_obat = '".$obat[$i]['kode_obat']."'");
			}
			
			//insert ke tabel Detail
			// dimulai dengan pengecekan dari admin, pharmacy, tindakan, lab, gigi, rad, fis
			if (count($_POST['admin']) > 0) {
				//insert admin
				for ($i = 0; $i < count($_POST['admin']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['admin'][$i]['nilai'] - $_POST['admin'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$_POST['admin'][$i]['nilai']."', 'TOTAL', 'Administrasi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$_POST['admin'][$i]['asuransi']."', 'ASURANSI', 'Administrasi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Administrasi')");
				}
			}
			
			if (count($_POST['pharmacy']) > 0) {
				//insert pharmacy
				$obatPr = $_POST['pharmacy'];
				for ($i = 0; $i < count($_POST['pharmacy']); $i++) {

					$no = $i + 1;
					$pasien = $_POST['pharmacy'][$i]['nilai'] - $_POST['pharmacy'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['nilai']."', 'TOTAL', 'Pharmacy')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['asuransi']."', 'ASURANSI', 'Pharmacy')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Pharmacy')");
				}
			}
			
			if (count($_POST['tindakan']) > 0) {
				//insert tindakan
				for ($i = 0; $i < count($_POST['tindakan']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['tindakan'][$i]['nilai'] - $_POST['tindakan'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['nilai']."', 'TOTAL', 'Tindakan Medis')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['asuransi']."', 'ASURANSI', 'Tindakan Medis')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Tindakan Medis')");
				}
			}
			
			if (count($_POST['lab']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['lab']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['lab'][$i]['nilai'] - $_POST['lab'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['nilai']."', 'TOTAL', 'Laboratorium')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['asuransi']."', 'ASURANSI', 'Laboratorium')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Laboratorium')");
				}
			}
			
			if (count($_POST['gigi']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['gigi']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['gigi'][$i]['nilai'] - $_POST['gigi'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['nilai']."', 'TOTAL', 'Poli Gigi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['asuransi']."', 'ASURANSI', 'Poli Gigi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Poli Gigi')");
				}
			}
			
			if (count($_POST['rad']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['rad']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['rad'][$i]['nilai'] - $_POST['rad'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['nilai']."', 'TOTAL', 'Radiologi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['asuransi']."', 'ASURANSI', 'Radiologi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Radiologi')");
				}
			}
			
			if (count($_POST['fis']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['fis']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['fis'][$i]['nilai'] - $_POST['fis'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['nilai']."', 'TOTAL', 'Fisioterapi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['asuransi']."', 'ASURANSI', 'Fisioterapi')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Fisioterapi')");
				}
			}
			
			if (count($_POST['obygn']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['obygn']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['obygn'][$i]['nilai'] - $_POST['obygn'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['nilai']."', 'TOTAL', 'OBYGN')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['asuransi']."', 'ASURANSI', 'OBYGN')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$pasien."', 'PASIEN', 'OBYGN')");
				}
			}

			if (count($_POST['bedah']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['bedah']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['bedah'][$i]['nilai'] - $_POST['bedah'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['nilai']."', 'TOTAL', 'BEDAH')", 0);
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['asuransi']."', 'ASURANSI', 'BEDAH')", 0);
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$pasien."', 'PASIEN', 'BEDAH')", 0);
				}
			}
			
			if (count($_POST['alkes']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['alkes']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['alkes'][$i]['nilai'] - $_POST['alkes'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['nilai']."', 'TOTAL', 'Alkes')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['asuransi']."', 'ASURANSI', 'Alkes')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Alkes')");
				}
			}
			
		}
		//Masukkan data ke jurnal
		$data = $db->query("select * from tbl_kasir where no_kwitansi='".$_POST['no_kwitansi']."'");
		$kode_poli = $db->queryItem("select kd_poli from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
		if ($data[0]['metode_payment'] == 'ASS') {
			$nAss = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_POST['no_kwitansi']."' and payment_to='ASURANSI'");
			$nCash = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_POST['no_kwitansi']."' and payment_to='PASIEN'");
			if ($kode_poli == 'FIS') {
				$kode_coa = '1';
				$kode_coa2 = '191';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'LAB') {
				$kode_coa = '1';
				$kode_coa2 = '94';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'LANG') {
				$kode_coa = '1';
				$kode_coa2 = '93';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'P002') {
				$kode_coa = '1';
				$kode_coa2 = '89';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'P001') {
				$kode_coa = '5';
				$kode_coa2 = '87';
			}
			$deskripsi = $data[0]['nomr'].' / '.$data[0]['nama'].' / '.$data[0]['nofr'].' / '.$data[0]['nama_perusahaan'];
			$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kode_coa'");
			$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kode_coa2'");
			
			$nomor = $db->queryItem("select max(nomor_bukti) from tbl_jurnal_otm where kode_bukti='KK' and year(tanggal_transaksi)='".date("Y")."' and month(tanggal_transaksi)='".date("m")."'");
			$no = $nomor + 1;
			
			if ($no < 10) $nom = '00'.$no;
			elseif ($no < 100 and $no >= 10) $nom = '0'.$no;
			if ($no < 1000 and $no >= 100) $nom = $no;
			
			$no_bukti = 'KK/'.date("m").'/'.date("y").'/'.$nom;

			$insert = $db->query("insert into tbl_jurnal_otm (no_kwitansi, tanggal_transaksi, no_jurnal, deskripsi, kode, jenis_kode, kode_inv, jenis_kode_inv, nilai, kode_bukti, nomor_bukti) values ('".$_POST['no_kwitansi']."', '".date("Y-m-d")."', '$no_bukti', '$deskripsi', '".$coa[0]['kd_coa']."', 'D', '".$coa2[0]['kd_coa']."', 'K', '$nAss', 'KK', '$no')");
			
			if ($nCash > 0) {
				if ($kode_poli == 'FIS') {
					$kode_coa = '1';
					$kode_coa2 = '191';
					$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
					$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
				}
				elseif ($kode_poli == 'LAB') {
					$kode_coa = '1';
					$kode_coa2 = '94';
					$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
					$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
				}
				elseif ($kode_poli == 'LANG') {
					$kode_coa = '1';
					$kode_coa2 = '93';
					$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
					$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
				}
				elseif ($kode_poli == 'P002') {
					$kode_coa = '1';
					$kode_coa2 = '89';
					$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
					$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
				}
				elseif ($kode_poli == 'P001') {
					$kode_coa = '1';
					$kode_coa2 = '87';
				}
				$deskripsi = $data[0]['nomr'].' / '.$data[0]['nama'].' / '.$data[0]['nofr'].' / '.$data[0]['nama_perusahaan'];
				$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kode_coa'");
				$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='$kode_coa2'");

				$insert = $db->query("insert into tbl_jurnal_otm (no_kwitansi, tanggal_transaksi, no_jurnal, deskripsi, kode, jenis_kode, kode_inv, jenis_kode_inv, nilai, kode_bukti, nomor_bukti) values ('".$_POST['no_kwitansi']."', '".date("Y-m-d")."', '$no_bukti', '$deskripsi', '".$coa[0]['kd_coa']."', 'D', '".$coa2[0]['kd_coa']."', 'K', '$nCash', 'KK', '$no')");
			}
		}
		if ($data[0]['metode_payment'] == 'CASH') {
			$nAss = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$_POST['no_kwitansi']."' and payment_to='PASIEN'");
			if ($kode_poli == 'FIS') {
				$kode_coa = '1';
				$kode_coa2 = '191';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'LAB') {
				$kode_coa = '1';
				$kode_coa2 = '94';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'LANG') {
				$kode_coa = '1';
				$kode_coa2 = '93';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'P002') {
				$kode_coa = '1';
				$kode_coa2 = '89';
				$data[0]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[0]['no_daftar']."'");
				$data[0]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[0]['nomr']."'");
			}
			elseif ($kode_poli == 'P001') {
				$kode_coa = '1';
				$kode_coa2 = '87';
			}
			$deskripsi = $data[0]['nomr'].' / '.$data[0]['nama'].' / '.$data[0]['nofr'].' / '.$data[0]['nama_perusahaan'];
			$coa = $db->query("select kd_coa, nm_coa from tbl_coa where id='".$kode_coa."'", 0);
			$coa2 = $db->query("select kd_coa, nm_coa from tbl_coa where id='".$kode_coa2."'", 0);
			
			$nomor = $db->queryItem("select max(nomor_bukti) from tbl_jurnal_otm where kode_bukti='KK' and year(tanggal_transaksi)='".date("Y")."' and month(tanggal_transaksi)='".date("m")."'");
			$no = $nomor + 1;
			
			if ($no < 10) $nom = '00'.$no;
			elseif ($no < 100 and $no >= 10) $nom = '0'.$no;
			if ($no < 1000 and $no >= 100) $nom = $no;
			
			$no_bukti = 'KK/'.date("m").'/'.date("y").'/'.$nom;

			$insert = $db->query("insert into tbl_jurnal_otm (no_kwitansi, tanggal_transaksi, no_jurnal, deskripsi, kode, jenis_kode, kode_inv, jenis_kode_inv, nilai, kode_bukti, nomor_bukti) values ('".$_POST['no_kwitansi']."', '".date("Y-m-d")."', '$no_bukti', '$deskripsi', '".$coa[0]['kd_coa']."', 'D', '".$coa2[0]['kd_coa']."', 'K', '$nAss', 'KK', '$no')");
		}
		header("location:../../index.php?mod=kasir&submod=inputKasir");
	}

?>