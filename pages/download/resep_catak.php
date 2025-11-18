<?php
session_start();
// memanggil library FPDF
require('fpdf.php');
date_default_timezone_set("Asia/Jakarta");
include "../../3rdparty/engine.php";
//print_r($_SESSION);
if ($_SESSION['rg_user'] != "") {
	$data_resep = $db->query("select * from tbl_resep where md5(id)='" . $_GET['id'] . "' and status_delete='UD'");
	$detail = $db->query("select * from tbl_resep_detail where resep_id='" . $data_resep[0]['id'] . "'and status_delete='UD'");
	$pasien = $db->query("select * from tbl_pasien where nomr='" . $data_resep[0]['nomr'] . "'");
	$daftar = $db->query("select * from tbl_pendaftaran where no_daftar='" . $data_resep[0]['no_daftar'] . "'");
	$sbu = $db->query("select nama, alamat from tbl_sbu where status_delete='UD'");
	$dokter = $db->query("select nama_dokter from tbl_dokter where kode_dokter='" . $daftar[0]['kode_dokter'] . "'");
	$poli = $db->query("select nama_poli from tbl_poli where kd_poli='" . $daftar[0]['kd_poli'] . "'");

	// intance object dan memberikan pengaturan halaman PDF
	$pdf = new FPDF('P', 'mm', 'A5');
	$pdf->AddPage();
	$pdf->Image('../../images/technocare.jpeg', 5, 6, 15, 'PNG');
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->Cell(11, 2, '', 0, 0, '');
	$pdf->Cell(50, 2, $sbu[0]['nama'], 0, 0, 'L');
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->SetTextColor(0, 191, 255);
	$pdf->Cell(70, 2, 'Resep', 0, 1, 'R');
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', '', 6);
	$pdf->Cell(11, 0, '', 0, 0, 'L');
	$pdf->Cell(110, 6, $sbu[0]['alamat'], 0, 1, 'L');
	$pdf->Cell(135, 3, 'Dibuat tanggal : ' . date("d F Y H:i:s", strtotime($detail[0]['tgl_insert'])), 0, 1, 'R');
	$pdf->Cell(135, 3, 'Diubah tanggal : ' . date("d F Y H:i:s", strtotime($detail[0]['tgl_insert'])), 0, 1, 'R');

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(120, 2, '', 0, 1, 'L');
	$pdf->Cell(120, 2, '', 0, 1, 'L');
	$pdf->SetTextColor(0, 191, 255);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(65, 5, "Info Pasien", 0, 0, 'L');
	$pdf->Cell(65, 5, "Info Pendaftaran", 0, 1, 'L');
	$pdf->SetDrawColor(0, 191, 255);
	$pdf->Rect(11, 33, 60, 0, 'D');
	$pdf->Rect(76, 33, 60, 0, 'D');

	$pdf->SetFont('Arial', '', 9);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->Cell(120, 2, '', 0, 1, 'L');
	$pdf->Cell(23, 5, "Nama pasien", 0, 0, 'L');
	$pdf->Cell(2, 5, ":", 0, 0, 'L');
	$pdf->Cell(40, 5, $data_resep[0]['nama'], 0, 0, 'L');
	$pdf->Cell(26, 5, "No. MR", 0, 0, 'L');
	$pdf->Cell(5, 5, ":", 0, 0, 'L');
	$pdf->Cell(70, 5, $data_resep[0]['nomr'], 0, 1, 'L');

	$pdf->Cell(23, 5, "Jenis Kelamin", 0, 0, 'L');
	$pdf->Cell(2, 5, ":", 0, 0, 'L');
	$pdf->Cell(40, 5, $pasien[0]['jk'], 0, 0, 'L');
	$pdf->Cell(26, 5, "Tanggal", 0, 0, 'L');
	$pdf->Cell(5, 5, ":", 0, 0, 'L');
	$pdf->Cell(70, 5, $daftar[0]['tgl_insert'], 0, 1, 'L');

	$pdf->Cell(23, 5, "Tgl lahir (Usia)", 0, 0, 'L');
	$pdf->Cell(2, 5, ":", 0, 0, 'L');
	$pdf->Cell(40, 5, $pasien[0]['tgl_lahir'], 0, 0, 'L');
	$pdf->Cell(26, 5, "Nama Dokter", 0, 0, 'L');
	$pdf->Cell(5, 5, ":", 0, 0, 'L');
	$pdf->Cell(70, 5, $dokter[0]['nama_dokter'], 0, 1, 'L');
	$pdf->Cell(23, 5, "", 0, 0, 'L');
	$pdf->Cell(2, 5, "", 0, 0, 'L');
	$tanggal_lahir = new DateTime($pasien[0]['tgl_lahir']);
	$sekarang = new DateTime("today");
	$thn = $sekarang->diff($tanggal_lahir)->y;
	$bln = $sekarang->diff($tanggal_lahir)->m;
	$pdf->Cell(40, 3, '(' . $thn . ' tahun, ' . $bln . ' bulan)', 0, 0, 'L');
	$pdf->Cell(26, 5, "Nama Poli", 0, 0, 'L');
	$pdf->Cell(5, 5, ":", 0, 0, 'L');
	$pdf->Cell(70, 5, $poli[0]['nama_poli'], 0, 1, 'L');

	$pdf->Cell(23, 5, "Alamat", 0, 0, 'L');
	$pdf->Cell(2, 5, ":", 0, 0, 'L');
	$pdf->Cell(150, 5, $pasien[0]['alamat_pasien'], 0, 1, 'L');

	$pdf->Cell(23, 5, "No. Telepon", 0, 0, 'L');
	$pdf->Cell(2, 5, ":", 0, 0, 'L');
	$pdf->Cell(150, 5, $pasien[0]['telp_pasien'], 0, 1, 'L');

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(120, 2, '', 0, 1, 'L');
	$pdf->Cell(120, 6, '', 0, 1, 'L');
	$pdf->SetTextColor(0, 191, 255);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(130, 5, "Info Obat", 0, 1, 'L');
	$pdf->SetDrawColor(0, 191, 255);
	$pdf->Rect(11, 78, 125, 0, 'D');

	$pdf->SetTextColor(0, 0, 0);
	$pdf->Cell(120, 5, '', 0, 1, 'L');
	$pdf->Cell(50, 5, "Nama Obat", 0, 0, 'L');
	$pdf->Cell(20, 5, "Jumlah", 0, 0, 'L');
	$pdf->Cell(50, 5, "Dosis", 0, 1, 'L');

	$resep = $db->query("select * from tbl_resep_detail where md5(resep_id)='" . $_GET['id'] . "' and status_delete='UD'");
	$pdf->SetFont('Arial', '', 8);
	for ($i = 0; $i < count($resep); $i++) {
		$obat = $db->query("select satuan_terkecil from tbl_obat where kode_obat='" . $resep[$i]['kode_obat'] . "'");
		$pdf->MultiCell(50, 5, $resep[$i]['nama_obat'], 0, 'L');
		$pdf->SetXY($pdf->GetX() + 50, $pdf->GetY() - 5);
		$pdf->MultiCell(20, 5, $resep[$i]['qty'] . ' ' . $obat[0]['satuan_terkecil'], 0, 'L');
		$pdf->SetXY($pdf->GetX() + 70, $pdf->GetY() - 5);
		$pdf->MultiCell(50, 5, $resep[$i]['frekuensi'] . ' sehari saat ' . $resep[$i]['waktu_minum'], 0, 'L');
		$pdf->Ln();
	}

	$noPendaftaran = $data_resep[0]['no_daftar'];

	$racikHeader = $db->query("select * from tbl_racikan where no_daftar='" . $noPendaftaran . "' and status_delete='UD'");

	$pdf->SetFont('Arial', '', 8);
	for ($i = 0; $i < count($resep); $i++) {
		$obat = $db->query("select * from tbl_racikan_detail where racikanId='" . $racikHeader[$i]['id'] . "'");
		for ($x = 0; $x < count($obat); $x++) {
			$obat_s = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='" . $obat[$x]['kode_obat'] . "'");

			$pdf->MultiCell(50, 5, $racikHeader[$i]['nama'] . ' - ' . $obat[$x]['nama_obat'], 0, 'L');
			$pdf->SetXY($pdf->GetX() + 50, $pdf->GetY() - 5);
			$pdf->MultiCell(20, 5, $obat[$x]['qty'] . ' ' . $obat_s, 0, 'L');
			$pdf->SetXY($pdf->GetX() + 70, $pdf->GetY() - 5);
			$pdf->MultiCell(50, 5, '', 0, 'L');
			$pdf->Ln();
		}
	}

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(120, 2, '', 0, 1, 'L');
	$pdf->Cell(120, 6, '', 0, 1, 'L');
	$pdf->SetTextColor(0, 191, 255);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(130, 5, "Keterangan", 0, 1, 'L');
	//Jika obat tidak tersedia, harap hubungi Dokter penulis resep untuk mengkonsultasikan penggantian obat.

	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('Arial', '', 8);
	$pdf->Cell(50, 5, 'Jika obat tidak tersedia, harap hubungi Dokter penulis resep untuk mengkonsultasikan penggantian obat.', 0, 1, 'L');

	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(150, 40, $dokter[0]['nama_dokter'], 0, 1, 'L');

	$pdf->Output();
	//$pdf->Output('D', "SlipGaji-".$data[0]['nik']."-".$data[0]['nama'].$bln_nama[$bln]."-".$_POST['tahun'].".pdf", true);
	//$pdf->Output('F', '../../surat_rujukan/'.$nama_file);
} else {
?>

	<script language="javascript">
		alert("Mohon maaf, untuk kriteria yang Anda Pilih belum tersedia data");
		close();
	</script>

<?php
}
?>