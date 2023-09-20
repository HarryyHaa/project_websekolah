<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" href="<?php echo base_url('stephan_cbt/css/print.css')?>" rel="stylesheet" />
	<title>Print Nilai</title>
	<style type="text/css">
		.text-center {
			text-align: center;
		}
	</style>
	<body onload="window.print()">
		<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

		?>
		<div class="row" style="margin-top: 20px;">
			<table>
				<tr>
					<td width="90"><img src="<?=base_url('stephan_cbt/images/logo.png');?>" width="85" style="margin-left: 10px;"></td>
					<td>
						<center>
							<h2><?=$this->config->item('cbt_name');?></h2>
							<p>Alamat 	 :		<?=$this->config->item('address').' Desa/Kelurahan '.$this->config->item('village').' Kecamatan '.$this->config->item('sub_district').' <br/> '.$this->config->item('district').' - '.$this->config->item('province');?>.</p>
						</center>
					</td>
				</tr>
			</table>
			<hr style="margin-top: -10px;" />
			<table>
				<tr>
					<td>Nama Kelas </td>
					<td>:</td>
					<td width="300"><?=$classroom->name;?></td>
					<td>Jumlah Soal PG</td>
					<td>:</td>
					<td><?=$mutiple_choice_total;?> soal</td>
				</tr>
				<tr>
					<td>Deskripsi</td>
					<td>:</td>
					<td><?=$classroom->description;?></td>
					<td>Jumlah Soal Essai</td>
					<td>:</td>
					<td><?=$essay_total;?> soal</td>
				</tr>
				<tr>
					<td>Nama Paket Soal</td>
					<td>:</td>
					<td><?=$classroom->title;?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				
			</table>
			<h4 style="margin: 0px 0px 5px 0px; text-align: center; padding-top: 10px;">REKAP NILAI <?=strtoupper($this->config->item('student'));?></h4>
			<table width="100%">
				<?php if (isset($student_score)) { ?>
					<?php if ($this->quiz_model->check_quiz_type($classroom->ID) == 0) { ?>

						<thead>
							<tr>
								<th>No.</th>
								<th><?=$this->config->item('student_code');?></th>
								<th>Nama Lengkap</th>
								<th>Perolehan PG</th>
								<th>Nilai PG</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($student_score as $row) {?>
								<tr>
									<td><?=$no;?></td>
									<td><?=$row->code;?></td>
									<td><?=$row->name;?></td>
									<td><?=$row->jumlah_benar.' / '. $row->jumlah_soal;?></td>
									<td><?=number_format((($row->jumlah_benar / $row->jumlah_soal) * 100), 2);?></td>
								</tr>
								<?php $no++; }?>
							</tbody>

						<?php }else{ ?>

							<thead>
								<tr>
									<th>No.</th>
									<th><?=$this->config->item('student_code');?></th>
									<th>Nama Lengkap</th>
									<th>Perolehan PG</th>
									<th>Nilai PG</th>
									<th>Nilai Essai</th>
									<th>Nilai Total</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($student_score as $row) {?>
									<?php $essai_score = count_score_essay($row->ID, $classroom->ID, $classroom->quiz_name_ID);?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$row->code;?></td>
										<td><?=$row->name;?></td>
										<td><?=$row->jumlah_benar.' / '. $row->jumlah_soal;?></td>
										<td><?=number_format((($row->jumlah_benar / $row->jumlah_soal) * 100), 2);?></td>
										<td><?=$essai_score;?></td>
										<td><?=count_score_total($row->ID, $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage);?></td>
									</tr>
									<?php $no++; }?>
								</tbody>
							<?php } ?>
						<?php }elseif (isset($student_essai)) { ?>

							<thead>
								<tr>
									<th>No.</th>
									<th><?=$this->config->item('student_code');?></th>
									<th>Nama Lengkap</th>
									<th>Nilai Essai</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($student_essai as $row) {?>
									<?php $essai_score = count_score_essay($row->ID, $classroom->ID, $classroom->quiz_name_ID);?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$row->code;?></td>
										<td><?=$row->name;?></td>
										<td><?=$essai_score;?></td>
									</tr>
									<?php $no++; }?>
								</tbody>
							<?php } ?>
						</table>
					</div>
				</body>