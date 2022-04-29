<?php
	
	session_start();
	if( !isset($_SESSION['rfid']) ) 
	echo "<script>
        alert('Anda Harus Login Terlebih Dahulu');
        window.location = '../'
      </script>
      ";

	//manggil koneksi
	require '../koneksi/config.php';

	$rfid = $_SESSION['rfid'];
	$query = mysqli_query($conn, "SELECT * FROM user as us JOIN karyawan as ad ON us.rfid = ad.rfid WHERE us.rfid = '$rfid'");
	$result = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Page | Karyawan</title>

	<!-- Bootstrap CSS -->
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  	<!-- Font Awesome CDN -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  	<style type="text/css">
  		#content{
  			width: 80%;
  			float: right;
  			transition: .5s;
  		}
  		#content.w{
  			width: 95%;
  		}
  		#navbar{
  			border-bottom: 1px solid black;
  		}
  		#toggle-menu{
			width: 35px;
			margin: 15px 0 15px 10px;
			cursor: pointer;
		}
		.bar{
			height: 4px;
			width: 75%;
			background-color: black;
			display: block;
			border-radius: 5px;
			transition: .3s ease;
		}
		#bar1{
			transform: translateY(-4px);
		}
		#bar3{
			transform: translateY(4px);
		}
		.fullwidth{
			width: 100%;
		}
		.home-menu{
			margin: 5px 0 0 20px;
		}
		.home-menu a{
			text-decoration: none;
			color: black;
			transition: .5s;
		}
		.home-menu a:hover{
			text-decoration: underline;
			transition: .5s;
		}
		.sidebar-menu{
			height: 100%;
			position: fixed;
			width: 20%;
			transition: .5s;
			padding-top: 15px;
			border-right: 1px solid black;
		}
		.sidebar-menu a{
			text-decoration: none;
			color: black;
		}
		.move-side{
			width: 5%;
			transition: .5s;
		}
		.hidden-text{
			display: none;
			transition: .5s;
		}

		.brand-text{
			transition: .5s;
		}
		.float-icon{
			margin-left: 10%;
			font-size: 150%;
			text-align: center;
			transition: .5s;
		}
		.side-menu h5{
			padding: 3% 10%;
			color: white;
		}
		.side-menu a:hover h5{
			background-color: gray;
		}
		.pengaturan a{
			text-decoration: none;
			color: black;
			cursor: pointer;
		}
		.pengaturan a:hover{
			color: gray;
		}
		.pengaturan{ right: 10px;background: white; display: none; padding: 10px; border-radius: 5px; transition: .5s; border: 1px solid black;}
		.aktif{ display: block; transition: .5s; z-index: 1000; position: absolute;}
		.sidebar-menu a{
			cursor: pointer;
		}
  	</style>
</head>
<body class="bg-light">
	<div class="content-fluid">
		<div class="content" id="content">
			<div class="topbar">
				<nav class="navbar navbar-expand-lg navbar-light bg-white" id="navbar">
					<div id="navbar-menu" class="navbar-menu">
						<div id="toggle-menu" onclick="onClickMenu()">
							<div id="bar1" class="bar"></div>
							<div id="bar2" class="bar"></div>
							<div id="bar3" class="bar"></div>
						</div>
					</div>
					<div class="home-menu">
						<h5><a href="../Karyawan/?rfid=<?= $result['rfid'] ?>">Home</a></h5>
					</div>

					<div style=" right: 30px;position: absolute; color: black">
						<i style="cursor: pointer;" class="fas fa-user-cog" onclick="onClickSetting()"></i>
					</div>
				</nav>
				<div class="clearfix"></div>
				<div class="pengaturan text-center" id="pengaturan">
					<a class="menu-item" id="sett-user" style="border-bottom: 1px solid black"><?= $result['nama'] ?></a><br>
					<a href="php/logout.php">Logout</a>
				</div>
			</div>
			<div class="section">
				
			</div>
			<footer class="main-footer bg-light fixed-bottom text-end" style="z-index: -1; padding: 10px 30px; border-top: 1px solid black">
				<strong>Copyright &copy; 2022 </strong>
			</footer>
		</div>
		<div class="sidebar-menu bg-dark text" id="sidebar-menu" style="">
			<h5 class="title text-center">
				<a href="../Karyawan/?rfid=<?= $result['rfid'] ?>" class="brand-link text-white" id="icon-menu">
					<i class="fas fa-clipboard-list mr-3 ml-4"></i>
						<span class="brand-text font-weight-light" id="brand-text">Administrator</span>
				</a>		
				<div class="clearfix"></div>
			</h5>
			<hr id="brand-text" style="color: black;">
			<nav class="side-menu" id="main-menu">
				<a class="menu-item" id="Dashboard">
					<h5>
						<i class="fas fa-tachometer-alt"></i>
						<span class="font-weight-light" id="label-menu-1">Dashboard</span>
						<div class="clearfix"></div>
					</h5>
				</a>
				<a class="menu-item" id="kegiatan">
					<h5 class="title text-justify">
						<i class="fas fa-list mr-3 ml-4"></i>
							<span class="brand-text font-weight-light" id="label-menu-2">Isi Kegiatan</span>
						<div class="clearfix"></div>
					</h5>
				</a>
				<a class="menu-item" id="daily">
					<h5 class="title text-justify">
						<i class="fas fa-book mr-3 ml-4"></i>
							<span class="brand-text font-weight-light" id="label-menu-3">Data Harian</span>
						<div class="clearfix"></div>
					</h5>
				</a>
				<a class="menu-item" id="sett">
					<h5 class="title text-justify">
						<i class="fas fa-user-cog mr-3 ml-4"></i>
							<span class="brand-text font-weight-light" id="label-menu-4"><?= $result['nama'] ?></span>
						<div class="clearfix"></div>
					</h5>
				</a>
			</nav>
		</div>
	</div>

	<script type="text/javascript">
		function onClickMenu(){
			var menu = 
				document.getElementById('content').classList.toggle("w");
				document.getElementById('sidebar-menu').classList.toggle("move-side");
				document.getElementById('icon-menu').classList.toggle("float-icon");
				document.getElementById('brand-text').classList.toggle("hidden-text");
				document.getElementById('label-menu-1').classList.toggle("hidden-text");
				document.getElementById('label-menu-2').classList.toggle("hidden-text");
				document.getElementById('label-menu-3').classList.toggle("hidden-text");
				document.getElementById('label-menu-4').classList.toggle("hidden-text");
				document.getElementById('main-menu').classList.toggle("text-center");
		}
		function onClickSetting(){
			document.getElementById('pengaturan').classList.toggle("aktif");
		}
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script type="text/javascript">
  		$(document).ready(function(){
  			$('.menu-item').click(function(){
				var menu = $(this).attr('id');
				if(menu == "Dashboard"){
					$('.section').load('dashboard.php');
				} else if(menu == "kegiatan"){
					$('.section').load('kegiatan.php');
				} else if(menu == "daily"){
					$('.section').load('daily.php');
				} else if(menu == "sett" || menu == "sett-user"){
					$('.section').load('sett-user.php');
				}

			});
			$('.section').load('dashboard.php');
  		});
  	</script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>