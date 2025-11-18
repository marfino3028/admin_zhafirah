<?php
ini_set("display_errors", 0);
session_start();
include "3rdparty/engine.php";
include "3rdparty/funcpages.php";
date_default_timezone_set('Asia/Jakarta');
if ($_SESSION['mcu_user'] != "" or $_SESSION['mcu_userid'] != "") {
  //include "default.php";
  include "header_mcu.php";
  if ($_GET['mod'] == 'logout') {
      unset($_SESSION['mcu_user']);
      unset($_SESSION['mcu_nama']);
      unset($_SESSION['mcu_shift']);
      unset($_SESSION['mcu_userid']);
      echo '<script language="javascript">window.location = "index.php";</script>';
  }
  else {
//print_r($_SESSION);
      if ($_GET['mod'] == "" and $_GET['submod'] == "") {
          include "pages_mcu/depan.php";
      }
      else if ($_GET['mod'] != "" and $_GET['submod'] != "") {
          include "pages_mcu/".$_GET['mod']."/".$_GET['submod'].".php";
      }
  }
  include "footer.php";
}
else {
    echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>


