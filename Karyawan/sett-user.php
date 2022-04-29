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
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="section-header m-3">
			<div class="page-header alert alert-primary text-dark p-2 m-2">
				<h5>
					<b>
						<i class="fas fa-user-cog" style="margin-left: 25px"></i>
						<?= $result['nama'] ?>
					</b>
				</h5>
			</div>
			<br>
		</div>
		<div class="section-main m-2">
			<div class="data-kegiatan">
				
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data-kegiatan').load('php/datatable-profil.php');
	});
</script>