<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Penilaian Soal Essai</h5>
				<table>
					<tr>
						<td>NIS</td>
						<td>:</td>
						<td><?=$student->code;?></td>
						<td>Nama Siswa</td>
						<td>:</td>
						<td><?=$student->name;?></td>
					</tr>
					<tr>
						<td>Kelas Ujian</td>
						<td>:</td>
						<td><?=$classroom->name;?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


<!-- Start Second Row -->
<div class="row">

	<?php if ($this->session->flashdata()) { ?>
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>
				</div>
			</div>
		</div>
	<?php };?>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<?php echo form_open_multipart();?>
				<?php echo form_hidden('current_url', current_url());?>
				<div class="row">
					<table class="striped">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="35%">Soal</th>
								<th width="40%">Jawaban</th>
								<th width="10%">Nilai</th>
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
						<div class="col m12 s12">
							<button class="btn blue" style="width: 100%;">Simpan</button>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>

		<div class="col m12 center">
			<div class="card">
				<div class="card-content">
					<div class="pagination">
						<?=$page;?>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- Start Second Row -->

