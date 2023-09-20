<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content center">
				<!-- <h5 class="center">Kode Kelas:</h5> -->
				<h1 style=" margin: 0.5rem 0 1.68rem 0;"><span  style="font-family: sans-serif; font-size: 5rem;"><?=strtoupper($classroom->code);?>
				<?php if ($classroom->lock == 0) { ?>
					<a  onclick="return confirm('Dengan mengunci kelas ujian, maka tidak akan ada peserta yang bisa bergabung ke kelas ujian ini. Apakah anda yakin?')" href="<?=site_url('admin/classroom/lock/'.$classroom->code);?>" class="btn-floating orange" title="Kunci Kelas Ujian"><i class="material-icons">lock_open</i></a>
				<?php } else{ ?>
					<a onclick="return confirm('Dengan membuka kelas ujian, maka peserta bisa bergabung ke kelas ujian ini. Apakah anda yakin?')" href="<?=site_url('admin/classroom/unlock/'.$classroom->code);?>" class="btn-floating black" title="Buka Kelas Ujian"><i class="material-icons">lock</i></a>
				<?php } ?>
				 <a  onclick="return confirm('Apakah anda yakin ingin menggenerate ulang kode kelas?')"  title="Genrate Ulang" class="btn btn-floating green" href="<?=site_url('admin/classroom/regenerate_code/'.encode($classroom->ID));?>"><i class="material-icons">autorenew</i></a></span></h1>
				<hr/>

				<div class="row">

					<?php if ($this->session->flashdata()) { ?>
						<div class="col m12 s12">
							<?php
							if ($this->session->flashdata('success')) 
							{
								echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
							}else{
								echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
							}?>
						</div>
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
								<td>Tampilkan Hasil di Siswa/Siswi</td>
								<td>:</td>
								<td><?=(($classroom->show_result == 1) ? 'Ya' : 'Tidak');?></td>
							</tr>
						</table>
					</div>
				</div>
				
				<hr/>
				<p>Paket soal dalam kelas ini 
					<?php if ($classroom->working_status == 0) {
						echo "<b>masih tertutup</b> sehingga Siswa/Siswi <b>belum bisa</b> mengerjakannya <br/><br/> <a onclick='return confirm(\"Apakah yakin waktu pengerjaan soal mau dimulai?\")' href='".site_url('admin/classroom/start/'.strtoupper($classroom->code))."' class='btn green'>Mulai Waktu Pengerjaan</a>";
					}elseif($classroom->working_status == 1){
						echo "waktu pengerjaannya <b>sedang berlangsung</b>, seluruh Siswa/Siswi yang telah masuk ke kelas ini bisa mengerjakan soal. <br/><br/> <a onclick='return confirm(\"Apakah yakin waktu pengerjaan soal mau dihentikan?\")' href='".site_url('admin/classroom/stop/'.strtoupper($classroom->code))."' class='btn red'>Hentikan Waktu Pengerjaan</a>";
					}else{
						echo "sudah tidak bisa dikerjakan oleh Siswa/Siswi karena waktu pengerjaannya sudah selesai.<br/><br/> <a onclick='return confirm(\"Apakah yakin waktu pengerjaan soal mau dimulai kembali?\")' href='".site_url('admin/classroom/start/'.strtoupper($classroom->code))."' class='btn blue'>Mulai Kembali</a>";
					}?>
				</p>
			</div>
		</div>
	</div>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5>Nilai Siswa/Siswi </a>
					<a href="<?=site_url('admin/classroom/analisa_pilihan_ganda/'.strtoupper($classroom->code));?>" class="btn-small green" title="Export">Analisis PG<i class="material-icons right">file_download</i></a>
					<a href="javascript:window.open('<?=site_url('admin/classroom/print_classroom/'.strtoupper($classroom->code));?>','mywindowtitle','width=700,height=700')"" class="btn-small green" title="Print">Print <i class="material-icons right">local_printshop</i></a> <a href="<?=site_url('admin/classroom/download_excel/'.strtoupper($classroom->code));?>" class="btn-small green" title="Export">Export<i class="material-icons right">file_download</i></a> <a href="<?=site_url('admin/quiz/set_all_essay_score/'.strtoupper($classroom->code));?>" class="btn-small green">Penilaian Essai <i class="material-icons right">create</i></a>
				</h5>

				<!-- cek apakah hanya soal pilihan ganda atau disertai essai -->
				<?php if ($this->quiz_model->check_quiz_type($classroom->ID) == 0) { ?>
					
					<table id="dataTables">
						<thead>
							<tr>
								<th>No.</th>
								<th>NIM</th>
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
									<td class="center"><a title="Lihat detail" href="<?=site_url('admin/quiz/review/'.encode($classroom->ID.'/'.$row->ID));?>" class="btn-small blue">Detail</a></td>
									<td class="center"><a title="Reset" onclick="return confirm('Apakah anda yakin ingin mereset waktu ujian beserta jawaban untuk peserta tersebut?')" href="<?=site_url('admin/classroom/reset/'.encode(encode($row->ID).'/'.encode($classroom->ID).'/'.encode($classroom->code)));?>" class="btn btn-small red">Hapus</a></td>
								</tr>
								<?php $no++; }?>
							</tbody>
						</table>

					<?php }else{ ?>

						<table id="dataTables">
							<thead>
								<tr>
									<th>No.</th>
									<th>NIM</th>
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
										<td class="center"><a title="Lihat detail" href="<?=site_url('admin/quiz/review/'.encode($classroom->ID.'/'.$row->ID));?>" class="btn-small blue">Detail</a></td>
										<td class="center"><a title="Reset" onclick="return confirm('Apakah anda yakin ingin mereset waktu ujian beserta jawaban untuk peserta tersebut?')" href="<?=site_url('admin/classroom/reset/'.encode(encode($row->ID).'/'.encode($classroom->ID).'/'.encode($classroom->code)));?>" class="btn btn-small red">Hapus</a></td>
									</tr>
									<?php $no++; }?>
								</tbody>
							</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
<!-- End First Row -->