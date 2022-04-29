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

	$query = mysqli_query($conn, "SELECT * FROM user as us JOIN administrator as ad ON us.rfid = ad.rfid WHERE us.rfid NOT IN(".$rfid.")");
	$resulting = mysqli_fetch_assoc($query);

?>