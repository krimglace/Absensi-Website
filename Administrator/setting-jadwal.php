<?php

	require '../koneksi/config.php';
	session_start();
	if( !isset($_SESSION['rfid']) ) 
	echo "<script>
        alert('Anda Harus Login Terlebih Dahulu');
        window.location = '../../'
      </script>
      ";
      $rfid = $_SESSION['rfid'];

?>
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="section-header m-3">
			<div class="page-header alert alert-primary text-dark p-2 m-2">
				<h5>
					<b>
						<i class="fas fa-address-card" style="margin-left: 25px"></i>
						Atur Jadwal Kerja Karyawan
					</b>
				</h5>
			</div>
			<br>
		</div>
		<div class="section-main">
			<div class="data-table">
				
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data-table').load('php/datatable-jadwal.php');
	});
</script>
