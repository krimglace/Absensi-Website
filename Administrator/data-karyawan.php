<div class="content-wrapper">
	<div class="container-fluid m-3">
		<div class="section-header">
			<div class="page-header alert alert-primary text-dark p-2 m-2">
				<h5>
					<b>
						<i class="fas fa-user-tie" style="margin-left: 25px"></i>
						Data Karyawan
					</b>
				</h5>
			</div>
			<br>
		</div>
		<div class="section-main m-2">
			<div class="search" style="margin-right: 10px">
				<label class="float-end col-md-4"><strong>Search : (Cari Berdasarkan Nama/NIDN) </strong></label>
				<div class="clearfix"></div>
				<div class="float-end col-md-4">
					<input type="" name="" class="form-control float-start" style="width: 85%">
					<button class="btn btn-primary float-start" style="width: 15%"><i class="fas fa-search"></i></button>
				</div>
				<div class="tambah-karyawan">
					<button class="btn btn-success float-start" data-bs-toggle="modal" data-bs-target="#newModal">New</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<br>
			<div class="data-table">
				<table class="table table-hover table-striped table-border">
					<tr>
						<th>NIDN</th>
						<th>Nama</th>
						<th>Gender</th>
						<th>Tgl Lahir</th>
						<th>Alamat</th>
						<th>Jabatan</th>
						<th>Email</th>
						<th colspan="2" class="text-center">Aksi</th>
					</tr>
					<?php
						include 'php/data-karyawan.php';
						while($resultkar = mysqli_fetch_assoc($query)){
					?>
					<tr>
						<td><?= $resultkar['nidn'] ?></td>
						<td><?= $resultkar['nama'] ?></td>
						<td><?= $resultkar['jenis_kelamin'] ?></td>
						<td><?= $resultkar['tgl_lahir'] ?></td>
						<td><?= $resultkar['alamat'] ?></td>
						<td><?= $resultkar['status_jabatan'] ?></td>
						<td><?= $resultkar['email'] ?></td>
						<td class="text-center"><h5><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $resultkar['id_karyawan'] ?>"><i class="fas fa-edit"></i></a></h5></td>
						<td class="text-center"><h5><a href="php/delete-data-karyawan.php"><i class="fas fa-trash text-danger"></i></a></h5></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>


<!-- Modal Edit -->


<!-- Modal Tambah -->
<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<form method="post" action="php/add-data-karyawan.php">
      			<div class="modal-body">
        			<div class="form-group" style="margin: 0 10%">
	        			<table>
	        				<tr>
	        					<th style="padding-right: 20px">NIDN</th>
	        					<td><input type="text" name="nidn" class="form-control" required></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Nama</th>
	        					<td><input type="text" name="nama" class="form-control" required></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Jenis Kelamin</th>
	        					<td>
	        						<select name="jenis_kelamin" class="form-control">
	        							<option value="Laki - Laki">Laki - Laki</option>
	        							<option value="Perempuan">Perempuan</option>
	        						</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Tanggal Lahir</th>
	        					<td><input type="date" name="tgl_lahir" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Alamat</th>
	        					<td><input type="text" name="alamat" class="form-control"></td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Jabatan</th>
	        					<td>
	        						<select name="jabatan" class="form-control">
	        							<option value="Administrator">Administrator</option>
	        							<option value="Karyawan">Karyawan</option>
	        							<option value="Staff">Staff</option>
	        							<option value="Wakil Ketua">Wakil Ketua</option>
	        						</select>
	        					</td>
	        				</tr>
	        				<tr>
	        					<th style="padding-right: 20px">Email</th>
	        					<td><input type="email" name="email" class="form-control"></td>
	        				</tr>
	        			</table>        			
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        		<button type="submit" name="submit" class="btn btn-primary">Add</button>
	      		</div>
      		</form>
    	</div>
  	</div>
</div>