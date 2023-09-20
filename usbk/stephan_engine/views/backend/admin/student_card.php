<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<p># Pilih kelas yang akan dicetak kartu ujian</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table responsive-table" id="classroom_list_kartu">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Kelas euy</th>
						</tr>
					</thead>
					
			</div>
		</div>
	</div>

</div>
