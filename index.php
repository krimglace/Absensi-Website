<?php 
	include 'koneksi/config.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<!-- Fontawesome -->
	<!-- <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css"> -->

  	<title>Absensi Karyawan</title>
</head>
<body class="bg-dark">
	<nav class="navbar navbar-light bg-light mb-5">
  		<span class="navbar-brand mb-0 p-2 h1">Absensi Karyawan</span>
  		<div class="form-group">
    		<button id="btnlogin" class="body-page btn btn-outline-success my-2 my-sm-0" style="margin-right:6px" type="submit">Login</button>
    		<button id="btnabsen" class="body-page btn btn-outline-danger my-2 my-sm-0" style="margin-right:6px" type="submit">Absen</button>
  		</div>
	</nav>
  	<div class="oke">
  		
  	</div>

  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  	<script type="text/javascript">
  		$(document).ready(function(){
  			$('.body-page').click(function(){
				var menu = $(this).attr('id');
				if(menu == "btnlogin"){
					$('.oke').load('login.php');
				} else if(menu == "btnabsen"){
					$('.oke').load('absensi.php');
				}
			});
			$('.oke').load('absensi.php');

			setInterval (function() {
				$('.cekstatus').load('api_status.php');
				$('#datetime').load('timestamp.php?acak='+Math.random());
			},1000);
  		});
  	</script>
</body>
</html>