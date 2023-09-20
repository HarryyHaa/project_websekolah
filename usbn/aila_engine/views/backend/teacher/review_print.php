<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" href="<?php echo base_url('aila_cbt/css/print.css')?>" rel="stylesheet" />
	<title>Print Nilai</title>
	<style type="text/css">
		.text-center {
			text-align: center;
		}

		.nilai td{
			padding: 0px;
		}
	</style>
	<body onload="window.print()">
		<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

		?>
		<div class="row" style="margin-top: 20px;">
			<table>
				<tr>
					<td width="100"><img src="<?=base_url('aila_cbt/images/logo.png');?>" width="85" style="margin-left: 10px;"></td>
					<td>
						<center>
							<h2><?=$this->config->item('cbt_name');?></h2>
							<p>Alamat 	 :		<?=$this->config->item('address').' Desa/Kelurahan '.$this->config->item('village').' Kecamatan '.$this->config->item('sub_district').' <br/> '.$this->config->item('district').' - '.$this->config->item('province');?>.</p>
						</center>
					</td>
				</tr>
			</table>
			<hr/>
			<table>
				<tr>
					<td width="150px;">Nama Siswa</td>
					<td>:</td>
					<td width="250px;"><?=$student->name;?></td>
					<td width="150px;">Jawaban PG Benar</td>
					<td>:</td>
					<td><?=$correct_answer;?> soal</td>
				</tr>
				<tr>
					<td>Kelas Ujian</td>
					<td>:</td>
					<td><?=$classroom->name;?></td>
					<td>Jawaban PG Salah</td>
					<td>:</td>
					<td><?=($total_mc_quiz - $correct_answer);?> soal</td>
				</tr>
				<tr>
					<td>Jumlah Soal</td>
					<td>:</td>
					<td><?=$total_quiz;?> soal</td>
					<td>Nilai PG</td>
					<td>:</td>
					<td><?=number_format((($correct_answer / $total_mc_quiz) * 100), 2);?></td>
				</tr>
				<tr>
					<td>Jumlah Soal PG</td>
					<td>:</td>
					<td><?=$total_mc_quiz;?> soal</td>
				<td>Nilai Essai</td>
					<td>:</td>
					<td><?=count_score_essay($student->ID, $classroom->ID, $classroom->quiz_name_ID);?></td>
				</tr> 
				<tr>
					<td>Jumlah Soal Essai</td>
					<td>:</td>
					<td><?=$total_essay_quiz;?> soal</td>
				<td>Nilai Total</td>
					<td>:</td>
					<td><?=count_score_total($student->ID, $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage);?></td>
				</tr> 
			</table>
			<br/>
			<table class="table nilai" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Pertanyaan</th>
						<th>Jawaban</th>
						<th>Keterangan / Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($multiple_choice as $row) { ?>
						<tr>
							<td><?=$no;?></td>
							<td><?php echo $row->question;?></td>
							<td><?php 
							$answer = trim($row->answer);
							if ($answer == 'A') 
							{
								echo $row->answer_1;
							}
							elseif ($answer == 'B') 
							{
								echo  $row->answer_2;
							}
							elseif ($answer == 'C') 
							{
								echo $row->answer_3;
							}
							elseif ($answer == 'D') 
							{
								echo $row->answer_4;
							}
							elseif ($answer == 'E') 
							{
								echo $row->answer_5;
							}
							else
							{
								echo 'Kosong';
							}
							;?></td>
							<td><?=($row->is_correct == 1) ? 'Benar' : 'salah';?></td>
						</tr>
						<?php $no++; }?>

						<?php $no=$no; foreach ($essay as $row2) { ?>
							<tr>
								<td><?=$no;?></td>
								<td><?php echo remove_tag_p($row2->question);?></td>
								<td><?php echo remove_tag_p($row2->answer_essay);?></td>
								<td>
									<?php echo $row2->answer_score;?> 
								</td>
							</tr>
							<?php $no++; }?>
						</tbody>
					</table>

				</div>
			</body>