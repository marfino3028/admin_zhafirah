<?php
	session_start();  
	date_default_timezone_set('Asia/Jakarta');  
  	//echo date("d F Y H:i:s");
  	//print_r($_GET);
  	include "../../3rdparty/engine.php";

	if ($_SESSION['rg_user'] != '') {
		$data = $db->query("select * from tbl_perjanjian where md5(id)='".$_GET['id']."'", 0);
		if ($data[0]['antrian_no'] < 1) {
		$nomor = $db->query("select antrian_no from tbl_perjanjian order by antrian_no desc", 0);
		if ($nomor[0]['antrian_no'] < 1) $nomor[0]['antrian_no'] = 1;
		else $nomor[0]['antrian_no'] = $nomor[0]['antrian_no'] + 1;
		//print_r($nomor[0]['antrian_no']);
	
		$kode_bener = 'HD'.$nomor[0]['antrian_no'];

		// isi qrcode yang ingin dibuat. akan muncul saat di scan
		$isi = $kode_bener;
		//echo "$isi = $kode_bener";

		// memanggil library php qrcode
		include "phpqrcode/qrlib.php"; 

		// nama folder tempat penyimpanan file qrcode
		$penyimpanan = "qrcode/";

		// membuat folder dengan nama "temp"
		if (!file_exists($penyimpanan))
	 	mkdir($penyimpanan);

		// perintah untuk membuat qrcode dan menyimpannya dalam folder temp
		// atur level pemulihan datanya dengan QR_ECLEVEL_L | QR_ECLEVEL_M | QR_ECLEVEL_Q | QR_ECLEVEL_H
		// atur pixel qrcode pada parameter ke 4
		// atur jarak frame pada parameter ke 5
		QRcode::png($isi, $penyimpanan.'Hasil'.$isi.'.png', QR_ECLEVEL_L, 10, 5); 

		$update = $db->query("update tbl_perjanjian set antrian_no='".$nomor[0]['antrian_no']."', antrian_nomor='$isi' where md5(id)='".$_GET['id']."'", 0);
		$nama_file = $penyimpanan.'Hasil'.$isi.'.png';

		//Kirim WA
		$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		$kodeWA[0]['nilai'] = 'zjP-C@9s!n+mi29G+xnd';
		$telp = $data[0]['hp'];
        	$curl = curl_init();

		$pesan = '
Berikut adalah QRCode untuk Antrian Perjanjian Anda';

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
        	'target' => $telp,
        	'url' => 'http://103.157.26.142/pages/pendaftaran/'.$nama_file, 
        	'message' => $pesan, 
        	'countryCode' => '62', //optional
        	),
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$kodeWA[0]['nilai'] //change TOKEN to your actual token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
	  }
	}
?>
<script language="Javascript">
	window.location = "print_kartu.php?id=<?php echo $_GET['id']; ?>";
</script>
