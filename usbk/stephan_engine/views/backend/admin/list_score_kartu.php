<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5> <left>Cetak Kartu Ujian</left><br/>
						<left>
						
						<a href="javascript:window.open('<?=site_url('admin/student_card/print_classroom/'.strtoupper($classroom->code));?>','mywindowtitle','width=700,height=700')" class="btn-small green" title="Print">Print <i class="material-icons right">local_printshop</i></a> 

						</left>
					</h5>

					<!-- cek apakah hanya soal pilihan ganda atau disertai essai -->
					<table id="dataTables">
						<thead>
							<tr>
								<th>No ya</th>
								<th><?=$this->config->item('student_code');?></th>
								<th>Nama</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($present as $row) {?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$row->code;?></td>
									<td><?=$row->name;?></td>
									
							<?php $no++; }?>
								</tr>	
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->