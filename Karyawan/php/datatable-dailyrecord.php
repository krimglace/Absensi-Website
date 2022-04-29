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

    date_default_timezone_set('Asia/Jakarta');
	$time = date('H:i:s');
	$date = date('Y-m-d');

	$queryres = mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
	$result = mysqli_fetch_assoc($queryres);

	if( mysqli_num_rows($queryres) > 0 ){
			?>
			<table class="table table-striped table-bordered">
				<tr>
					<th><strong>RFID</strong></th>
					<td colspan="3"><?= $result['rfid'] ?></td>
				</tr>
				<tr>
					<th><strong>Jam Masuk</strong></th>
					<td><?= $result['jam_masuk'] ?></td>
					<th><strong>Kegiatan</strong></th>
					<?php
						$jammasuk = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_absensi = '".$result['id_absensi']."' AND id_status = '1'");
						while($resultmasuk = mysqli_fetch_assoc($jammasuk)){
					?>
					<td><?= $resultmasuk['kegiatan'] ?></td>
					<?php } ?>
				</tr>
				<tr>
					<th><strong>Jam Istirahat</strong></th>
					<td colspan="3"><?= $result['jam_istirahat'] ?></td>
				</tr>
				<tr>
					<th><strong>Jam Kembali</strong></th>
					<td><?= $result['jam_kembali'] ?></td>
					<th><strong>Kegiatan</strong></th>
					<?php
						$jamkembali = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_absensi = '".$result['id_absensi']."' AND id_status = '3'");
						while($resultkembali = mysqli_fetch_assoc($jamkembali)){
					?>
					<td><?= $resultkembali['kegiatan'] ?></td>
					<?php } ?>
				</tr>
				<tr>
					<th><strong>Jam Pulang</strong></th>
					<td colspan="3"><?= $result['jam_pulang'] ?></td>
				</tr>
			</table>
			
		<?php
	} else{
		?>
		<div class="alert alert-warning">
			<input type="text" name="" value="SILAHKAN ABSENSI TERLEBIH DAHULU" class="form-control text-center" readonly style="height: 100px;">
		</div>
		<?php
	}

?>