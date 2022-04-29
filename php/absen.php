<?php

	include '../koneksi/config.php';

	// $query = mysqli_query($conn, "SELECT * FROM user");
	// $result = mysqli_fetch_assoc($query);
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

if(isset($_POST['absen'])){
	$rfid = $_POST['rfid'];
	if( $rfid == '' ){
		echo "<script>
			alert('Tap Kartu Anda Terlebih Dahulu');
			window.location.href = '../';
		</script>";
	} else{
		$querycount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE rfid = '".$rfid."'"));
		if( $querycount > 0 ){
			$queryres = mysqli_query($conn, "SELECT * FROM user WHERE rfid = '".$rfid."'");
			$result = mysqli_fetch_assoc($queryres);
			$querycountabsen = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND tanggal = '".$date."'"));
			if( $querycountabsen > 0 ){
				$queryresabsen = mysqli_query($conn, "SELECT * FROM absensi WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
				$resultresabsen = mysqli_fetch_assoc($queryresabsen);
				if( (date($data['jam_mulai']) <= $time) && ($time <= date($data['jam_selesai'])) ){
					if( $resultresabsen['jam_masuk'] == NULL || $resultresabsen['jam_masuk'] == '00:00:00'){
						mysqli_query($conn, "UPDATE absensi SET jam_masuk = '".$time."' WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
						echo "<script>
							alert('Anda Absen Pada Jam Masuk');
							window.location.href = '../';
						</script>";
					} else{
						echo "<script>
							alert('Anda Sudah Absen Pada Jam Masuk Sebelumnya');
							window.location.href = '../';
						</script>";
					}
				}elseif( (date($data1['jam_mulai']) <= $time) && ($time <= date($data1['jam_selesai'])) ){
					if( $resultresabsen['jam_istirahat'] == NULL || $resultresabsen['jam_istirahat'] == '00:00:00'){
						mysqli_query($conn, "UPDATE absensi SET jam_istirahat = '".$time."' WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
						echo "<script>
							alert('Anda Absen Pada Jam Istirahat');
							window.location.href = '../';
						</script>";
					} else{
						echo "<script>
							alert('Anda Sudah Absen Pada Jam Istirahat Sebelumnya');
							window.location.href = '../';
						</script>";
					}
				}elseif( (date($data2['jam_mulai']) <= $time) && ($time <= date($data2['jam_selesai'])) ){
					if( $resultresabsen['jam_kembali'] == NULL || $resultresabsen['jam_kembali'] == '00:00:00'){
						mysqli_query($conn, "UPDATE absensi SET jam_kembali = '".$time."' WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
						echo "<script>
							alert('Anda Absen Pada Jam Kembali');
							window.location.href = '../';
						</script>";
					} else{
						echo "<script>
							alert('Anda Sudah Absen Pada Jam Kembali Sebelumnya');
							window.location.href = '../';
						</script>";
					}
				}elseif( (date($data3['jam_mulai']) <= $time) || ($time <= date($data3['jam_selesai']) ) ){
					if( $resultresabsen['jam_pulang'] == NULL || $resultresabsen['jam_pulang'] == '00:00:00'){
						mysqli_query($conn, "UPDATE absensi SET jam_pulang = '".$time."' WHERE rfid = '".$rfid."' AND tanggal = '".$date."'");
						echo "<script>
							alert('Anda Absen Pada Jam Pulang');
							window.location.href = '../';
						</script>";
					} else{
						echo "<script>
							alert('Anda Sudah Absen Pada Jam Pulang Sebelumnya');
							window.location.href = '../';
						</script>";
					}
				}
			} else{
				if( (date($data['jam_mulai']) <= $time) && ($time <= date($data['jam_selesai'])) ){
					mysqli_query($conn, "INSERT INTO absensi(rfid, status_kehadiran, tanggal, jam_masuk) VALUES ('".$rfid."', 'Hadir', '".$date."', '".$time."')");
					echo "<script>
						alert('Anda Absen Pada Jam Masuk');
						window.location.href = '../';
					</script>";
				} elseif( (date($data1['jam_mulai']) <= $time) && ($time <= date($data1['jam_selesai'])) ){
					mysqli_query($conn, "INSERT INTO absensi(rfid, status_kehadiran, tanggal, jam_istirahat) VALUES ('".$rfid."', 'Hadir', '".$date."', '".$time."')");
					echo "<script>
						alert('Anda Absen Pada Jam Istirahat');
						window.location.href = '../';
					</script>";
				}elseif( (date($data2['jam_mulai']) <= $time) && ($time <= date($data2['jam_selesai'])) ){
					mysqli_query($conn, "INSERT INTO absensi(rfid, status_kehadiran, tanggal, jam_kembali) VALUES ('".$rfid."', 'Hadir', '".$date."', '".$time."')");
					echo "<script>
						alert('Anda Absen Pada Jam Kembali');
						window.location.href = '../';
					</script>";
				}elseif( (date($data3['jam_mulai']) <= $time) || ($time <= date($data3['jam_selesai']) ) ){
					mysqli_query($conn, "INSERT INTO absensi(rfid, status_kehadiran, tanggal, jam_pulang) VALUES ('".$rfid."', 'Hadir', '".$date."', '".$time."')");
					echo "<script>
						alert('Anda Absen Pada Jam Pulang');
						window.location.href = '../';
					</script>";
				}
			}
		} else{
			echo "<script>
				alert('RFID Anda Tidak Ditemukan');
				window.location.href = '../';
			</script>";
		}
	}
}

?>