<?php

	session_start();
	if( !isset($_SESSION['rfid']) ) 
	echo "<script>
        alert('Anda Harus Login Terlebih Dahulu');
        window.location = '../../'
      </script>
      ";

	//manggil koneksi
	require '../../koneksi/config.php';

	$rfidadmin = $_SESSION['rfid'];
	$query = mysqli_query($conn, "SELECT max(rfid) as kodename FROM user");
	$resulting = mysqli_fetch_array($query);

		// echo ($resulting['kodename']+1);
	

	if(isset($_POST['submit'])){
		$nidn = $_POST['nidn'];
		$name = $_POST['nama'];
		$jk = $_POST['jenis_kelamin'];
		$tl = $_POST['tgl_lahir'];
		$alamat = $_POST['alamat'];
		$jabatan = $_POST['jabatan'];
		$email = $_POST['email'];
		$rfid = $resulting['kodename']+1;
		$password = '123456';

		$ceknidnadm = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user as us JOIN administrator as ad ON us.rfid = ad.rfid WHERE ad.nidn = '".$nidn."'"));
		$ceknidnkar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user as us JOIN karyawan as kar ON us.rfid = kar.rfid WHERE kar.nidn = '".$nidn."'"));
		$cekemailadm = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user as us JOIN administrator as ad ON us.rfid = ad.rfid WHERE ad.email = '".$email."'"));
		$cekemailkar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user as us JOIN karyawan as kar ON us.rfid = kar.rfid WHERE kar.email = '".$email."'"));

		if( $ceknidnkar > 0 || $ceknidnadm > 0){
			echo "<script>
				alert('NIDN Sudah Digunakan');
				window.location.href = '../../Administrator?rfid=".$rfidadmin."';
			</script>";
		} elseif( $cekemailadm > 0 || $cekemailkar > 0){
			echo "<script>
				alert('Email Sudah Digunakan');
				window.location.href = '../../Administrator?rfid=".$rfidadmin."';
			</script>";
		} else{
			if( $jabatan == 'Administrator' ){
				mysqli_query($conn, "INSERT INTO administrator(rfid, nidn, nama, jenis_kelamin, tgl_lahir, alamat, status_jabatan, email) values('".$rfid."', '".$nidn."', '".$name."', '".$jk."', '".$tl."', '".$alamat."', '".$jabatan."', '".$email."')");
				mysqli_query($conn, "INSERT INTO user(rfid, username, password, jabatan) values('".$rfid."', '".$nidn."','".md5($password)."', '".$jabatan."')");

				echo "<script>
						alert('Data ".$jabatan." Telah Ditambahkan (Username = ".$nidn.", Password = ".$password.")');
						window.location.href = '../../Administrator?rfid=".$rfidadmin."';
					</script>";

			} else {
				mysqli_query($conn, "INSERT INTO karyawan(rfid, nidn, nama, jenis_kelamin, tgl_lahir, alamat, status_jabatan, email) values('".$rfid."', '".$nidn."', '".$name."', '".$jk."', '".$tl."', '".$alamat."', '".$jabatan."', '".$email."')");
				
				mysqli_query($conn, "INSERT INTO user(rfid, username, password, jabatan) values('".$rfid."', '".$nidn."','".md5($password)."', '".$jabatan."')");
				echo "<script>
						alert('Data ".$jabatan." Telah Ditambahkan (Username = ".$nidn.", Password = ".$password.")');
						window.location.href = '../../Administrator?rfid=".$rfidadmin."';
					</script>";
				
			}
		}
	}

?>