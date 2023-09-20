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
								<td width="150px;">Nama Siswa</td>
								<td>:</td>
								<td><?=$this->session->userdata['name'];?></td>
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
								<td><?=number_format((($correct_answer / $total_mc_quiz) * 100), 2);?></td>
							</tr>
							<tr>
								<td>Nilai Essai</td>
								<td>:</td>
								<td><?=(($total_essay_quiz != 0 ) ? count_score_essay($this->session->userdata['ID'], $classroom->ID, $classroom->quiz_name_ID) : 0 );?></td>
							</tr>
							<tr>
								<td>Nilai Total</td>
								<td>:</td>
								<td><?=count_score_total($this->session->userdata['ID'], $classroom->ID, $classroom->quiz_name_ID, $quiz_name->multiple_choice_percentage, $quiz_name->essay_percentage);?></td>
							</tr>
						</table>
					</div>
				</div>
				<br/>

				<?php if ($this->session->flashdata()) { ?>
					<?php
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}?>

				<?php };?>

			</div>
		</div>
	</div>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<table class="table responsive-table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Pertanyaan</th>
							<th>Jawaban</th>
							<th>Keterangan / Nilai</th>
							<th>Jawaban Benar</th>
							<th>Pembahasan</th>
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
								<td><?=$row->answer_key;?></td>
								<td>
									<?php if ($row->explanation != NULL) {?>
										<a href="<?=site_url('student/classroom/explanation/'.encode($row->id));?>" class="btn btn-small green">Lihat</a>
									<?php }else{echo "-";}; ?>
								</td>
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
						<a href="<?=site_url('student/classroom/detail/'.$classroom->code);?>" class="btn blue">Kembali</a>
					</div>
				</div>
			</div>
		</div>
<!-- End First Row -->