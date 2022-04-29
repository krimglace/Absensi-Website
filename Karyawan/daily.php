<div class="content-wrapper">
	<div class="container-fluid">
		<div class="section-header m-3">
			<div class="page-header alert alert-primary text-dark p-2 m-2">
				<h5>
					<b>
						<i class="fas fa-book" style="margin-left: 25px"></i>
						Daily Record
					</b>
				</h5>
			</div>
		</div>
		<div class="section-main m-2">
			<legend class="text-center"><strong>Daily Record</strong></legend>
			<h6 class="text-center"><strong><?= date('D, d/m/Y') ?></strong></h6>
			<br>
			<div class="data-kegiatan">
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data-kegiatan').load('php/datatable-dailyrecord.php');
	});
</script>