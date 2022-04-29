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
		<th>RFID</th>
		<th>Nama</th>
		<th>NIDN</th>
		<th>Tanggal</th>
		<th>Status</th>
		<th>Jam Masuk</th>
		<th>Jam Istirahat</th>
		<th>Jam Kembali</th>
		<th>Jam Pulang</th>
	</tr>
	<?php
		date_default_timezone_set('Asia/Jakarta');
		$time = date('H:i:s');
		$date = date('Y-m-d');

		$bulan = "";
		$tahun = "";
		$search = "";

		if(isset($_POST['bulan'])){
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];

			if( $bulan == '0' && $tahun == '0'){
				$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid ORDER BY tanggal DESC");
				if( mysqli_num_rows($query) > 0 ){
					while($result = mysqli_fetch_assoc($query)){
						?>
							<tr>
								<td><?= $result['rfid'] ?></td>
								<td><?= $result['nama'] ?></td>
								<td><?= $result['nidn'] ?></td>
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
			} elseif( $bulan == '0' && $tahun != '0' ){
				$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE YEAR(tanggal) = '".$tahun."' ORDER BY tanggal DESC");		
				if( mysqli_num_rows($query) > 0 ){
					while($result = mysqli_fetch_assoc($query)){
						?>
							<tr>
								<td><?= $result['rfid'] ?></td>
								<td><?= $result['nama'] ?></td>
								<td><?= $result['nidn'] ?></td>
								<td><?= $result['tanggal'] ?></td>
								<td><?= $result['status_kehadiran'] ?></td>
								<td><?= $result['jam_masuk'] ?></td>
								<td><?= $result['jam_istirahat'] ?></td>
								<td><?= $result['jam_kembali'] ?></td>
								<td><?= $result['jam_pulang'] ?></td>
							</tr>
						<?php
					}
				}else{
					?>
						<tr class="text-center">
							<td colspan="9"><i>No Data</i></td>
						</tr>
					<?php
				}		
			} elseif( $bulan != '0' && $tahun == '0' ){
				$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE MONTH(tanggal) = '".$bulan."' ORDER BY tanggal DESC");
				if( mysqli_num_rows($query) > 0 ){
					while($result = mysqli_fetch_assoc($query)){
						?>
							<tr>
								<td><?= $result['rfid'] ?></td>
								<td><?= $result['nama'] ?></td>
								<td><?= $result['nidn'] ?></td>
								<td><?= $result['tanggal'] ?></td>
								<td><?= $result['status_kehadiran'] ?></td>
								<td><?= $result['jam_masuk'] ?></td>
								<td><?= $result['jam_istirahat'] ?></td>
								<td><?= $result['jam_kembali'] ?></td>
								<td><?= $result['jam_pulang'] ?></td>
							</tr>
						<?php
					}
				} else{
					?>
						<tr class="text-center">
							<td colspan="9"><i>No Data</i></td>
						</tr>
					<?php
				}
			} elseif( $bulan != '0' && $tahun != '0' ){
				$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE MONTH(tanggal) = '".$bulan."' AND YEAR(tanggal) = '".$tahun."' ORDER BY tanggal DESC");
				if( mysqli_num_rows($query) > 0 ){
					while($result = mysqli_fetch_assoc($query)){
						?>
							<tr>
								<td><?= $result['rfid'] ?></td>
								<td><?= $result['nama'] ?></td>
								<td><?= $result['nidn'] ?></td>
								<td><?= $result['tanggal'] ?></td>
								<td><?= $result['status_kehadiran'] ?></td>
								<td><?= $result['jam_masuk'] ?></td>
								<td><?= $result['jam_istirahat'] ?></td>
								<td><?= $result['jam_kembali'] ?></td>
								<td><?= $result['jam_pulang'] ?></td>
							</tr>
						<?php
					}
				} else{
					?>
						<tr class="text-center">
							<td colspan="9"><i>No Data</i></td>
						</tr>
					<?php
				}
			}
		} elseif( isset($_POST['search']) ){ 
			$search = $_POST['search'];

			$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE kar.nama = '".$search."' ORDER BY tanggal DESC");
			$query1 = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE kar.nidn = '".$search."' ORDER BY tanggal DESC");
			$query2 = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE kar.rfid = '".$search."' ORDER BY tanggal DESC");

			if( mysqli_num_rows($query) > 0 ){
				while($result = mysqli_fetch_assoc($query)){
					?>
						<tr>
							<td><?= $result['rfid'] ?></td>
							<td><?= $result['nama'] ?></td>
							<td><?= $result['nidn'] ?></td>
							<td><?= $result['tanggal'] ?></td>
							<td><?= $result['status_kehadiran'] ?></td>
							<td><?= $result['jam_masuk'] ?></td>
							<td><?= $result['jam_istirahat'] ?></td>
							<td><?= $result['jam_kembali'] ?></td>
							<td><?= $result['jam_pulang'] ?></td>
						</tr>
					<?php
				}
			} elseif( mysqli_num_rows($query1) > 0 ){
				while($result1 = mysqli_fetch_assoc($query1)){
					?>
						<tr>
							<td><?= $result1['rfid'] ?></td>
							<td><?= $result1['nama'] ?></td>
							<td><?= $result1['nidn'] ?></td>
							<td><?= $result1['tanggal'] ?></td>
							<td><?= $result1['status_kehadiran'] ?></td>
							<td><?= $result1['jam_masuk'] ?></td>
							<td><?= $result1['jam_istirahat'] ?></td>
							<td><?= $result1['jam_kembali'] ?></td>
							<td><?= $result1['jam_pulang'] ?></td>
						</tr>
					<?php
				}
			} elseif( mysqli_num_rows($query2) > 0 ){
				while($result2 = mysqli_fetch_assoc($query2)){
					?>
						<tr>
							<td><?= $result2['rfid'] ?></td>
							<td><?= $result2['nama'] ?></td>
							<td><?= $result2['nidn'] ?></td>
							<td><?= $result2['tanggal'] ?></td>
							<td><?= $result2['status_kehadiran'] ?></td>
							<td><?= $result2['jam_masuk'] ?></td>
							<td><?= $result2['jam_istirahat'] ?></td>
							<td><?= $result2['jam_kembali'] ?></td>
							<td><?= $result2['jam_pulang'] ?></td>
						</tr>
					<?php
				}
			} else{
				?>
					<tr class="text-center">
						<td colspan="9"><i>No Data</i></td>
					</tr>
				<?php
			}
		} else{
			$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid ORDER BY tanggal DESC");
			while($result = mysqli_fetch_assoc($query)){
				if( mysqli_num_rows($query) > 0 ){
					?>
						<tr>
							<td><?= $result['rfid'] ?></td>
							<td><?= $result['nama'] ?></td>
							<td><?= $result['nidn'] ?></td>
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