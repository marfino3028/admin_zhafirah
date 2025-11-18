<?php
ini_set("display_errors", 0);
session_start();
include "3rdparty/engine.php";
include "3rdparty/funcpages.php";
date_default_timezone_set('Asia/Jakarta');

if ($_SESSION['penjamin_user'] != "" or $_SESSION['penjamin_userid'] != "") {
  //include "default.php";
  include "header_penjamin.php";
  if ($_GET['mod'] == 'logout') {
      unset($_SESSION['penjamin_user']);
      unset($_SESSION['penjamin_nama']);
      unset($_SESSION['penjamin_shift']);
      unset($_SESSION['penjamin_userid']);
      echo '<script language="javascript">window.location = "index.php";</script>';
  }
  else {
      if ($_GET['mod'] == "" and $_GET['submod'] == "") {
          include "pages_penjamin/depan.php";
      }
      else if ($_GET['mod'] != "" and $_GET['submod'] != "") {
          include "pages_penjamin/".$_GET['mod']."/".$_GET['submod'].".php";
      }
  }
  include "footer.php";
}
else {
    echo '<script type="text/javascript">window.location = "login.php";</script>';
}
?>


