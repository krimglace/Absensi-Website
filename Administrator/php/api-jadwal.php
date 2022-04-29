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

	if(isset($_POST['search'])){
		$id_status = $_POST['id_status'];
		$jam_mulai = $_POST['jam_mulai'];
		$jam_selesai = $_POST['jam_selesai'];
		
		$query = mysqli_query($conn, "UPDATE status_absen SET jam_mulai = '".$jam_mulai."', jam_selesai = '".$jam_selesai."' WHERE id_status = '".$id_status."'");
		echo "<script>
				alert('Jadwal Telah Diupdate');
				window.location.href = '../../Administrator?rfid=".$rfid."';
			</script>";
	}
?>