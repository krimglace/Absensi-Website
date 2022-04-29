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
		<th>Hadir</th>
		<th>Izin</th>
		<th>Sakit</th>
		<th>Tanpa Keterangan</th>
	</tr>
	<?php
		$bulan = "";
		$tahun = "";
		if(isset($_POST['bulan'])){
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];

			if( $bulan == '0' && $tahun == '0'){
			?>
				<tr>
					<td class="text-center" colspan="8"><i>No Data</i></td>
				</tr>
			<?php
			} elseif( $bulan == '0' && $tahun != '0' ) {
			?>
				<tr>
					<td class="text-center" colspan="8"><i>Pilih Bulan Terlebih Dahulu</i></td>
				</tr>
			<?php	
			} elseif( $bulan != '0' && $tahun == '0' ) {
			?>
				<tr>
					<td class="text-center" colspan="8"><i>Pilih Tahun Terlebih Dahulu</i></td>
				</tr>
			<?php	
			} elseif( $bulan != '0' && $tahun != '0' ) {
				$query = mysqli_query($conn, "SELECT * FROM karyawan");
				while($result = mysqli_fetch_assoc($query)){
				?>
					<tr>
						<td><?= $result['rfid'] ?></td>
						<td><?= $result['nama'] ?></td>
						<td><?= $result['nidn'] ?></td>
						<?php
							$queryhadir = mysqli_query($conn, "SELECT * FROM karyawan as kar JOIN absensi as ab ON kar.rfid = ab.rfid WHERE kar.rfid = '".$result['rfid']."' AND ab.status_kehadiran = 'Hadir' AND MONTH(ab.tanggal) = '".$bulan."' AND YEAR(tanggal) = '".$tahun."'");
							$querysakit = mysqli_query($conn, "SELECT * FROM karyawan as kar JOIN absensi as ab ON kar.rfid = ab.rfid WHERE kar.rfid = '".$result['rfid']."' AND ab.status_kehadiran = 'Sakit' AND MONTH(ab.tanggal) = '".$bulan."' AND YEAR(tanggal) = '".$tahun."'");
							$queryizin = mysqli_query($conn, "SELECT * FROM karyawan as kar JOIN absensi as ab ON kar.rfid = ab.rfid WHERE kar.rfid = '".$result['rfid']."' AND ab.status_kehadiran = 'Izin' AND MONTH(ab.tanggal) = '".$bulan."' AND YEAR(tanggal) = '".$tahun."'");
							$hari = cal_days_in_month(CAL_GREGORIAN, date($bulan), date($tahun));

							$hadir = mysqli_num_rows($queryhadir);
							$sakit = mysqli_num_rows($querysakit);
							$izin = mysqli_num_rows($queryizin);
							$tanpa_keterangan = $hari - ($hadir+$sakit+$izin);
						?>
						<td><?= $hadir ?></td>
						<td><?= $sakit ?></td>
						<td><?= $izin ?></td>
						<td><?= $tanpa_keterangan ?></td>
					</tr>
				<?php	
				}
			} 
		}		
	?>
</table>