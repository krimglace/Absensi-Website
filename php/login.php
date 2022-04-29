<?php

	include '../koneksi/config.php';
	session_start();
	if(isset($_POST['login'])){
		$username = $_POST['Username'];
		$password = md5($_POST['Password']);

		$sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
		$result = mysqli_query($conn, $sql);
		if($result->num_rows > 0){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['rfid'] = $row['rfid'];
			if( $row['jabatan'] == 'Administrator' ){
				echo "<script>
					alert('Anda Login Sebagai Administrator');
					window.location.href = '../Administrator?rfid=".$row['rfid']."';
				</script>";
			} else{
				echo "<script>
					alert('Anda Login Sebagai Karyawan');
					window.location.href = '../Karyawan?rfid=".$row['rfid']."';
				</script>";
			}
		} else{
			echo '<script>
				alert("Data Login Anda Tidak Terdaftar");
				window.location.href = "../";
			</script>';
		}
	}

?>