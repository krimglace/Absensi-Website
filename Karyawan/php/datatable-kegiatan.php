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

	$query = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Masuk'");
	$query1 = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Istirahat'");
	$query2 = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Kembali'");
	$query3 = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Pulang'");
	
	$data = mysqli_fetch_assoc($query);
	$data1 = mysqli_fetch_assoc($query1);
	$data2 = mysqli_fetch_assoc($query2);
	$data3 = mysqli_fetch_assoc($query3);

	$queryres = mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
	$result = mysqli_fetch_assoc($queryres);
	
	if( mysqli_num_rows($queryres) > 0 ){
		if( (date($data['jam_mulai']) <= $time) && ($time <= date($data['jam_selesai'])) ){
			if( $result['jam_masuk'] == NULL || $result['jam_masuk'] == '00:00:00'){
				?>
					<div class="alert alert-warning">
						<input type="text" name="" value="SILAHKAN ABSENSI TERLEBIH DAHULU" class="form-control text-center" readonly style="height: 100px;">
					</div>
				<?php
			} else{
				$querykegiatan = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_absensi = '".$result['id_absensi']."' AND id_status = '1'");

				if( mysqli_num_rows($querykegiatan) > 0 ){
					$resultkegiatan = mysqli_fetch_assoc($querykegiatan);
					?>
						<div class="alert alert-success">
							<form method="post" action="php/update-kegiatan.php">
								<label><strong>Isi Kegiatan Harian</strong></label>
								<input type="hidden" name="id_kegiatan" value="<?= $resultkegiatan['id_kegiatan'] ?>">
								<textarea name="kegiatan" class="form-control" rows="5"><?= $resultkegiatan['kegiatan'] ?></textarea>
								<button type="submit" name="update" class="btn btn-primary" style="margin-top: 10px">Update</button>
							</form>
						</div>
					<?php
				} else {
					?>
						<form method="post" action="php/add-kegiatan.php">
							<label><strong>Isi Kegiatan Harian</strong></label>
							<input type="hidden" name="id_absensi" value="<?= $result['id_absensi'] ?>">
							<input type="hidden" name="id_status" value="1">
							<textarea name="kegiatan" class="form-control" rows="5"></textarea>
							<button type="submit" name="insert" class="btn btn-primary" style="margin-top: 10px">Add</button>
						</form>
					<?php
				}
			}
		} elseif( (date($data1['jam_mulai']) <= $time) && ($time <= date($data1['jam_selesai'])) ){
			if( $result['jam_istirahat'] == NULL || $result['jam_istirahat'] == '00:00:00'){
				?>
					<div class="alert alert-warning">
						<input type="text" name="" value="SILAHKAN ABSENSI TERLEBIH DAHULU" class="form-control text-center" readonly style="height: 100px;">
					</div>
				<?php
			} else{
				?>
					<div class="alert alert-info">
						<input type="text" name="" value="KEGIATAN TIDAK DAPAT DIISI SAAT JAM ISTIRAHAT" class="form-control text-center" readonly style="height: 100px;">
					</div>
				<?php
			}
		} elseif( (date($data2['jam_mulai']) <= $time) && ($time <= date($data2['jam_selesai'])) ){
			if( $result['jam_kembali'] == NULL || $result['jam_kembali'] == '00:00:00'){
				?>
					<div class="alert alert-warning">
						<input type="text" name="" value="SILAHKAN ABSENSI TERLEBIH DAHULU" class="form-control text-center" readonly style="height: 100px;">
					</div>
				<?php
			} else{
				$querykegiatan = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id_absensi = '".$result['id_absensi']."' AND id_status = '3'");

				if( mysqli_num_rows($querykegiatan) > 0 ){
					$resultkegiatan = mysqli_fetch_assoc($querykegiatan);
					?>
						<div class="alert alert-success">
							<form method="post" action="php/update-kegiatan.php">
								<label><strong>Isi Kegiatan Harian</strong></label>
								<input type="hidden" name="id_kegiatan" value="<?= $resultkegiatan['id_kegiatan'] ?>">
								<textarea name="kegiatan" class="form-control" rows="5"><?= $resultkegiatan['kegiatan'] ?></textarea>
								<button type="submit" name="update" class="btn btn-primary" style="margin-top: 10px">Update</button>
							</form>
						</div>
					<?php
				} else {
					?>
						<form method="post" action="php/add-kegiatan.php">
							<label><strong>Isi Kegiatan Harian</strong></label>
							<input type="hidden" name="id_absensi" value="<?= $result['id_absensi'] ?>">
							<input type="hidden" name="id_status" value="3">
							<textarea name="kegiatan" class="form-control" rows="5"></textarea>
							<button type="submit" name="insert" class="btn btn-primary" style="margin-top: 10px">Add</button>
						</form>
					<?php
				}
			}
		} elseif( ((date($data3['jam_mulai']) <= $time) && ('24:00:00' >= $time) ) ||
			(($time <= date($data3['jam_selesai'])) && ( '00:00:00' <= $time)) ){
			if( $result['jam_pulang'] == NULL || $result['jam_pulang'] == '00:00:00'){
				?>
					<div class="alert alert-warning">
						<input type="text" name="" value="SILAHKAN ABSENSI TERLEBIH DAHULU" class="form-control text-center" readonly style="height: 100px;">
					</div>
				<?php
			} else{
				?>
					<div class="alert alert-info">
						<input type="text" name="" value="KEGIATAN TIDAK DAPAT DIISI SAAT JAM PULANG" class="form-control text-center" readonly style="height: 100px;">
					</div>
				<?php
			}
		}
	} else{
		?>
		<div class="alert alert-warning">
			<input type="text" name="" value="SILAHKAN ABSENSI TERLEBIH DAHULU" class="form-control text-center" readonly style="height: 100px;">
		</div>
		<?php
	}	
?>
