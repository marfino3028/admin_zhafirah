<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
session_start();
include "3rdparty/engine.php";
include "3rdparty/funcpages.php";
date_default_timezone_set('Asia/Jakarta');

if ((isset($_SESSION['rg_user']) && $_SESSION['rg_user'] != "") or (isset($_SESSION['userid']) && $_SESSION['userid'] != "")) {
  //include "default.php";
  include "header.php";
  if ($_GET['mod'] == 'logout') {
      unset($_SESSION['rg_user']);
      unset($_SESSION['rg_nama']);
      unset($_SESSION['rg_nip']);
      unset($_SESSION['rg_status']);
      unset($_SESSION['rg_shift']);
      unset($_SESSION['user_shift']);
      unset($_SESSION['userid']);

      unset($_SESSION['penjamin_user']);
      unset($_SESSION['penjamin_nama']);
      unset($_SESSION['penjamin_nip']);
      unset($_SESSION['penjamin_status']);
      unset($_SESSION['penjamin_shift']);
      unset($_SESSION['penjamin_userid']);

      unset($_SESSION['dokter_user']);
      unset($_SESSION['dokter_nama']);
      unset($_SESSION['dokter_nip']);
      unset($_SESSION['dokter_status']);
      unset($_SESSION['dokter_shift']);
      unset($_SESSION['dokter_userid']);
      echo '<script language="javascript">window.location = "index.php";</script>';
  }
  else {
	$user_password = $db->query("select force_ganti from tbl_user where userid='".$_SESSION['rg_user']."'");
    if ($user_password[0]['force_ganti'] == "2") {
      include "force_ganti_user.php";
    }
    else {
      if ($_GET['mod'] == "" and $_GET['submod'] == "") {
          include "pages/depan.php";
      }
      else if ($_GET['mod'] != "" and $_GET['submod'] != "") {
          include "pages/".$_GET['mod']."/".$_GET['submod'].".php";
      }
    }
  }
  include "footer.php";
}
else {
    echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>


