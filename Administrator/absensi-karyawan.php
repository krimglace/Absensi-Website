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
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="section-header m-3">
			<div class="page-header alert alert-primary text-dark p-2 m-2">
				<h5>
					<b>
						<i class="fas fa-address-card" style="margin-left: 25px"></i>
						Absensi Karyawan
					</b>
				</h5>
			</div>
			<br>
		</div>
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
				<div class="float-start col-md-1">
					<button id="search" name="search" class="btn btn-primary">
						<i class="fas fa-list"></i> Filter
					</button>
				</div>
				<div class="float-end col-md-1">
					<button id="searchengine" name="searchengine" class="btn btn-primary">
						<i class="fas fa-search"></i> Cari
					</button>
				</div>
				<div class="float-end col-md-3" style="margin-right: 10px">
					<input type="text" id="searchcol" name="searchcol" class="form-control" placeholder="Cari Berdasarkan Nama/NIDN/RFID">
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<br>
			<div class="data-table">
				
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data-table').load('php/datatable-absensi.php');
		$('#search').click(function(){
			var bulan = $('#bulan').val();
			var tahun = $('#tahun').val();
			// console.log(bulan);
			$.ajax({
				type: 'POST',
	            url: "php/datatable-absensi.php",
	            data: {bulan: bulan, tahun:tahun},
	            success: function(hasil) {
	                $('.data-table').html(hasil);
	            }
			});
		});
		$('#searchengine').click(function(){
			var search = $('#searchcol').val();
			// console.log(bulan);
			$.ajax({
				type: 'POST',
	            url: "php/datatable-absensi.php",
	            data: {search : search},
	            success: function(hasil) {
	                $('.data-table').html(hasil);
	            }
			});
		});
	});
</script>
