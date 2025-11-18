<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>TECHNOCARE | DIALISACARE</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
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
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login' onLoad="penting()">
    <div class="bg">
      <img src="images/technocareBack.jpg" alt="">
    </div>
    <div class="col-sm-4" style="min-height: 100%;"></div>
    <div class="col-sm-3" style="min-height: 100%;">
      <div style="padding-top: 50%;">
      	<div style="background-color: rgba(255,255,255, 0.8); padding-left: 20px; padding-right: 20px; padding-top: 20px; padding-bottom: 20px;"> 
        <p align="center">
        	<img src="images/1.png" width="230">
        </p>
        <div class="login-body">
            <h3 align="center">Forgot Password</h3>
            <form action="lupaPasswordUser.php" method='post' class='form-validate' id="test" autocomplete="off">
                <div class="form-group">
                    <div class="email controls">
                        <input type="text" class='form-control' data-rule-required="true" data-rule="true" autocomplete="off" placeholder="UserID / Email / No. HP" name="userid" id="userid" required/>
                    </div>
                </div>
                <div class="submit" style="text-align: right;">
                    <input type="submit" value="Reset Password" class='btn btn-primary'>
                </div>
            </form>
        </div>
      </div>
    </div>
	
    <div class="col-sm-4"></div>
</body>

</html>
