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

    $query = mysqli_query($conn, "SELECT * FROM user as us JOIN administrator as ad ON us.rfid = ad.rfid WHERE us.rfid = '$rfid'");
	$result = mysqli_fetch_assoc($query);


?>
<table class="table table-hover table-striped table-border">
	<tr>
		<th>NIDN</th>
		<th>Nama</th>
		<th>Gender</th>
		<th>Tgl Lahir</th>
		<th>Alamat</th>
		<th>Jabatan</th>
		<th>Email</th>
		<th>Aksi</th>
	</tr>
	<tr>
		<td><?= $result['nidn'] ?></td>
		<td><?= $result['nama'] ?></td>
		<td><?= $result['jenis_kelamin'] ?></td>
		<td><?= $result['tgl_lahir'] ?></td>
		<td><?= $result['alamat'] ?></td>
		<td><?= $result['status_jabatan'] ?></td>
		<td><?= $result['email'] ?></td>
		<td><h5><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $result['id_administrator'] ?>"><i class="fas fa-edit"></i></a></h5></td>
	</tr>
</table>
<!-- Modal Edit -->
<div class="modal fade" id="exampleModal<?= $result['id_administrator'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<?php

    			$query = mysqli_query($conn, "SELECT * FROM user as us JOIN administrator as ad ON us.rfid = ad.rfid WHERE ad.id_administrator = '".$result['id_administrator']."'");
    			while( $res = mysqli_fetch_assoc($query) ){

    		?>
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<form method="post" action="php/update-profil.php?<?= $res['rfid'] ?>">
      			<div class="modal-body">
        			<div class="form-group" style="margin: 0 10%">
	        			<table>
	        				<tr>
	        					<th style="padding-right: 20px">NIDN</th>
	        					<td><input type="text" name="nidn" class="form-control" value="<?= $res['nidn'] ?>" readonly></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Nama</th>
	        					<td><input type="text" name="nama" class="form-control" value="<?= $res['nama'] ?>"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Username</th>
	        					<td><input type="text" name="username" class="form-control" value="<?= $res['username'] ?>"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Password</th>
	        					<td><input type="password" name="password" class="form-control" value="<?= $res['password'] ?>"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Jenis Kelamin</th>
	        					<td>
	        						<select name="jenis_kelamin" class="form-control">
	        							<option value="Laki - Laki" <?php if($res['jenis_kelamin'] == "Laki - Laki") { echo "selected";} ?> >Laki - Laki</option>
	        							<option value="Perempuan" <?php if($res['jenis_kelamin'] == "Perempuan") { echo "selected";} ?> >Perempuan</option>
	        						</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Tanggal Lahir</th>
	        					<td><input type="date" name="tgl_lahir" class="form-control" value="<?= $res['tgl_lahir'] ?>"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Alamat</th>
	        					<td><input type="text" name="alamat" class="form-control" value="<?= $res['alamat'] ?>"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Email</th>
	        					<td><input type="email" name="email" class="form-control" value="<?= $res['email'] ?>"></td>
	        				</tr>
	        			</table>        			
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        		<button type="submit" name="update" class="btn btn-primary">Update</button>
	      		</div>
      		</form>
      		<?php } ?>
    	</div>
  	</div>
</div>