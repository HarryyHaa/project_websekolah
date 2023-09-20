<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Penilaian soal essay</h5>
				<p></p>
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
				<?php echo form_open_multipart();?>
				<?php echo form_hidden('encoded', $encoded);?>
				<div class="row">
					<table class="striped responsive-table">
						<thead>
							<tr>
								<tr>
									<th width="5%">No.</th>
									<th width="35%">Soal</th>
									<th width="40%">Jawaban</th>
									<th width="10%">Nilai</th>
								</tr>
							</tr>
						</thead>
						
						<tbody>
							<?php 
							$no=1;
							foreach ($essay as $row) {
								?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$row->question;?></td>
									<td><?=$row->answer_essay;?></td>
									<td>
										<input type="hidden" name="ID[<?=$no?>]" value="<?=$row->ID?>">
										<input type="number" name="answer_score[<?=$no;?>]" id="answer_score" autocomplete="off" value="<?=$row->answer_score;?>">
									</td>
								</tr>
								<?php $no++; } ?>
							</tbody>
						</table>

					</div>
					<div class="row">
						<hr style="margin-bottom: 40px;" />
						<div class="col m6 s6">
							<a href="<?=site_url('admin/quiz/review/'.$encoded);?>" class="btn green" style="width: 100%;">Kembali</a>
						</div>
						<div class="col m6 s6">
							<button class="btn blue" style="width: 100%;">Simpan</button>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>

	</div>
	<!-- Start Second Row -->

