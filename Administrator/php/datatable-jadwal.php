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

  	$query = mysqli_query($conn, "SELECT * FROM status_absen");
  	while( $result = mysqli_fetch_assoc($query) ){
?>
<div class="float-start alert alert-info" style="width: 23%; margin: 1%; border: 3px double gray;">
	<form action="php/api-jadwal.php?<?= $result['id_status'] ?>" method="post" class="p-3">
		<h4 class="text-center"><?= $result['status'] ?></h4>
		<input type="hidden" name="id_status" value="<?= $result['id_status'] ?>">
		<div class="form-group">
			<input type="time" name="jam_mulai" value="<?= $result['jam_mulai'] ?>" class="form-control">
		</div>
		<h5 class="text-center"><strong>s/d</strong></h5>
		<div class="form-group">
			<input type="time" name="jam_selesai" value="<?= $result['jam_selesai'] ?>" class="form-control">
		</div>
		<div class="form-group text-center m-2">
			<button type="submit" name="search" id="search" class="btn btn-success">Update</button>
		</div>
	</form>
</div>
<?php } ?>

