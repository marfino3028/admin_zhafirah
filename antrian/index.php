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


	<script language="javascript">
		function penting() {
			document.getElementById('userid').focus();
		}
	</script>

	<style>
		.bg {
		  position: fixed; 
		  top: -50%; 
		  left: -50%; 
		  width: 200%; 
		  height: 200%;
		}
		.bg img {
		  position: absolute; 
		  top: 0; 
		  left: 0; 
		  right: 0; 
		  bottom: 0; 
		  margin: auto; 
		  min-width: 50%;
		  min-height: 50%;
		  opacity:0.8;
		}
	</style>

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-precomposed.png" />

    <script language="javascript">
        function CetakKartu(id) {
            var w = 300;
            var h = 350;
            var l = (screen.width - w) / 2;
            var t = (screen.height - h) / 2;
            var windowprops = "location=no,scrollbars=no,menubars=no,toolbars=no, toolbox=no,resizable=no" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

            var URL = 'index_print_sebelum.php?id=' + id;
            if (id != 0) {
                popup = window.open(URL,"",windowprops);
            }
        }
	  </script>
  
</head>
  
<body class='login'>
    <div class="bg">
      <img src="../images/technocareBack.jpg" alt="">
    </div>
  	<div class="row">
      <div class="col-sm-12">
          <div style="float: left;"><img src="../images/logo1.png" width="300"></div>
          <div style="float: right;"><img src="../images/1.png" width="300"></div>
      </div>
    </div>
	
  	<div class="row">
    	<div class="col-sm-12 text-center" style="font-size: 16px; background-color: white; padding-top: 10px; padding-bottom: 10px;">
      		Silahkan Tekan Tombol Nomor Loket untuk Mencetak Nomor Antrian Anda
     	</div>
    </div>
  
  	<div class="row">
      	<?php
        	ini_set('display_errors', 1);
      		include "../3rdparty/engine.php";
      		$data = $db->query("select * from tbl_kiosk_tombol where md5(kiosk_id)='".$_GET['id']."'");
      		for ($i = 0; $i < count($data); $i++) {
      	?>
  		<div class="col-sm-6" style="background:url('../images/back_tombol_polos.png'); background-repeat: no-repeat; background-position: left; background-size: 100% 100px; height: 100px; color: white; cursor: pointer" title="Click Untuk Print/Cetak <?php echo $data[$i]['nama_kios'].' '.$data[$i]['nama_tombol']?>" onclick="CetakKartu('<?php echo md5($data[$i]['id'])?>')">
          <div style="float: left; font-size: 20px; color: white; padding-top: 20px; padding-left: 20px;">
            <img src="../images/print.png" width="60">
          </div>
          <p style="padding-top: 28px; margin-bottom: 0px; margin-left: 100px; font-size: 20px;">
            <?php echo $data[$i]['nama_kios'].' '.$data[$i]['nama_tombol']?></p>
          <p style="margin-top: 0px; margin-left: 100px; font-size: 12px;">
            <?php echo $data[$i]['nama_kios']?>
          </p>
      	</div>
      	<?php
            }
        ?>
  	</div>
</body>

</html>
