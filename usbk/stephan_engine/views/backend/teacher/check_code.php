<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content center">
				<!-- <h5 class="center">Kode Kelas:</h5> -->
				<h1 style=" margin: 0.5rem 0 0.5rem 0;"><span  style="font-family: sans-serif; font-size: 5rem;"><?=strtoupper($classroom->code);?> <br/>
				<?php if ($classroom->lock == 0) { ?>
					<a  onclick="return confirm('Dengan mengunci kelas ujian, maka tidak akan ada peserta yang bisa bergabung ke kelas ujian ini. Apakah Anda yakin?')" href="<?=site_url('teacher/classroom/lock/'.$classroom->code);?>" class="btn-floating orange" title="Kunci Kelas Ujian"><i class="material-icons">lock_open</i></a>
				<?php } else{ ?>
					<a onclick="return confirm('Dengan membuka kelas ujian, maka peserta bisa bergabung ke kelas ujian ini. Apakah Anda yakin?')" href="<?=site_url('teacher/classroom/unlock/'.$classroom->code);?>" class="btn-floating black" title="Buka Kelas Ujian"><i class="material-icons">lock</i></a>
				<?php } ?>
				<a  onclick="return confirm('Apakah Anda yakin ingin menggenerate ulang kode kelas?')"  title="Generate Ulang Kode" class="btn btn-floating green" href="<?=site_url('teacher/classroom/regenerate_code/'.encode($classroom->ID));?>"><i class="material-icons">autorenew</i></a> <a   title="Ubah" class="btn btn-floating green" href="<?=site_url('teacher/classroom/update/'.$classroom->code);?>"><i class="material-icons">edit</i></a> <a onclick="return confirm('Apakah Anda yakin hendak mengarsipkan kelas ujian ini?')"  title="Arsipkan" class="btn btn-floating brown" href="<?=site_url('teacher/classroom/make_an_archive/'.$classroom->code);?>"><i class="material-icons">archive</i></a> </span></h1>
				<hr/>

				<div class="row">

					<?php if ($this->session->flashdata()) { ?>
		<div id="flashSuccess" data-success="<?=$this->session->flashdata('success');?>"> </div>
		<div id="flashFailed" data-failed="<?=$this->session->flashdata('failed');?>"> </div>
	<?php };?>
					
					<div class="col m6 s6">
						<table>
							<tr>
								<td>Nama Kelas</td>
								<td>:</td>
								<td><?=$classroom->name;?></td>
							</tr>
							<tr>
								<td>Deskripsi</td>
								<td>:</td>
								<td><?=$classroom->description;?></td>
							</tr>
							<tr>
								<td>Nama Paket Soal</td>
								<td>:</td>
								<td><?=$classroom->title;?></td>
							</tr>
							<tr>
								<td>Nama <?=$this->config->item('teacher');?></td>
								<td>:</td>
								<td><?=$classroom->teacher_name;?></td>
							</tr>
						</table>
					</div>

					<div class="col m6 s6">
						<table>
							<tr>
								<td>Jumlah Soal PG</td>
								<td>:</td>
								<td><?=$mutiple_choice_total;?> soal</td>
							</tr>
							<tr>
								<td>Jumlah Soal Essai</td>
								<td>:</td>
								<td><?=$essay_total;?> soal</td>
							</tr>
							<tr>
								<td>Tampilkan Hasil di <?=$this->config->item('student');?></td>
								<td>:</td>
								<td><?=(($classroom->show_result == 1) ? 'Ya' : 'Tidak');?></td>
							</tr>
							<tr>
								<td>Status / Keterangan</td>
								<td>:</td>
								<td><?php
									if ($classroom->scheduled == 1) {
										echo "Dijadwalkan ".$classroom->date_start.' - '.$classroom->time_start;
									}else{
										if ($classroom->working_status == '0') {
											echo "Belum dimulai";
										}elseif ($classroom->working_status == '1') {
											echo "Berlangsung";
										}else{
											echo "Selesai";
										}
									};
									?></td>
							</tr>
						</table>
					</div>
				</div>
				
				<hr/>
				<p>Paket soal dalam kelas ini 
					<?php if ($classroom->working_status == 0) {
						echo "<b>masih tertutup</b> sehingga ".$this->config->item('student')." <b>belum bisa</b> mengerjakannya <br/><br/> <a onclick='return confirm(\"Apakah yakin waktu pengerjaan soal mau dimulai?\")' href='".site_url('teacher/classroom/start/'.strtoupper($classroom->code))."' class='btn green'>Mulai Waktu Pengerjaan</a>";
					}elseif($classroom->working_status == 1){
						echo "waktu pengerjaannya <b>sedang berlangsung</b>, seluruh ".$this->config->item('student')." yang telah masuk ke kelas ini bisa mengerjakan soal. <br/><br/> <a onclick='return confirm(\"Apakah yakin waktu pengerjaan soal mau dihentikan?\")' href='".site_url('teacher/classroom/stop/'.strtoupper($classroom->code))."' class='btn red'>Hentikan Waktu Pengerjaan</a>";
					}else{
						echo "sudah tidak bisa dikerjakan oleh ".$this->config->item('student')." karena waktu pengerjaannya sudah selesai.<br/><br/> <a onclick='return confirm(\"Apakah yakin waktu pengerjaan soal mau dimulai kembali?\")' href='".site_url('teacher/classroom/start/'.strtoupper($classroom->code))."' class='btn blue'>Mulai Kembali</a>";
					}?>
				</p>
			</div>
		</div>
	</div>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5>Nilai <?=$this->config->item('student');?> </a>
					<a href="<?=site_url('teacher/classroom/add_students/'.encode($classroom->ID));?>" class="btn-small green">Masukan <?=$this->config->item('student');?> <i class="material-icons right">people</i></a>
					<a href="<?=site_url('teacher/classroom/analisa_pilihan_ganda/'.strtoupper($classroom->code));?>" class="btn-small green" title="Export">Analisis PG<i class="material-icons right">file_download</i></a>
					<a href="javascript:window.open('<?=site_url('teacher/classroom/print_classroom/'.strtoupper($classroom->code));?>','mywindowtitle','width=700,height=700')"" class="btn-small green" title="Print">Print <i class="material-icons right">local_printshop</i></a> <a href="<?=site_url('teacher/classroom/download_excel/'.strtoupper($classroom->code));?>" class="btn-small green" title="Export">Export<i class="material-icons right">file_download</i></a> <a href="<?=site_url('teacher/quiz/set_all_essay_score/'.strtoupper($classroom->code));?>" class="btn-small green">Penilaian Essai guru <i class="material-icons right">create</i></a>
					<a href="javascript:window.open('<?=site_url('teacher/classroom/print_classroom_absen/'.strtoupper($classroom->code));?>','mywindowtitle','width=700,height=700')" class="btn-small green" title="Print">Print Absen <i class="material-icons right">local_printshop</i></a>
				</h5>

				<!-- cek apakah hanya soal pilihan ganda atau disertai essai -->
				<table id="dataTables">
					<?php if (isset($student_score)) { ?>
						<?php if ($this->quiz_model->check_quiz_type($classroom->ID) == 0) { ?>

							<thead>
								<tr>
									<th>No.</th>
									<th><?=$this->config->item('student_code');?></th>
									<th>Nama Lengkap</th>
									<th>Perolehan PG</th>
									<th>Nilai PG</th>
									<th class="center">Detail</th>
									<th class="center">Aksi</th>
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
										<td class="center"><a title="Lihat detail" href="<?=site_url('teacher/quiz/review/'.encode($classroom->ID.'/'.$row->ID));?>" class="btn-small blue">Detail</a></td>
										<td class="center"><a title="Reset" onclick="return confirm('Apakah Anda yakin ingin mereset waktu ujian beserta jawaban untuk peserta tersebut?')" href="<?=site_url('teacher/classroom/reset/'.encode(encode($row->ID).'/'.encode($classroom->ID).'/'.encode($classroom->code)));?>" class="btn btn-small red">Hapus</a></td>
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
										<th title="center">Detail</th>
										<th title="center">Aksi</th>
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
											<td class="center"><a title="Lihat detail" href="<?=site_url('teacher/quiz/review/'.encode($classroom->ID.'/'.$row->ID));?>" class="btn-small blue">Detail</a></td>
											<td class="center"><a title="Reset" onclick="return confirm('Apakah Anda yakin ingin mereset waktu ujian beserta jawaban untuk peserta tersebut?')" href="<?=site_url('teacher/classroom/reset/'.encode(encode($row->ID).'/'.encode($classroom->ID).'/'.encode($classroom->code)));?>" class="btn btn-small red">Hapus</a></td>
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
										<th title="center">Detail</th>
										<th title="center">Aksi</th>
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
											<td class="center"><a title="Lihat detail" href="<?=site_url('teacher/quiz/review/'.encode($classroom->ID.'/'.$row->ID));?>" class="btn-small blue">Detail</a></td>
											<td class="center"><a title="Reset" onclick="return confirm('Apakah Anda yakin ingin mereset waktu ujian beserta jawaban untuk peserta tersebut?')" href="<?=site_url('teacher/classroom/reset/'.encode(encode($row->ID).'/'.encode($classroom->ID).'/'.encode($classroom->code)));?>" class="btn btn-small red">Hapus</a></td>
										</tr>
										<?php $no++; }?>
									</tbody>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
<!-- End First Row -->