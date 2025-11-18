<?php
	session_start();
	// memanggil library FPDF
	require('fpdf.php');
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['penjamin_user'] != "") {
		$htravel = $db->query("select * from tbl_travel where no_daftar='".$_GET['id']."'");
		$dtravel = $db->query("select * from tbl_travel_detail where travel_id='".$htravel[0]['id']."'");
		$perusahaan = $db->query("select alamat_perusahaan, nama_perusahaan, kota from tbl_perusahaan where nama_perusahaan='".$dtravel[0]['klinik_asal']."'");

		$daftar = $db->query("select * from tbl_pendaftaran where no_daftar='".$htravel[0]['no_daftar']."'");
		$pasien = $db->query("select * from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
		$catatan = $db->query("select * from  tbl_catatan_dktr_hd where no_daftar='".$htravel[0]['no_daftar']."'");
		$kepala = $db->query("select * from tbl_jadwal_hd_header where no_daftar='".$htravel[0]['no_daftar']."'");
		$d1 = date_create($pasien[0]['tgl_lahir']);
		$d2 = date_create(date("Y-m-d"));
		$umur = date_diff($d1,$d2);
		 
		// intance object dan memberikan pengaturan halaman PDF
		$pdf=new FPDF('P','mm','A4');
		$pdf->AddPage();
		 
		$pdf->Image('logo_dialisa.png',10,12,40,'PNG');
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(35,10,'',0,0,'');
		$pdf->Cell(100,15,'TRAVELING PASIEN HEMODIALISA',0,0,'C');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(50,0,'No. RM : '.$htravel[0]['nomr'],0,1,'L');
		$pdf->Cell(135,10,'',0,0,'L');
		$pdf->Cell(50,10,'Nama : '.$htravel[0]['nama'],0,1,'L');
		$pdf->Cell(135,0,'',0,0,'L');
		$pdf->Cell(50,0,'Tanggal Lahir : '.$pasien[0]['nm_pasien'],0,1,'L');
		$pdf->Cell(5,5,'',0,1);
		$pdf->Cell(190, 0,'',1,1,"B");

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(190,10,'DATA PENGIRIMAN PASIEN HEMODIALISA',0,1,'C');
		$pdf->SetFont('Arial','I',11);
		$pdf->Cell(190,0,'TRAVELLING HEMODIALYSIS PATIENT QUESTIONARE',0,1,'C');

		$pdf->Cell(190,5,'',0,1,'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(90,10,'',0,0,'L');
		$pdf->Cell(100,5,'Berasal dari',0,1,'L');
		$pdf->Cell(90,10,'',0,0,'L');
		$pdf->Cell(100,5, $dtravel[0]['klinik_asal'],0,1,'L');
		$pdf->Cell(90,10,'',0,0,'L');
		$pdf->Cell(100,5, "Di:",0,1,'L');
		$pdf->Cell(90,10,'',0,0,'L');
		if (strlen($perusahaan[0]['alamat_perusahaan']) >= 50) {
			$pdf->Cell(100,5, substr($perusahaan[0]['alamat_perusahaan'], 0, 50),0,1,'L');
			$pdf->Cell(90,10,'',0,0,'L');
			$pdf->Cell(100,5, substr($perusahaan[0]['alamat_perusahaan'], 50, 50),0,1,'L');
			$pdf->Cell(90,10,'',0,0,'L');
			$pdf->Cell(100,5, substr($perusahaan[0]['alamat_perusahaan'], 100, 50),0,1,'L');

		}
		else {
			$pdf->Cell(100,5, $perusahaan[0]['alamat_perusahaan'],0,1,'L');
		}
		$pdf->Cell(190, 3,'',0,1,"B");
		$pdf->Cell(190, 0,'',1,1,"B");

		$pdf->Cell(190, 3,'',0,1,"");
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(82,7,'Dengan ini kami kirim pasien hemodialisa serta ',0,0,'L');
		$pdf->SetFont('Arial','I',11);
		$pdf->Cell(52,7,'Travelling Hemodialysis Patient Questionare ',0,1,'L');
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(80,5,'sebagai berikut:',0,1,'0');

		$pdf->Cell(190, 3,'',0,1,"");
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Nama Pasien',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$htravel[0]['nama'],0,1,'L');

		$htravel[0]['kebangsaan'] = "Indonsesia";
		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Kebangsaan',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$htravel[0]['kebangsaan'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Alamat',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Riwayat Penayakit',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Diagnosa Medik',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Tanggal Pertama Hemodialisa',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Frekuensi HD, Lama HD',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Mesin HD, Jenis Dializer',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Jenis Cairan Dialisat',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Jenis Akses Vaskuler',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Heparinisasi',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Hasil Pemeriksaan Laboratorium',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Sebelum HD',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Sesudah  HD',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Pemeriksaan HBsAg',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Pemeriksaan HIV',0,0,'L');
		$pdf->Cell(3,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Periksa Tanda-Tanda Vital',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(6,6,'TD',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(9,6,'Nadi',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(6,6,'RR',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(10,6,'Suhu',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(5,6,'',0,0,'L');
		$pdf->Cell(60,6,'Berat Badan',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(13,6,'Pre HD',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(15,6,'Post HD',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(18,6,'BB Kering',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(10,6,'Suhu',0,0,'L');
		$pdf->Cell(6,6,':',0,0,'L');
		$pdf->Cell(50,6,$pasien[0]['alamat'],0,1,'L');

		$pdf->Cell(190, 3,'',0,1,"B");
		$pdf->Cell(190, 0,'',1,1,"B");

		$pdf->Cell(190, 10,'',0,1,"B");
		$pdf->Cell(20,10,'',0,0,'L');
		$pdf->Cell(100,5,$perusahaan[0]['kota'].', '.date("d F Y"),0,1,'L');
		$pdf->Cell(20,10,'',0,0,'L');
		$pdf->Cell(100,5, 'Dokter Pj Pelayanan HD '.$perusahaan[0]['nama_perusahaan'],0,1,'L');
		$pdf->Cell(20,10,'',0,0,'L');
		$pdf->Cell(100,20, "",0,1,'L');
		$pdf->Cell(20,10,'',0,0,'L');
		$pdf->Cell(100,5, $dtravel[0]['dokter_nama'],0,1,'L');
		$pdf->Cell(190, 3,'',0,1,"B");
		$nama_file = $_GET['id'].'_asal.pdf';
		
		//Masukkan ke tabel
		$insert = $db->query("insert into tbl_surat_rujukan (jenis, no_daftar, nomr, nama, nama_file) values ('Klinik Tujuan', '".$htravel[0]['no_daftar']."', '".$htravel[0]['nomr']."', '".$htravel[0]['nama']."', '$nama_file')");		

		//$pdf->Output();
		//$pdf->Output('D', "Rujukan_asal-".$data[0]['nik']."-".$data[0]['nama'].$bln_nama[$bln]."-".$_POST['tahun'].".pdf", true);
		$pdf->Output('F', '../../surat_rujukan/'.$nama_file);

		//Kirim email
		//Belum dicoba

		//Kirim ke WA
		$token = $db->query("select nilai from tbl_config where kode='WA-API'");
		$token_wa = $token[0]['nilai'];
        	$curl = curl_init();
		//$data2[0]['no_hp'] = '087884947802';
		$data2[0]['no_hp'] =  $pasien[0]['telp_pasien'];
		$dtravel = $db->query("select * from tbl_travel_detail where travel_id='".$htravel[0]['id']."' and status_delete='UD'");
		for ($k = 0; $k < count($dtravel); $k++) {
			$nos = $nos + 1;
			//$linktxt = $linktxt. "$nos. http://103.157.26.142/pages_penjamin/hd/surat_travel_print.php?id=".md5($dtravel[$k]['id'])."\n";
			$access_token = 'aa9c607342df5b98f3662f3f3217f2f4c9ec3808';
			$long_url = "http://103.157.26.142/pages_penjamin/hd/surat_travel_tujuan_print.php?id=".md5($dtravel[$k]['id']);
			$curlBitly = curl_init();
			curl_setopt_array($curlBitly, array(
				CURLOPT_URL => 'https://api-ssl.bitly.com/v4/shorten',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode(array("long_url" => $long_url)),
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'Authorization: Bearer ' . $access_token
				),
			));
	
			$response = curl_exec($curlBitly);
	
			curl_close($curlBitly);
			$response_data = json_decode($response, true);
			if (isset($response_data['link'])) {
				$short_url = $response_data['link'];
			} else {
				//echo 'Error shortening the URL. Response: ' . $response;
				$short_url = 'Tidak ada';
			}

			$linktxt = $linktxt.$short_url."\n";
		}

		$pesan = '*Dear '.$htravel[0]['nama'].'*,
    		
Berikut ini adalah surat Rujukan dari klinik Tujuan yang bisa Anda Download melalui Link yang ada dbawah ini

'.$linktxt.'
Terima kasih';

		//print_r($pesan);
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
        'target' => $data2[0]['no_hp'],
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$token_wa //change TOKEN to your actual token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

?>
	<script language="javascript">
            alert ("Surat rujukan untuk Asal Klinik Anda sudah terkirim ke nomor WA Anda");
            close();
        </script>
<?php
	}
	else {
?>

	<script language="javascript">
            alert ("Mohon maaf, untuk kriteria yang Anda Pilih belum tersedia data");
            close();
        </script>

<?php
	}
?>