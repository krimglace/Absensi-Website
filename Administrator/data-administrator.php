<div class="content-wrapper">
	<div class="container-fluid">
		<div class="section-header m-3">
			<div class="page-header alert alert-primary text-dark p-2 m-2">
				<h5>
					<b>
						<i class="fas fa-user-secret" style="margin-left: 25px"></i>
						Data Administrator
					</b>
				</h5>
			</div>
			<br>
		</div>
		<div class="section-main m-2">
			<div class="search float-start col-md-4">
				<label><strong>Search : (Cari Berdasarkan Nama/NIDN) </strong></label>
				<input type="" name="" class="form-control float-start" style="width: 85%">
				<button class="btn btn-primary float-start" id="search" style="width: 15%"><i class="fas fa-search"></i></button>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<br>
			<div class="data-table">
				
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data-table').load('php/datatable-administrator.php');
		// $('#search').click(function(){
		// 	var bulan = $('#bulan').val();
		// 	var tahun = $('#tahun').val();
		// 	// console.log(bulan);
		// 	$.ajax({
		// 		type: 'POST',
	 //            url: "php/datatable-absensi.php",
	 //            data: {bulan: bulan, tahun:tahun},
	 //            success: function(hasil) {
	 //                $('.data-table').html(hasil);
	 //            }
		// 	});
		// });
	});
</script>