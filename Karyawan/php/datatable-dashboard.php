<?php

	require '../../koneksi/config.php';
	session_start();
	if( !isset($_SESSION['rfid']) ) 
	echo "<script>
        alert('Anda Harus Login Terlebih Dahulu');
        window.location = '../../'
      </script>
      ";
      $rfid = $_SESSION['rfid'];

?>
<table class="table table-hover table-striped table-border">
	<tr>
		<th>Tanggal</th>
		<th>Status</th>
		<th>Jam Masuk</th>
		<th>Jam Istirahat</th>
		<th>Jam Kembali</th>
		<th>Jam Pulang</th>
	</tr>
	<?php
		$bulan = "";
		$tahun = "";
		if(isset($_POST['bulan'])){
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
		}
		if( $bulan == '0' && $tahun == '0'){

		} elseif( $bulan == '0' && $tahun != '0' ) {
			$query = mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND YEAR(tanggal) = '".$tahun."'");
			while($result = mysqli_fetch_assoc($query)){
				if( mysqli_num_rows($query) > 0 ){
					?>
						<tr>
							<td><?= $result['tanggal'] ?></td>
							<td><?= $result['status_kehadiran'] ?></td>
							<td><?= $result['jam_masuk'] ?></td>
							<td><?= $result['jam_istirahat'] ?></td>
							<td><?= $result['jam_kembali'] ?></td>
							<td><?= $result['jam_pulang'] ?></td>
						</tr>
					<?php
				}
			}
		} elseif( $bulan != '0' && $tahun == '0' ){
			$query = mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND MONTH(tanggal) = '".$bulan."'");
			while($result = mysqli_fetch_assoc($query)){
				if( mysqli_num_rows($query) > 0 ){
					?>
						<tr>
							<td><?= $result['tanggal'] ?></td>
							<td><?= $result['status_kehadiran'] ?></td>
							<td><?= $result['jam_masuk'] ?></td>
							<td><?= $result['jam_istirahat'] ?></td>
							<td><?= $result['jam_kembali'] ?></td>
							<td><?= $result['jam_pulang'] ?></td>
						</tr>
					<?php
				}
			}
		} elseif( $bulan != '0' && $tahun != '0' ){
			$query = mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND MONTH(tanggal) = '".$bulan."' AND YEAR(tanggal) = '".$tahun."'");
			while($result = mysqli_fetch_assoc($query)){
				if( mysqli_num_rows($query) > 0 ){
					?>
						<tr>
							<td><?= $result['tanggal'] ?></td>
							<td><?= $result['status_kehadiran'] ?></td>
							<td><?= $result['jam_masuk'] ?></td>
							<td><?= $result['jam_istirahat'] ?></td>
							<td><?= $result['jam_kembali'] ?></td>
							<td><?= $result['jam_pulang'] ?></td>
						</tr>
					<?php
				}
			}
		}
		
	?>

</table>
