<?php
	
	session_start();
	unset($_SESSION['rfid']);
	session_destroy();
	echo "<script>
		alert('Data Anda Berhasil di Logout');
		window.location.href = '../../';
	</script>";

?>