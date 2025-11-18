<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>INHOUSE CLINIC | INDOLAKTO</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="../css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="../css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="../css/themes.css">


	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="../js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="../js/plugins/validation/jquery.validate.min.js"></script>
	<script src="../js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="../js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="../js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->



	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-precomposed.png" />

</head>
	
<body>
<?php
	date_default_timezone_set('Asia/Jakarta');  
  	//echo date("d F Y H:i:s");
  	//print_r($_GET);
  	include "../3rdparty/engine.php";
  	//$data = $db->query("select * from tbl_kiosk_tombol where md5(id)='".$_GET['id']."'");
  	//$urutan = $db->query("select urutan from tbl_kiosk_antrian where kode='".$data[0]['kode_tombol']."' and tanggal='".date("Y-m-d")."' order by urutan desc");
  	//if ($urutan[0]['urutan'] < 1) $nourut = 1;
  	//else $nourut = $urutan[0]['urutan'] + 1;
?>
    
  	<p align="center" style="align: center; margin-bottom: -10px;">
    	<img src="../images/logo1.png" height="50">
  	</p>
    	<hr style="border: 2px black solid;" />
  	<p align="center" style="align: center; font-size: 20px; font-weight: bold; margin-bottom: 0px; font-family: 'Arial Narrow';">
    	Nomor Antrian  
  	</p>
  	<p align="center" style="align: center; font-size: 15px; margin-bottom: 0px; font-family: 'Arial Narrow';">
    	Silahkan isi Nomor HP<br>yang terhubung dengan WA
        <form action="intrian_wa.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
               <div class="col-sm-12" style="width: 90%; margin-left: 5%; margin-top: 10px;">
                   <input type="number" id="nomr" name="nomr" placeholder="Contoh: 081234567890" class="form-control" required="required" />
               </div>
               <div class="form col-sm-12" style="width: 85%; margin-top: 10px;" align="right">
                   <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
                   <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Lanjutkan..." />
               </div>
            </div>
        </form>
  	</p>
</body>

</html>
