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

	if(isset($_POST['insert'])){
		$id_absensi = $_POST['id_absensi'];
		$id_status = $_POST['id_status'];
		$kegiatan = $_POST['kegiatan'];
		
		mysqli_query($conn, "INSERT INTO kegiatan(id_absensi, id_status, kegiatan) values('".$id_absensi."', '".$id_status."', '".$kegiatan."')");

		echo "<script>
				alert('Data Kegiatan Telah Ditambahkan');
				window.location.href = '../../Karyawan?rfid=".$rfid."';
			</script>";
	}

?>