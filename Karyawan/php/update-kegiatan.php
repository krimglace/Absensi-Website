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
    
	if(isset($_POST['update'])){
		$id_kegiatan = $_POST['id_kegiatan'];
		$kegiatan = $_POST['kegiatan'];
		
		mysqli_query($conn, "UPDATE kegiatan SET kegiatan = '".$kegiatan."' WHERE id_kegiatan = '".$id_kegiatan."'");

		echo "<script>
				alert('Data Kegiatan Telah Diupdate');
				window.location.href = '../../Karyawan?rfid=".$rfid."';
			</script>";
	}

?>