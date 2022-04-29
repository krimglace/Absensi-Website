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
<table class="table table-hover table-striped table-border text-center">
	<tr>
		<th colspan="2">Identitas</th>
		<th colspan="4">Kegiatan</th>
	</tr>
	<tr>
		<th>RFID</th>
		<th>Nama</th>
		<th>Jam Masuk</th>
		<th>Jam Istirahat</th>
		<th>Jam Kembali</th>
		<th>Jam Pulang</th>
	</tr>

	<?php
		$tanggal = "";
		if(isset($_POST['tanggal'])){
			$tanggal = $_POST['tanggal'];
			// echo $tanggal;

			if( $tanggal == '' || $tanggal == '0000-00-00' ){
				?>
				<tr>
					<td colspan="6"><i>No Data</i></td>
				</tr>
				<?php
			} else{
				$query = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN karyawan as kar ON ab.rfid = kar.rfid WHERE ab.tanggal = '".$tanggal."'");
				if(mysqli_num_rows($query) > 0){
					while($result = mysqli_fetch_assoc($query)){
						?>
						<tr>
							<td><?= $result['rfid'] ?></td>
							<td><?= $result['nama'] ?></td>
							<?php
								$query1 = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN kegiatan as keg ON ab.id_absensi = keg.id_absensi WHERE keg.id_absensi = '".$result['id_absensi']."' AND keg.id_status = '1'");
								$query2 = mysqli_query($conn, "SELECT * FROM absensi as ab JOIN kegiatan as keg ON ab.id_absensi = keg.id_absensi WHERE keg.id_absensi = '".$result['id_absensi']."' AND keg.id_status = '3'");

								$result1 = mysqli_fetch_assoc($query1);
								$result2 = mysqli_fetch_assoc($query2);

								if(mysqli_num_rows($query1) > 0 && mysqli_num_rows($query2) > 0){
									?>
										<td><?= $query1['kegiatan'] ?></td>
										<td><i>Istirahat</i></td>
										<td><?= $query2['kegiatan'] ?></td>
										<td><i>Pulang</i></td>
									<?php
								} else if(mysqli_num_rows($query1) == 0 && mysqli_num_rows($query2) > 0){
									?>
										<td class="text-danger"><i>No Data</i></td>
										<td><i>Istirahat</i></td>
										<td><?= $result2	['kegiatan'] ?></td>
										<td><i>Pulang</i></td>
										
									<?php
								} else if(mysqli_num_rows($query1) > 0 && mysqli_num_rows($query2) == 0){
									?>
										<td><?= $result1['kegiatan'] ?></td>
										<td><i>Istirahat</i></td>
										<td class="text-danger"><i>No Data</i></td>
										<td><i>Pulang</i></td>
										
									<?php
								} else if(mysqli_num_rows($query1) == 0 && mysqli_num_rows($query2) == 0){
									?>
										<td class="text-danger"><i>No Data</i></td>
										<td><i>Istirahat</i></td>
										<td class="text-danger"><i>No Data</i></td>
										<td><i>Pulang</i></td>
										
									<?php
								} else{
									?>
										<tr>
											<th colspan="6"><i>No Data</i></th>
										</tr>
									<?php
								}
							?>
						</tr>
						<?php
					}
				} else{
					?>
						<tr>
							<td colspan="6"><i>No Data</i></td>
						</tr>
					<?php
				}
			}
		}
	?>