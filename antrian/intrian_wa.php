<?php
	date_default_timezone_set('Asia/Jakarta');  
  	//echo date("d F Y H:i:s");
  	//print_r($_GET);
  	include "../3rdparty/engine.php";
  	$data = $db->query("select * from tbl_kiosk_tombol where md5(id)='".$_POST['id']."'");
  	$urutan = $db->query("select urutan from tbl_kiosk_antrian where kode='".$data[0]['kode_tombol']."' and tanggal='".date("Y-m-d")."' order by urutan desc");
  	if ($urutan[0]['urutan'] < 1) $nourut = 1;
  	else $nourut = $urutan[0]['urutan'] + 1;
	
	$kode_bener = strtoupper($data[0]['kode_tombol']).$nourut;

	// isi qrcode yang ingin dibuat. akan muncul saat di scan
	$isi = $kode_bener;

	// memanggil library php qrcode
	include "phpqrcode/qrlib.php"; 

	// nama folder tempat penyimpanan file qrcode
	$penyimpanan = "temp/";

	// membuat folder dengan nama "temp"
	if (!file_exists($penyimpanan))
	 mkdir($penyimpanan);

	// perintah untuk membuat qrcode dan menyimpannya dalam folder temp
	// atur level pemulihan datanya dengan QR_ECLEVEL_L | QR_ECLEVEL_M | QR_ECLEVEL_Q | QR_ECLEVEL_H
	// atur pixel qrcode pada parameter ke 4
	// atur jarak frame pada parameter ke 5
	QRcode::png($isi, $penyimpanan.'Hasil'.$isi.'.png', QR_ECLEVEL_L, 10, 5); 
	
  	$insert = $db->query("insert into tbl_kiosk_antrian (tanggal, kode, urutan, nomor, no_wa) values ('".date("Y-m-d")."', '".$data[0]['kode_tombol']."', '".$nourut."', '".strtoupper($data[0]['kode_tombol']).$nourut."', '".$_POST['nomr']."')", 0);
	$id = mysql_insert_id();
	$id_kode = md5($id);
	//echo '<img src="'.$penyimpanan.'Hasil'.$isi.'.png">';
	//echo 'isi: '.$isi;
	$nama_file = $penyimpanan.'Hasil'.$isi.'.png';

	//Kirim WA
	$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
	$kodeWA[0]['nilai'] = 'zjP-C@9s!n+mi29G+xnd';
	$telp = $_POST['nomr'];
        $curl = curl_init();

		$pesan = '
Berikut adalah QRCode untuk Antrian Anda';

		print_r($pesan);
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
        'url' => 'http://103.157.26.142/antrian/'.$nama_file, 
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$kodeWA[0]['nilai'] //change TOKEN to your actual token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

?>
<script language="Javascript">
	window.location = "print_kartu.php?id=<?php echo $id_kode; ?>";
</script>