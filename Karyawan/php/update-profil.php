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

	$rfid = $_SESSION['rfid'];
	$query = mysqli_query($conn, "SELECT * FROM user as us JOIN karyawan as ad ON us.rfid = ad.rfid WHERE us.rfid = '$rfid'");
	$result = mysqli_fetch_assoc($query);

	if(isset($_POST['update'])){
		$name = $_POST['nama'];
		$username = $_POST['username'];
		$jk = $_POST['jenis_kelamin'];
		$tl = $_POST['tgl_lahir'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$cekusernamekar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE username = '".$username."'"));
		// echo $username;
		// echo $result['username'];
		// if( $username= $result['username'] )
		if( $username == $result['username'] ){
			if( $password == $result['password'] ){
				mysqli_query($conn, "UPDATE karyawan SET  nama = '".$name."', jenis_kelamin = '".$jk."', tgl_lahir = '".$tl."', alamat = '".$alamat."', email = '".$email."' ");
				echo "<script>
					alert('Data Profil Telah Diupdate');
					window.location.href = '../../Karyawan?rfid=".$rfid."';
				</script>";
			} elseif( md5($password) == $result['password'] ){
				mysqli_query($conn, "UPDATE karyawan SET  nama = '".$name."', jenis_kelamin = '".$jk."', tgl_lahir = '".$tl."', alamat = '".$alamat."', email = '".$email."' ");
				echo "<script>
					alert('Tidak Dapat Mengupdate Password');
					alert('Data Profil Telah Diupdate');
					window.location.href = '../../Karyawan?rfid=".$rfid."';
				</script>";
			} else {
				mysqli_query($conn, "UPDATE user SET password = '".md5($password)."' WHERE rfid = '".$rfid."'");
				mysqli_query($conn, "UPDATE karyawan SET  nama = '".$name."', jenis_kelamin = '".$jk."', tgl_lahir = '".$tl."', alamat = '".$alamat."', email = '".$email."' ");
				echo "<script>
					alert('Password Anda Berhasil Diupdate');
					alert('Data Profil Telah Diupdate');
					window.location.href = '../../Karyawan?rfid=".$rfid."';
				</script>";
			}
		} elseif( $cekusernamekar > 0 ){
			echo "<script>
				alert('Username Tidak Dapat Digunakan');
				window.location.href = '../../Karyawan?rfid=".$rfid."';
			</script>";
		} else{
			if( $password == $result['password'] ){
				mysqli_query($conn, "UPDATE user SET username = '".$username."' WHERE rfid = '".$rfid."'");
				mysqli_query($conn, "UPDATE karyawan SET  nama = '".$name."', jenis_kelamin = '".$jk."', tgl_lahir = '".$tl."', alamat = '".$alamat."', email = '".$email."' ");
				echo "<script>
					alert('Data Profil Telah Diupdate');
					window.location.href = '../../Karyawan?rfid=".$rfid."';
				</script>";
			} elseif( md5($password) == $result['password'] ){
				mysqli_query($conn, "UPDATE user SET username = '".$username."' WHERE rfid = '".$rfid."'");
				mysqli_query($conn, "UPDATE karyawan SET  nama = '".$name."', jenis_kelamin = '".$jk."', tgl_lahir = '".$tl."', alamat = '".$alamat."', email = '".$email."' ");
				echo "<script>
					alert('Tidak Dapat Mengupdate Password');
					alert('Data Profil Telah Diupdate');
					window.location.href = '../../Karyawan?rfid=".$rfid."';
				</script>";
			} else {
				mysqli_query($conn, "UPDATE user SET username = '".$username."', password = '".md5($password)."' WHERE rfid = '".$rfid."'");
				mysqli_query($conn, "UPDATE karyawan SET  nama = '".$name."', jenis_kelamin = '".$jk."', tgl_lahir = '".$tl."', alamat = '".$alamat."', email = '".$email."' ");
				echo "<script>
					alert('Password Anda Berhasil Diupdate');
					alert('Data Profil Telah Diupdate');
					window.location.href = '../../Karyawan?rfid=".$rfid."';
				</script>";
			}
		}
	}


?>