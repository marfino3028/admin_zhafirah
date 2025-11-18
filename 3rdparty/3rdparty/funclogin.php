<?php
//----------------------------------------
// fungsi untuk authentication dan logon
//----------------------------------------

//create session
session_start();

function login($user, $password, $hsl_pwd, $nama, $nip, $kode, $shift)
{
	if ($hsl_pwd == md5($password)) {
		$_SESSION['rg_user'] = $user;
		$_SESSION['rg_nama'] = $nama;
		$_SESSION['rg_nip'] = $nip;
		$_SESSION['rg_status'] = $kode;
		$_SESSION['rg_shift'] = $shift;
		$_SESSION['userid'] = $user;
		return 1;
	} else return 0;
}

function isloggedin()
{
	if (isset($_SESSION['rd_user'])) return 1;
	else return 0;
}

function logout()
{
	unset($_SESSION['rg_user']);
	unset($_SESSION['rg_nama']);
	unset($_SESSION['rg_nip']);
	unset($_SESSION['rg_status']);
	unset($_SESSION['rg_shift']);
	unset($_SESSION['userid']);
}
