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

	$query = mysqli_query($conn, "SELECT * FROM user as us JOIN administrator as ad ON us.rfid = ad.rfid ");

?>
<table class="table table-hover table-striped table-border">
	<tr>
		<th>RFID</th>
		<th>NIDN</th>
		<th>Nama</th>
		<th>Gender</th>
		<th>Tgl Lahir</th>
		<th>Alamat</th>
		<th>Email</th>
	</tr>
	<?php
		while($resulting = mysqli_fetch_assoc($query)){
	?>
	<form>
	<tr>
		<td><?= $resulting['rfid'] ?></td>
		<td><?= $resulting['nidn'] ?></td>
		<td><?= $resulting['nama'] ?></td>
		<td><?= $resulting['jenis_kelamin'] ?></td>
		<td><?= $resulting['tgl_lahir'] ?></td>
		<td><?= $resulting['alamat'] ?></td>
		<td><?= $resulting['email'] ?></td>
	</tr>
	</form>
	<?php } ?>
</table>
