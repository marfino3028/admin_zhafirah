<?php
ini_set("display_errors", 0);
session_start();
include "3rdparty/engine.php";
include "3rdparty/funcpages.php";
date_default_timezone_set('Asia/Jakarta');
if ($_SESSION['dokter_user'] != "" or $_SESSION['dokter_userid'] != "") {
  //include "default.php";
  include "header_dokter.php";
  if ($_GET['mod'] == 'logout') {
      unset($_SESSION['dokter_user']);
      unset($_SESSION['dokter_nama']);
      unset($_SESSION['dokter_shift']);
      unset($_SESSION['dokter_userid']);
      echo '<script language="javascript">window.location = "index.php";</script>';
  }
  else {
//print_r($_SESSION);
      if ($_GET['mod'] == "" and $_GET['submod'] == "") {
          include "pages_dokter/depan.php";
      }
      else if ($_GET['mod'] != "" and $_GET['submod'] != "") {
          include "pages_dokter/".$_GET['mod']."/".$_GET['submod'].".php";
      }
  }
  include "footer.php";
}
else {
    echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>


