<?php
	include '../3rdparty/engine.php';
	include '../3rdparty/funclogin.php';

//	$data = $db->query("select userid, sandi, nip, nama, code, user_shift  from tbl_user", 0);
echo $_POST["username"].PHP_EOL;
echo $_POST["password"].PHP_EOL;
echo $_POST["shiftUser"].PHP_EOL;

die();
$data = $db->query("select userid, sandi, nip, nama, code, user_shift  from tbl_user where userid='".$username."' and sandi='".md5($password)."'", 0);
	$update = $db->query("update tbl_user set user_shift='$shiftUser' where  userid='".$username."' and sandi='".md5($password)."'");
	$loginArea = login($username, $password, $data[0]['sandi'], $data[0]['nama'], $data[0]['nip'], $data[0]['code'], $shiftUser);
	if ($loginArea == 0) {
		echo 'nol'.PHP_EOL;
	}
	elseif ($loginArea == 1) {
		echo 'galat'.PHP_EOL;
	}
