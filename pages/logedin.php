<?php
	include '../3rdparty/engine.php';
	include '../3rdparty/funclogin.php';

	if(isset($_POST["username"])){$username=$_POST["username"];}else{$username="";}
	if(isset($_POST["password"])){$password=$_POST["password"];}else{$password="";}
	if(isset($_POST["shiftUser"])){$shiftUser=$_POST["shiftUser"];}else{$shiftUser="";}
	
	$data = $db->query("select userid, sandi, nip, nama, code, user_shift  from tbl_user where userid='".$username."' and sandi='".md5($password)."'", 0);
	$update = $db->query("update tbl_user set user_shift='$shiftUser' where  userid='".$username."' and sandi='".md5($password)."'");
	$loginArea = login($username, $password, $data[0]['sandi'], $data[0]['nama'], $data[0]['nip'], $data[0]['code'], $shiftUser);
	if ($loginArea == 0) {
		echo '<div class="response-msg error ui-corner-all"><span>Error message</span>Invalid Username/Password</div>';
	}
	elseif ($loginArea == 1) {
		echo '<script language="javascript">window.location = "index.php";</script>';
	}
?>