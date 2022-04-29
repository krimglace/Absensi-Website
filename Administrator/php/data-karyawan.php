<?php

	session_start();
	if( !isset($_SESSION['rfid']) ) 
	echo "<script>
        alert('Anda Harus Login Terlebih Dahulu');
        window.location = '../../'
      </script>
      ";

	//manggil koneksi
	require '../koneksi/config.php';

	$rfid = $_SESSION['rfid'];

	$query = mysqli_query($conn, "SELECT * FROM user as us JOIN Karyawan as ad ON us.rfid = ad.rfid WHERE us.jabatan NOT IN('Administrator')");

?>