<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	if ($_SESSION['rg_user'] != '') {
		$tst = explode("JAMSOSTEK", $_POST['nodaftar']);
		if ($tst[0] == 1) {
			$data = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='".$tst[1]."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$insert = $db->query("insert into tbl_kasir (no_kwitansi, no_daftar, nomr, nama, kode_perusahaan, nama_perusahaan, subtotal, diskon, total, metode_payment, no_kartu, nama_bank, user_insert, user_shift) values ('".$_POST['no_kwitansi']."', 'JAM-".$tst[1]."', '".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', 'JJJ030', 'JAMSOSTEK', '".$_POST['total_bayar']."', '".$_POST['diskon']."', '".$_POST['total_bayar_all']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['NamaBank']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."')", 0);
			$id = mysql_insert_id();
			$update = $db->query("update tbl_pendaftaran_jamsostek set status_pasien='CLOSED' where no_daftar='".$tst[1]."'", 0);
		}
		else {
			$data = $db->query("select a.nomr, b.nm_pasien, a.kode_perusahaan, a.nama_perusahaan from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='".$_POST['nodaftar']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
			$insert = $db->query("insert into tbl_kasir (no_kwitansi, no_daftar, nomr, nama, kode_perusahaan, nama_perusahaan, subtotal, diskon, total, metode_payment, no_kartu, nama_bank, user_insert, user_shift) values ('".$_POST['no_kwitansi']."', '".$_POST['nodaftar']."', '".$data[0]['nomr']."', '".$data[0]['nm_pasien']."', '".$data[0]['kode_perusahaan']."', '".$data[0]['nama_perusahaan']."', '".$_POST['total_bayar']."', '".$_POST['diskon']."', '".$_POST['total_bayar_all']."', '".$_POST['metode']."', '".$_POST['nocc']."', '".$_POST['NamaBank']."', '".$_SESSION['rg_user']."', '".$_SESSION['rg_shift']."')", 0);
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
		}
		header("location:../../index.php?mod=kasir&submod=inputKasir");
	}
?>
<script language="javascript">
	function loadingHal() {
		var w = 550;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'print_pembayaran.php?id=' + <?php echo $_POST['no_kwitansi']?>;
		popup = window.open(URL,"",windowprops);
		
		window.location = '../../index.php?mod=kasir&submod=inputKasir';
	}
</script>