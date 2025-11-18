<?php
	session_start();
	include "3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != '') {
		$UserID = $db->query("select * from tbl_user where userid='".$_SESSION['rg_user']."'");
		//print_r($_POST);
		//print_r($UserID);
		if (md5($_POST['password1']) == $UserID[0]['sandi']) {
			//echo "Akan Update Password";
			//echo 'test';
			$update = $db->query("update tbl_user set sandi='".md5($_POST['password2'])."', force_ganti='1' where userid='".$_SESSION['rg_user']."'");
			echo '<script language="javascript">
					alert("Password Anda sudah diupdate. Silahkan login menggunakan Password baru Anda");
					window.location = "index.php?mod=logout";
				</script>';
		}
		else {
			echo '<script language="javascript">
					alert("Password Anda yang sebelumnya salah, silahkan isi kembali Password lama Anda");
					window.location = "index.php";
				</script>';
		}
	}
?>

