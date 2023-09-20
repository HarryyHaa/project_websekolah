<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col m6">
						<table>
							<tr>
								<td width="150px;">Nama <?=$this->config->item('student');?></td>
								<td>:</td>
								<td><?=$student->name;?></td>
							</tr>
							<tr>
								<td>Kelas Ujian</td>
								<td>:</td>
								<td><?=$classroom->name;?></td>
							</tr>
							<tr>
								<td>Jumlah Soal</td>
								<td>:</td>
								<td><?=$total_quiz;?> soal</td>
							</tr>
							<tr>
								<td>Jumlah Soal PG</td>
								<td>:</td>
								<td><?=$total_mc_quiz;?> soal</td>
							</tr> 
							<tr>
								<td>Jumlah Soal Essai</td>
								<td>:</td>
								<td><?=$total_essay_quiz;?> soal</td>
							</tr> 
						</table>
					</div>
					<div class="col m6">
						<table>
							<tr>
								<td width="150px;">Jawaban PG Benar</td>
								<td>:</td>
								<td><?=$correct_answer;?> soal</td>
							</tr>
							<tr>
								<td>Jawaban PG Salah</td>
								<td>:</td>
								<td><?=($total_mc_quiz - $correct_answer);?> soal</td>
							</tr>
							<tr>
								<td>Nilai PG</td>
								<td>:</td>
								<td><?php if($total_mc_quiz == 0){
									echo $total_mc_quiz;
								}else{
									echo number_format((($correct_answer / $total_mc_quiz) * 100), 2); }?></td>
							</tr>
							<tr>
								<td>Nilai Essai</td>
								<td>:</td>
								<td><?=count_score_essay($student->ID, $classroom->ID, $classroom->quiz_name_ID);?></td>
							</tr>
							<tr>
								<td>Nilai Total</td>
								<td>:</td>
								<td><?=count_score_total($student->ID, $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage);?></td>
							</tr>
						</table>
					</div>
				</div>
				<br/>

				<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>

			</div>
		</div>
	</div>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th width="500">Pertanyaan</th>
							<th width="500">Jawaban</th>
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
									<td><?php echo $row2->question;?></td>
									<td><?php echo $row2->answer_essay;?></td>
									<td>
										<?php echo $row2->answer_score;?> 
									</td>
								</tr>
								<?php $no++; }?>
							</tbody>
						</table>
						<br/>
						<a href="<?=site_url('teacher/classroom/check_code/'.$classroom->code);?>" class="btn blue">Kembali</a>
						<a href="<?=site_url('teacher/quiz/set_essay_score/'.$encoded);?>" class="btn green">Penilaian Essai</a>
						<a target="_blank" class="btn green" href="<?=site_url('teacher/quiz/review_print/'.$encoded);?>">Print</a>
					</div>
				</div>
			</div>
		</div>
<!-- End First Row -->