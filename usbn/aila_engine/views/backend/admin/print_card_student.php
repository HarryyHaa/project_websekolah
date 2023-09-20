<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Cetak Kartu Ujian</h5>
				<p>Pilih kelas atau kode</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table responsive-table" id="dataTables">
					<thead>
						<tr>
							<th>Kelas</th>
							<th>Nama</th>
						</tr>
					</thead>
					<tbody>

						<!--<?php 
							$print_card_student = $this->print_model->student_by_print();
							foreach ($print_card_student as $row) 
							{
								echo $row->code;
								echo $row->name;
							}
						?>-->
						<?php foreach ($print_card_student as $row) { ?>
							<tr>
								<td><a href="<?=site_url('admin/print_card/check_code_print/'.$row->class);?>" title="Lihat Detail"><?php echo $row->class;?></a></td>
								  	
								<td><a href="<?=site_url('admin/print_card/check_code_print/'.$row->name);?>"><?php echo strtoupper($row->name);?></a></td>
								<td></td>
							</tr>
						<?php } ?>
					</tbody>
					
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

