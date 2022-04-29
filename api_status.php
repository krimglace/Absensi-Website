<?php

	include 'koneksi/config.php';
    date_default_timezone_set('Asia/Jakarta');

	$waktu = date('H:i:s');
	$query = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Masuk'");
	$query1 = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Istirahat'");
	$query2 = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Kembali'");
	$query3 = mysqli_query($conn, "SELECT * FROM status_absen WHERE status = 'Jam Pulang'");

	$data = mysqli_fetch_assoc($query);
	$data1 = mysqli_fetch_assoc($query1);
	$data2 = mysqli_fetch_assoc($query2);
	$data3 = mysqli_fetch_assoc($query3);

	// echo date($data['jam_mulai']);	
	// echo $data['jam_selesai'];
	// echo $waktu;
	if( (date($data['jam_mulai']) <= $waktu) && ($waktu <= date($data['jam_selesai'])) ){echo $data['status']; }
	elseif( (date($data1['jam_mulai']) <= $waktu) && ($waktu <= date($data1['jam_selesai'])) ){ echo $data1['status'];}
	elseif( (date($data2['jam_mulai']) <= $waktu) && ($waktu <= date($data2['jam_selesai'])) ){ echo $data2['status']; }
	elseif( ((date($data3['jam_mulai']) <= $waktu) && ('24:00:00' >= $waktu) ) ||
		(($waktu <= date($data3['jam_selesai'])) && ( '00:00:00' <= $waktu)) ){
		echo $data3['status'];}
	else{ echo 'hai'; }	

?>