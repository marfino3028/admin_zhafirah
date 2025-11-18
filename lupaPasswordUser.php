<?php
	include "3rdparty/engine.php";
	//use PHPMailer\PHPMailer\PHPMailer;
	//use PHPMailer\PHPMailer\Exception;
	// Include librari phpmailer
	//include('phpmailer/Exception.php');
	//include('phpmailer/PHPMailer.php');
	//include('phpmailer/SMTP.php');
	//print_r($_POST);

	function getName($n) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
		$randomString = '';
	 
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
	 
		return $randomString;
	}
	
	if ($_POST['userid'] != "") {
		$data = $db->query("select * from tbl_user where userid='".$_POST['userid']."' or telp='".$_POST['userid']."' or email='".$_POST['userid']."'");
		if ($data[0]['jenis_akun'] == 'DEMO') {
			//echo 'INI AKUN DEMO';
			$hariini = date("Y-m-d");
			$dataDemo = $db->query("select * from tbl_user where (userid='".$_POST['userid']."' or telp='".$_POST['userid']."' or email='".$_POST['userid']."') and hingga >= '$hariini'", 0);
			if ($dataDemo > 0) {
				$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
				//Update Data Base user sesuai dengan permintaan
				$new_password = getName(8);
				$update = $db->query("update tbl_user set sandi='".md5($new_password)."', force_ganti='2', blok='NB', coba='0' where id='".$data[0]['id']."'");
				echo "update tbl_user set sandi='".md5($new_password)."', force_ganti='2' where id='".$data[0]['id']."'";
				$telp = $data[0]['telp'];
				$pic = $data[0]['nama'];
				$token = $db->query("select nilai from tbl_config where kode='WA-API'");
	
			$curl = curl_init();
	
			$pesan = '*Dear '.$pic.'*,
				
Anda telah me-reset Password Anda di Aplikasi Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

URL : https://technocare.id/
User ID : '.$data[0]['userid'].'
Password : '.$new_password.'
	
	Terima kasih';
	
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
			'message' => $pesan, 
			'countryCode' => '62', //optional
			),
			  CURLOPT_HTTPHEADER => array(
			'Authorization: '.$kodeWA[0]['nilai'] //change TOKEN to your actual token
			  ),
			));
	
			$response = curl_exec($curl);
	
			curl_close($curl);
	
			  
				//Masukkan ke tabel pengiriman WA
				$message = '*Dear '.$pic.'*,
				
	Anda telah me-reset Password Anda di Aplikasi Klinik Dialisacare.
	Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.
	
	URL : https://technocare.id/
	User ID : '.$data[0]['userid'].'
	Password : '.$new_password.'
	
	Terima kasih
				';
				$insert = $db->query("insert into tbl_notifikasi_wa (kepada_no, kepada_nama, isi) value ('$telp', '$pic', '$message')");
				
				//Kirim ke Email
				$message = '
		<html>
	
		<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Notifikasi pengiriman Perubahan Password</title>
		</head>
	
		<body>
		<div align="left">
			<table border="0" cellpadding="0" style="border-collapse: collapse; border: 2px solid #0000FF" width="600">
				<tr>
					<td>
						<p style="margin: 10px"><font face="Calibri" color="#000000">
							Dear '.$pic.',<br><br>
							Anda telah me-reset Password Anda di Aplikasi Klinik Dialisacare.<br>
							Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.<br><br
							
							URL : https://technocare.id/<br>
							User ID : '.$data[0]['userid'].'<br>
							Password : '.$new_password.'<br><br>
							
							Terima kasih
						</font></p>
					</td>
				</tr>
			</table>
		</div>
	
		</body>
	
		</html>		
				';
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// More headers
				$headers .= 'From: Notifikasi-Technocare<info@demo.klinik.id>' . "\r\n";
				
				mail($data[0]['email'], 'Reset Password', $message, $headers);
			  
				echo '
					<script language="javascript">
						alert("Update / Reset Password Berhasil. Silahkan cek WA Anda");
						window.location = "index.php";
					</script>			
				';
			}
			else {
				echo '
					<script language="javascript">
						alert("Mohon Maaf User ID dan/atau No. HP DEMO Anda sudah tidak berlaku lagi");
						window.location = "LupaPassword.php";
					</script>			
				';
			}
		}
		//elseif ($data[0]['jenis_akun'] == 'REGULER') {
		else {
		$kodeWA = $db->query("select nilai from tbl_config where kode='WA-API'");
		//$kodeWA[0]['nilai'] = 'zjP-C@9s!n+mi29G+xnd';
		if (count($data) > 0) {
			//Update Data Base user sesuai dengan permintaan
			$new_password = getName(8);
			$update = $db->query("update tbl_user set sandi='".md5($new_password)."', force_ganti='2', blok='NB', coba='0' where id='".$data[0]['id']."'");
			echo "update tbl_user set sandi='".md5($new_password)."', force_ganti='2' where id='".$data[0]['id']."'";
			$telp = $data[0]['telp'];
			$pic = $data[0]['nama'];
			$token = $db->query("select nilai from tbl_config where kode='WA-API'");

        $curl = curl_init();

		$pesan = '*Dear '.$pic.'*,
    		
Anda telah me-reset Password Anda di Aplikasi Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

URL : https://technocare.id/
User ID : '.$data[0]['userid'].'
Password : '.$new_password.'

Terima kasih';

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
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
          CURLOPT_HTTPHEADER => array(
		'Authorization: '.$kodeWA[0]['nilai'] //change TOKEN to your actual token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

          
          	//Masukkan ke tabel pengiriman WA
          	$message = '*Dear '.$pic.'*,
    		
Anda telah me-reset Password Anda di Aplikasi Klinik Dialisacare.
Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.

URL : https://technocare.id/
User ID : '.$data[0]['userid'].'
Password : '.$new_password.'

Terima kasih
            ';
            $insert = $db->query("insert into tbl_notifikasi_wa (kepada_no, kepada_nama, isi) value ('$telp', '$pic', '$message')");
            
            //Kirim ke Email
			$message = '
	<html>

	<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
	<title>Notifikasi pengiriman Perubahan Password</title>
	</head>

	<body>
	<div align="left">
		<table border="0" cellpadding="0" style="border-collapse: collapse; border: 2px solid #0000FF" width="600">
			<tr>
				<td>
					<p style="margin: 10px"><font face="Calibri" color="#000000">
						Dear '.$pic.',<br><br>
                        Anda telah me-reset Password Anda di Aplikasi Klinik Dialisacare.<br>
                        Berikut Informasi yang bisa Anda gunakan untuk masuk ke Aplikasi Klinik Dialisacare.<br><br
                        
                        URL : https://technocare.id/<br>
                        User ID : '.$data[0]['userid'].'<br>
                        Password : '.$new_password.'<br><br>
                        
                        Terima kasih
					</font></p>
				</td>
			</tr>
		</table>
	</div>

	</body>

	</html>		
			';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: Notifikasi-Technocare<info@demo.klinik.id>' . "\r\n";
            
            mail($data[0]['email'], 'Reset Password', $message, $headers);
          
			echo '
				<script language="javascript">
					alert("Update / Reset Password Berhasil. Silahkan cek WA Anda");
					window.location = "index.php";
				</script>			
			';
		}
		else {
			echo '
				<script language="javascript">
					alert("Mohon Maaf User ID dan/atau No. HP Terdaftar tidak ada dalam database");
					window.location = "LupaPassword.php";
				</script>			
			';
		}
		}
	}
?>
