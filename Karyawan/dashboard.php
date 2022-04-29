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
	$arraybulan = array('January', 'February', 'March', 'April', 'May', 'Juny', 'July', 'August', 'September', 'October', 'November', 'December');
	$arraytahun = array('2021', '2022', '2023', '2024');
?>
<div class="m-5">
	<div class="section-header">
		<h2 class="m-0 text-dark"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
	</div>
	<br>
	<div class="section-main">
		<div class="search" style="margin-right: 10px">
			<div class="clearfix"></div>
			<div class="float-start col-md-3" style="margin-right: 10px;">
				<select class="form-control" name="bulan" id="bulan">
					<option value="0">~~ Filter (Bulan) ~~<br><hr></option>
					<?php for( $x = 0; $x<count($arraybulan); $x++) : ?>
						<option value="<?= $x+1 ?>"><?= $arraybulan[$x] ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="float-start col-md-3" style="margin-right: 10px">
				<select class="form-control" name="tahun" id="tahun">
					<option value="0">~~ Filter (Tahun) ~~<br><hr></option>
					<?php for( $a = 0; $a<count($arraytahun); $a++) : ?>
						<option value="<?= $arraytahun[$a] ?>"><?= $arraytahun[$a] ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="float-start col-md-3">
				<button id="search" name="search" class="btn btn-primary">
					<i class="fas fa-list"></i> Filter
				</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<br>
		<div class="data-table">
				
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data-table').load('php/datatable-dashboard.php');
		$('#search').click(function(){
			var bulan = $('#bulan').val();
			var tahun = $('#tahun').val();
			// console.log(bulan);
			$.ajax({
				type: 'POST',
	            url: "php/datatable-dashboard.php",
	            data: {bulan: bulan, tahun:tahun},
	            success: function(hasil) {
	                $('.data-table').html(hasil);
	            }
			});
		});
	});
</script>