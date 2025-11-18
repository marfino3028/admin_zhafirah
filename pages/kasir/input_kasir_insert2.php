<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//print_r($_SESSION);
	if ($_SESSION['rg_user'] != '') {
		$tst = explode("JAMSOSTEK", $_POST['nodaftar']);
        if ($_POST['pembulatan'] == "")	$_POST['pembulatan'] = 0;
		if ($tst[0] == 1) {
			$data = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$insert = $db->query("insert into tbl_kasir (no_kwitansi, no_daftar, nomr, nama, kode_perusahaan, nama_perusahaan, subtotal, diskon, total, metode_payment, no_kartu, nama_bank, user_insert, user_shift, penjamin, pembulatan, jml_pembulatan, piutang) values ('".$_POST['no_kwitansi']."', 'JAM-".$tst[1]."', '".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', 'JJJ030', 'JAMSOSTEK', '".$_POST['total_bayar']."', '".$_POST['diskon']."', '".$_POST['total_bayar_all']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['NamaBank']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".$_POST['penjamin']."', '".$_POST['pembulatan']."', '".$_POST['jml_bulat']."', '".$_POST['piutang']."')", 0);
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
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['nilai']."', 'TOTAL', 'Pharmacy', '".$_POST['pharmacy'][$i]['qty']."', '".$_POST['pharmacy'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['asuransi']."', 'ASURANSI', 'Pharmacy', '".$_POST['pharmacy'][$i]['qty']."', '".$_POST['pharmacy'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Pharmacy', '".$_POST['pharmacy'][$i]['qty']."', '".$_POST['pharmacy'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['tindakan']) > 0) {
				//insert tindakan
				for ($i = 0; $i < count($_POST['tindakan']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['tindakan'][$i]['nilai'] - $_POST['tindakan'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['nilai']."', 'TOTAL', 'Tindakan Medis', '".$_POST['tindakan'][$i]['qty']."', '".$_POST['tindakan'][$i]['satuan']."')", 1);
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['asuransi']."', 'ASURANSI', 'Tindakan Medis', '".$_POST['tindakan'][$i]['qty']."', '".$_POST['tindakan'][$i]['satuan']."')", 1);
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Tindakan Medis', '".$_POST['tindakan'][$i]['qty']."', '".$_POST['tindakan'][$i]['satuan']."')", 1);
				}
			}
			
			if (count($_POST['lab']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['lab']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['lab'][$i]['nilai'] - $_POST['lab'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['nilai']."', 'TOTAL', 'Laboratorium', '".$_POST['lab'][$i]['qty']."', '".$_POST['lab'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['asuransi']."', 'ASURANSI', 'Laboratorium', '".$_POST['lab'][$i]['qty']."', '".$_POST['lab'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Laboratorium', '".$_POST['lab'][$i]['qty']."', '".$_POST['lab'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['gigi']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['gigi']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['gigi'][$i]['nilai'] - $_POST['gigi'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['nilai']."', 'TOTAL', 'Poli Gigi', '".$_POST['gigi'][$i]['qty']."', '".$_POST['gigi'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['asuransi']."', 'ASURANSI', 'Poli Gigi', '".$_POST['gigi'][$i]['qty']."', '".$_POST['gigi'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Poli Gigi', '".$_POST['gigi'][$i]['qty']."', '".$_POST['gigi'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['rad']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['rad']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['rad'][$i]['nilai'] - $_POST['rad'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['nilai']."', 'TOTAL', 'Radiologi', '".$_POST['rad'][$i]['qty']."', '".$_POST['rad'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['asuransi']."', 'ASURANSI', 'Radiologi', '".$_POST['rad'][$i]['qty']."', '".$_POST['rad'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Radiologi', '".$_POST['rad'][$i]['qty']."', '".$_POST['rad'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['fis']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['fis']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['fis'][$i]['nilai'] - $_POST['fis'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['nilai']."', 'TOTAL', 'Fisioterapi', '".$_POST['fis'][$i]['qty']."', '".$_POST['fis'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['asuransi']."', 'ASURANSI', 'Fisioterapi', '".$_POST['fis'][$i]['qty']."', '".$_POST['fis'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Fisioterapi', '".$_POST['fis'][$i]['qty']."', '".$_POST['fis'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['prwt']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['prwt']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['prwt'][$i]['nilai'] - $_POST['prwt'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PRWT', '$no', '".$_POST['prwt'][$i]['nama']."', '".$_POST['prwt'][$i]['nilai']."', 'TOTAL', 'Keperawatan', '".$_POST['prwt'][$i]['qty']."', '".$_POST['prwt'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PRWT', '$no', '".$_POST['prwt'][$i]['nama']."', '".$_POST['prwt'][$i]['asuransi']."', 'ASURANSI', 'Keperawatan', '".$_POST['prwt'][$i]['qty']."', '".$_POST['prwt'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PRWT', '$no', '".$_POST['prwt'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Keperawatan', '".$_POST['prwt'][$i]['qty']."', '".$_POST['prwt'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['obygn']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['obygn']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['obygn'][$i]['nilai'] - $_POST['obygn'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['nilai']."', 'TOTAL', 'OBYGN', '".$_POST['obygn'][$i]['qty']."', '".$_POST['obygn'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['asuransi']."', 'ASURANSI', 'OBYGN', '".$_POST['obygn'][$i]['qty']."', '".$_POST['obygn'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$pasien."', 'PASIEN', 'OBYGN', '".$_POST['obygn'][$i]['qty']."', '".$_POST['obygn'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['bedah']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['bedah']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['bedah'][$i]['nilai'] - $_POST['bedah'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['nilai']."', 'TOTAL', 'BEDAH', '".$_POST['bedah'][$i]['qty']."', '".$_POST['bedah'][$i]['satuan']."')", 0);
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['asuransi']."', 'ASURANSI', 'BEDAH', '".$_POST['bedah'][$i]['qty']."', '".$_POST['bedah'][$i]['satuan']."')", 0);
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$pasien."', 'PASIEN', 'BEDAH', '".$_POST['bedah'][$i]['qty']."', '".$_POST['bedah'][$i]['satuan']."')", 0);
				}
			}

			if (count($_POST['alkes']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['alkes']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['alkes'][$i]['nilai'] - $_POST['alkes'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['nilai']."', 'TOTAL', 'Alkes', '".$_POST['alkes'][$i]['qty']."', '".$_POST['alkes'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['asuransi']."', 'ASURANSI', 'Alkes', '".$_POST['alkes'][$i]['qty']."', '".$_POST['alkes'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Alkes', '".$_POST['alkes'][$i]['qty']."', '".$_POST['alkes'][$i]['satuan']."')");
				}
			}
			
		}
		else {
			$data = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$_POST['nodaftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$insert = $db->query("insert into tbl_kasir (no_kwitansi, no_daftar, nomr, nama, kode_perusahaan, nama_perusahaan, subtotal, diskon, total, metode_payment, no_kartu, nama_bank, user_insert, user_shift, penjamin, nofr, piutang) values ('".$_POST['no_kwitansi']."', '".$_POST['nodaftar']."', '".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', '".$data[0]['kode_perusahaan']."', '".$data[0]['nama_perusahaan']."', '".$_POST['total_bayar']."', '".$_POST['diskon']."', '".$_POST['total_bayar_all']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['NamaBank']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."', '".$_POST['penjamin']."', '".$_POST['nofr']."', '".$_POST['piutang']."')", 0);
			$id = mysql_insert_id();
			$update = $db->query("update tbl_pendaftaran set status_pasien='CLOSED' where no_daftar='".$_POST['nodaftar']."'", 0);
			
		//pengurangan stok obat biasa depo Apotik
		$no_resep = $db->queryItem("select no_resep from tbl_resep where no_daftar='" . $_POST['nodaftar'] . "'");
		$obatApotik = $db->query("select kode_obat, qty, depo from tbl_resep_detail where status_delete='UD' and no_resep='$no_resep' and depo='Apotik'");
		for ($i = 0; $i < count($obatApotik); $i++) {
			$stObatApotik = $obatApotik[$i]['qty'];
			$updateApotik = $db->query("update tbl_obat set stock_akhir_apotik = stock_akhir_apotik - $stObatApotik where kode_obat = '" . $obatApotik[$i]['kode_obat'] . "'");
		}

		//pengurangan stok obat biasa depo Fisio
		$obatFisio = $db->query("select kode_obat, qty, depo from tbl_resep_detail where status_delete='UD' and no_resep='$no_resep' and depo='Fisioterapi'");
		for ($i = 0; $i < count($obatFisio); $i++) {
			$stObatFisio = $obatFisio[$i]['qty'];
			$updateFisio = $db->query("update tbl_obat set stock_akhir_fisio = stock_akhir_fisio - $stObatFisio where kode_obat = '" . $obatFisio[$i]['kode_obat'] . "'");
		}

		//pengurangan stok obat biasa depo Keperawatan
		$obatKeperawatan = $db->query("select kode_obat, qty, depo from tbl_resep_detail where status_delete='UD' and no_resep='$no_resep' and depo='Keperawatan'");
		for ($i = 0; $i < count($obatKeperawatan); $i++) {
			$stObatKeperawatan = $obatKeperawatan[$i]['qty'];
			$updateKeperawatan = $db->query("update tbl_obat set stock_akhir_keperawatan = stock_akhir_keperawatan - $stObatKeperawatan where kode_obat = '" . $obatKeperawatan[$i]['kode_obat'] . "'");
		}


		//pengurangan stok obat racikan Depo Apotik
		$r_no_resep = $db->queryItem("select id from tbl_racikan where no_daftar='" . $_POST['nodaftar'] . "'");
		$r_obatApotik = $db->query("select kode_obat, qty, depo from tbl_racikan_detail where status_delete='UD' and racikanId='$r_no_resep' and depo='Apotik'");
		for ($i = 0; $i < count($r_obatApotik); $i++) {
			$r_stObatApotik = $r_obatApotik[$i]['qty'];
			$r_updateApotik = $db->query("update tbl_obat set stock_akhir_apotik = stock_akhir_apotik - $r_stObatApotik where kode_obat = '" . $r_obatApotik[$i]['kode_obat'] . "'");
		}

		//pengurangan stok obat racikan Depo Fisio
		$r_obatFisio = $db->query("select kode_obat, qty, depo from tbl_racikan_detail where status_delete='UD' and racikanId='$r_no_resep' and depo='Fisioterapi'");
		for ($i = 0; $i < count($r_obatFisio); $i++) {
			$r_stObatFisio = $r_obatFisio[$i]['qty'];
			$r_updateFisio = $db->query("update tbl_obat set stock_akhir_fisio = stock_akhir_fisio - $r_stObatFisio where kode_obat = '" . $r_obatFisio[$i]['kode_obat'] . "'");
		}

		//pengurangan stok obat racikan Depo Keperawatan
		$r_obatKeperawatan = $db->query("select kode_obat, qty, depo from tbl_racikan_detail where status_delete='UD' and racikanId='$r_no_resep' and depo='Keperawatan'");
		for ($i = 0; $i < count($r_obatKeperawatan); $i++) {
			$r_stObatKeperawatan = $r_obatKeperawatan[$i]['qty'];
			$r_updateKeperawatan = $db->query("update tbl_obat set stock_akhir_keperawatan = stock_akhir_keperawatan - $r_stObatKeperawatan where kode_obat = '" . $r_obatKeperawatan[$i]['kode_obat'] . "'");
		}

			//insert ke tabel Detail
			// dimulai dengan pengecekan dari admin, pharmacy, tindakan, lab, gigi, rad, fis
			if (count($_POST['admin']) > 0) {
				//insert admin
				for ($i = 0; $i < count($_POST['admin']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['admin'][$i]['nilai'] - $_POST['admin'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$_POST['admin'][$i]['nilai']."', 'TOTAL', 'Administrasi', '1', '')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$_POST['admin'][$i]['asuransi']."', 'ASURANSI', 'Administrasi', '1', '')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'ADMINISTRASI', '$no', '".$_POST['admin'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Administrasi', '1', '')");
				}
			}
			
			if (count($_POST['pharmacy']) > 0) {
				//insert pharmacy
				$obatPr = $_POST['pharmacy'];
				$total_obat = 0;
				for ($i = 0; $i < count($_POST['pharmacy']); $i++) {

					$no = $i + 1;
					$pasien = $_POST['pharmacy'][$i]['nilai'] - $_POST['pharmacy'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['nilai']."', 'TOTAL', 'Pharmacy', '".$_POST['pharmacy'][$i]['qty']."', '".$_POST['pharmacy'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$_POST['pharmacy'][$i]['asuransi']."', 'ASURANSI', 'Pharmacy', '".$_POST['pharmacy'][$i]['qty']."', '".$_POST['pharmacy'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PHARMACY', '$no', '".$_POST['pharmacy'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Pharmacy', '".$_POST['pharmacy'][$i]['qty']."', '".$_POST['pharmacy'][$i]['satuan']."')");
					$total_obat = $total_obat + $_POST['pharmacy'][$i]['nilai'];
				}
			}
			
			if (count($_POST['tindakan']) > 0) {
				//insert tindakan
				for ($i = 0; $i < count($_POST['tindakan']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['tindakan'][$i]['nilai'] - $_POST['tindakan'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['nilai']."', 'TOTAL', 'Tindakan Medis', '".$_POST['tindakan'][$i]['qty']."', '".$_POST['tindakan'][$i]['satuan']."')", 1);
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$_POST['tindakan'][$i]['asuransi']."', 'ASURANSI', 'Tindakan Medis', '".$_POST['tindakan'][$i]['qty']."', '".$_POST['tindakan'][$i]['satuan']."', 1)");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'TINDAKAN', '$no', '".$_POST['tindakan'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Tindakan Medis', '".$_POST['tindakan'][$i]['qty']."', '".$_POST['tindakan'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['lab']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['lab']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['lab'][$i]['nilai'] - $_POST['lab'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['nilai']."', 'TOTAL', 'Laboratorium', '".$_POST['lab'][$i]['qty']."', '".$_POST['lab'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$_POST['lab'][$i]['asuransi']."', 'ASURANSI', 'Laboratorium', '".$_POST['lab'][$i]['qty']."', '".$_POST['lab'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'LAB', '$no', '".$_POST['lab'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Laboratorium', '".$_POST['lab'][$i]['qty']."', '".$_POST['lab'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['gigi']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['gigi']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['gigi'][$i]['nilai'] - $_POST['gigi'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['nilai']."', 'TOTAL', 'Poli Gigi', '".$_POST['gigi'][$i]['qty']."', '".$_POST['gigi'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$_POST['gigi'][$i]['asuransi']."', 'ASURANSI', 'Poli Gigi', '".$_POST['gigi'][$i]['qty']."', '".$_POST['gigi'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'GIGI', '$no', '".$_POST['gigi'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Poli Gigi', '".$_POST['gigi'][$i]['qty']."', '".$_POST['gigi'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['rad']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['rad']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['rad'][$i]['nilai'] - $_POST['rad'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['nilai']."', 'TOTAL', 'Radiologi', '".$_POST['rad'][$i]['qty']."', '".$_POST['rad'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$_POST['rad'][$i]['asuransi']."', 'ASURANSI', 'Radiologi', '".$_POST['rad'][$i]['qty']."', '".$_POST['rad'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RAD', '$no', '".$_POST['rad'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Radiologi', '".$_POST['rad'][$i]['qty']."', '".$_POST['rad'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['fis']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['fis']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['fis'][$i]['nilai'] - $_POST['fis'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['nilai']."', 'TOTAL', 'Fisioterapi')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$_POST['fis'][$i]['asuransi']."', 'ASURANSI', 'Fisioterapi', '".$_POST['fis'][$i]['qty']."', '".$_POST['fis'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'FIS', '$no', '".$_POST['fis'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Fisioterapi', '".$_POST['fis'][$i]['qty']."', '".$_POST['fis'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['prwt']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['prwt']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['prwt'][$i]['nilai'] - $_POST['prwt'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PRWT', '$no', '".$_POST['prwt'][$i]['nama']."', '".$_POST['prwt'][$i]['nilai']."', 'TOTAL', 'Keperawatan', '".$_POST['prwt'][$i]['qty']."', '".$_POST['prwt'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PRWT', '$no', '".$_POST['prwt'][$i]['nama']."', '".$_POST['prwt'][$i]['asuransi']."', 'ASURANSI', 'Keperawatan', '".$_POST['prwt'][$i]['qty']."', '".$_POST['prwt'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PRWT', '$no', '".$_POST['prwt'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Keperawatan', '".$_POST['prwt'][$i]['qty']."', '".$_POST['prwt'][$i]['satuan']."')");
				}
			}
			
			if (count($_POST['obygn']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['obygn']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['obygn'][$i]['nilai'] - $_POST['obygn'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['nilai']."', 'TOTAL', 'OBYGN', '".$_POST['obygn'][$i]['qty']."', '".$_POST['obygn'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$_POST['obygn'][$i]['asuransi']."', 'ASURANSI', 'OBYGN', '".$_POST['obygn'][$i]['qty']."', '".$_POST['obygn'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'OBYGN', '$no', '".$_POST['obygn'][$i]['nama']."', '".$pasien."', 'PASIEN', 'OBYGN', '".$_POST['obygn'][$i]['qty']."', '".$_POST['obygn'][$i]['satuan']."')");
				}
			}

			if (count($_POST['bedah']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['bedah']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['bedah'][$i]['nilai'] - $_POST['bedah'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['nilai']."', 'TOTAL', 'BEDAH', '".$_POST['bedah'][$i]['qty']."', '".$_POST['bedah'][$i]['satuan']."')", 0);
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$_POST['bedah'][$i]['asuransi']."', 'ASURANSI', 'BEDAH', '".$_POST['bedah'][$i]['qty']."', '".$_POST['bedah'][$i]['satuan']."')", 0);
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'BEDAH', '$no', '".$_POST['bedah'][$i]['nama']."', '".$pasien."', 'PASIEN', 'BEDAH', '".$_POST['bedah'][$i]['qty']."', '".$_POST['bedah'][$i]['satuan']."')", 0);
				}
			}
			
			if (count($_POST['alkes']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['alkes']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['alkes'][$i]['nilai'] - $_POST['alkes'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['nilai']."', 'TOTAL', 'Alkes', '".$_POST['alkse'][$i]['qty']."', '".$_POST['alkes'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$_POST['alkes'][$i]['asuransi']."', 'ASURANSI', 'Alkes', '".$_POST['alkes'][$i]['qty']."', '".$_POST['alkes'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'alkes', '$no', '".$_POST['alkes'][$i]['nama']."', '".$pasien."', 'PASIEN', 'Alkes', '".$_POST['alkes'][$i]['qty']."', '".$_POST['alkes'][$i]['satuan']."')");
				}
			}
			if (count($_POST['pl']) > 0) {
				//insert lab
				for ($i = 0; $i < count($_POST['pl']); $i++) {
					$no = $i + 1;
					$pasien = $_POST['pl'][$i]['nilai'] - $_POST['pl'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PL', '$no', '".$_POST['pl'][$i]['nama']."', '".$_POST['pl'][$i]['nilai']."', 'TOTAL', 'PL', '".$_POST['pl'][$i]['qty']."', '".$_POST['pl'][$i]['satuan']."')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PL', '$no', '".$_POST['pl'][$i]['nama']."', '".$_POST['pl'][$i]['asuransi']."', 'ASURANSI', 'PL', '".$_POST['pl'][$i]['qty']."', '".$_POST['pl'][$i]['satuan']."')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'PL', '$no', '".$_POST['pl'][$i]['nama']."', '".$pasien."', 'PASIEN', 'PL', '".$_POST['pl'][$i]['qty']."', '".$_POST['pl'][$i]['satuan']."')");
				}
			}
			if ($_POST['ranap_nilai'] > 0) {
				//insert RANAP Tindakan dan kamar
                $_POST['ranap_pasien'] = $_POST['ranap_nilai'] - $_POST['ranap_ass'];
                $insert_kamar = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RANAP', '1', '".$_POST['ranap']."', '".$_POST['ranap_nilai']."', 'TOTAL', 'RANAP', '1', '')");
                $insert_kamar = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RANAP', '1', '".$_POST['ranap']."', '".$_POST['ranap_ass']."', 'ASURANSI', 'RANAP', '1', '')");
                $insert_kamar = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judulqty, satuan) values ('".$_POST['no_kwitansi']."', 'RANAP', '1', '".$_POST['ranap']."', '".$_POST['ranap_pasien']."', 'PASIEN', 'RANAP', '1', '')");
				$no = 1;
              	for ($i = 0; $i < count($_POST['rawat']); $i++) {
					$no = $no + 1;
					$pasien = $_POST['rawat'][$i]['nilai'] - $_POST['rawat'][$i]['asuransi'];
					$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RANAP', '$no', '".$_POST['rawat'][$i]['nama']."', '".$_POST['rawat'][$i]['nilai']."', 'TOTAL', 'RAWAT')");
					$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RANAP', '$no', '".$_POST['rawat'][$i]['nama']."', '".$_POST['rawat'][$i]['asuransi']."', 'ASURANSI', 'RAWAT')");
					$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('".$_POST['no_kwitansi']."', 'RANAP', '$no', '".$_POST['rawat'][$i]['nama']."', '".$pasien."', 'PASIEN', 'RAWAT', '".$_POST['rawat'][$i]['qty']."', '".$_POST['rawat'][$i]['satuan']."')");
				}
			}
		}
		

	// INSERT BARU BHP
	if (count($_POST['bhp']) > 0) {
		//insert bhp
		$obatPr = $_POST['bhp'];
		for ($i = 0; $i < count($_POST['bhp']); $i++) {

			$no = $i + 1;
			$pasien = $_POST['bhp'][$i]['nilai'] - $_POST['bhp'][$i]['asuransi'];
			$insertRS = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('" . $_POST['no_kwitansi'] . "', 'BHP', '$no', '" . $_POST['bhp'][$i]['nama'] . "', '" . $_POST['bhp'][$i]['nilai'] . "', 'TOTAL', 'bhp', '".$_POST['bhp'][$i]['qty']."', '".$_POST['bhp'][$i]['satuan']."')");
			$insertAss = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('" . $_POST['no_kwitansi'] . "', 'BHP', '$no', '" . $_POST['bhp'][$i]['nama'] . "', '" . $_POST['bhp'][$i]['asuransi'] . "', 'ASURANSI', 'bhp', '".$_POST['bhp'][$i]['qty']."', '".$_POST['bhp'][$i]['satuan']."')");
			$insertPas = $db->query("insert into tbl_kasir_detail (no_kwitansi, kategori, nomor, nama, bayar, payment_to, judul, qty, satuan) values ('" . $_POST['no_kwitansi'] . "', 'BHP', '$no', '" . $_POST['bhp'][$i]['nama'] . "', '" . $pasien . "', 'PASIEN', 'bhp', '".$_POST['bhp'][$i]['qty']."', '".$_POST['bhp'][$i]['satuan']."')");
		}
	}
	// AKHIR INSERT BARU BHP


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

		//Masukkan ke jurnal
		$dataUmum = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan, a.kode_dokter, a.kd_poli from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='".$_POST['nodaftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
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
		$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$dataUmum[0]['nomr']."'");
		$dokter = $db->query("select nama_dokter, tarif_dokter from tbl_dokter where kode_dokter='".$dataUmum[0]['kode_dokter']."'");
		$keterangan = 'Patient Transaction:  No. Reg.'.$_POST['nodaftar'].', Konsultasi Dokter: ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];
		$deskripsi = 'A/R Bill, '.$_POST['no_kwitansi'].' Reg: '.$_POST['nodaftar'].'] PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $_POST['nodaftar'];
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11030108'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $total_obat;
			$kredit = 0;
		}
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $total_obat;
		}

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11030106'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $total_obat;
			$kredit = 0;
		}
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $total_obat;
		}
		//$debit = $total_obat;
		//$kredit = 0;

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);


		//yang ke-dua
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
		$pasien = $db->query("select nm_pasien from tbl_pasien where nomr='".$dataUmum[0]['nomr']."'");
		$dokter = $db->query("select nama_dokter, tarif_dokter from tbl_dokter where kode_dokter='".$dataUmum[0]['kode_dokter']."'");
		$keterangan = 'Patient Transaction:  No. Reg.'.$_POST['nodaftar'].', Konsultasi Dokter: ['.$dokter[0]['nama_dokter'].'] PS: '.$pasien[0]['nm_pasien'];
		$deskripsi = 'Payment By Cash, Reg: '.$_POST['nodaftar'].', Bill: '.$_POST['no_kwitansi'].'Notes: PS: '.$pasien[0]['nm_pasien'];
		$dtarif = $db->query("select * from tbl_poli where kd_poli='".$dataUmum[0]['kd_poli']."'");
		$reg_no = $_POST['nodaftar'];
		$cost_center_kode = $dtarif[0]['kd_profit'];
		$cost_center_nama = $dtarif[0]['nm_profit'];
		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11010011'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $total_obat;
			$kredit = 0;
		}
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $total_obat;
		}
		//$debit = 0;
		//$kredit = $total_obat;

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);

		$coa = $db->query("select kd_coa, nm_coa, default_pos from tbl_coa where kd_coa='11030108'");
		$gl_kode = $coa[0]['kd_coa'];
		$gl_nama = $coa[0]['nm_coa'];
		if ($coa[0]['default_pos'] == 'Debit') {
			$debit = $total_obat;
			$kredit = 0;
		}
		elseif ($coa[0]['default_pos'] == 'Credit') {
			$debit = 0;
			$kredit = $total_obat;
		}
		//$debit = $total_obat;
		//$kredit = 0;

		$insert = $db->query("insert into tbl_jurnal (no_dokumen_nr, no_dokumen, tanggal, status, tipe_dokumen, petugas, mata_uang, rate, supplier, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, reg_no, cost_center_kode, cost_center_nama, kode_barang, volume, satuan, reffID, status_jurnal) values ('".$no_dokumen_nr."', '".$no_dokumen."', '".$tanggal."', '".$statuss."', '".$tipe_dokumen."', '".$petugas."', '".$mata_uang."', '".$rate."', '".$supplier."', '".$keterangan."', '".$gl_kode."', '".$gl_nama."', '".$deskripsi."', '".$debit."', '".$kredit."', '".$reg_no."', '".$cost_center_kode."', '".$cost_center_nama."', '', '', '', '', 'AUTO')", 0);
		
		//update dan masukkan nomor HP yang bisa WA
		$update = $db->query("update tbl_kasir set telp='".$_POST['telp']."' where no_kwitansi='".$_POST['no_kwitansi']."'");

		//Pengiriman Reminder
		$obat_reminder = $db->query("select a.nama_obat, b.nama, a.frekuensi, a.durasi, a.waktu_minum from tbl_resep_detail a left join tbl_resep b on b.id=a.resep_id where a.reminder_obatt='KIRIM' and b.no_daftar='".$_POST['nodaftar']."'", 0);
		$telp = $_POST['telp'];
		//$telp = "087884947802";
		$pic = $obat_reminder[0]['nama'];
		$token = $db->query("select nilai from tbl_config where kode='WA-API'");
		$mulai = strtotime(date("Y-m-d H:i"));
		for ($i = 0; $i < count($obat_reminder); $i++) {
		$waktunya = strtotime("1 days", $mulai);

		for ($j = 1; $j <= $obat_reminder[$i]['durasi']; $j++) {
		$waktunya = strtotime("1 days", $waktunya);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.fonnte.com/send',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'target' => "$telp",
				'message' => 'Hallo,
'.$pic.'

Reminder, jangan lupa untuk minum obat secara teratur sesuai dengan dosis yang diresepkan. Jadwal minum obat:
*'.$obat_reminder[$i]['nama_obat'].'*
tanggal -'.date("d F Y", $waktunya).'-, '.$obat_reminder[$i]['frekuensi'].' '.$obat_reminder[$i]['waktu minum'].' Setelah Makan

Terima kasih
Dialisacare',
				'countryCode' => '62', //optional
				'schedule' => $waktunya,
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $token[0]['nilai'] //change TOKEN to your actual token - ML6#M4X3fxTZWFwBFUZ@
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		}
		}
		

		header("location:../../index.php?mod=kasir&submod=inputKasir");
	}

?>