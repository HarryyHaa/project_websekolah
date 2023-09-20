<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	.card-content ul li{
		list-style: disc !important;
		margin-left: 20px;
	}
</style>
<!-- Start First Row -->
<?php if ($this->session->userdata('question_management_guide') == TRUE) { ?>
	<div class="row">
		<div class="col m12 s12">
			<div class="card">
				<div class="card-content">
					<h5 class="center">Panduan Manajemen Soal Ujian </h5>
					<ul>
						<li>Untuk menambahkan soal ujian, silahkan klik tanda plus berwarna hijau lalu masukan soal/pertanyaan, pilihan jawaban dan juga kunci jawaban, lalu klik tombil simpan.</li>
						<li>Setelah soal berhasil dibuat, anda bisa melihat detail, merubah dan juga menghapusnya. </li>
						<li>Jumlah soal tidak dibatasi, bisa dibuat berapapun sesuai dengan kebutuhan.</li>
						<li>Secara default, soal yang ditambahkan akan bersifat aktif dan akan tampil di siswa.</li>
						<li>Soal bisa <b>dinonaktifkan</b> <i style="font-size: 17px;" class="material-icons">visibility_off</i> supaya tidak tampil di siswa, tanda soal yang tidak aktif adalah pertanyaannya dicoret.</li>
						<li>Soal yang nonaktif bisa diaktifkan kembali dengan mengklik ikon <i style="font-size: 17px;" class="material-icons">visibility_off</i></li>
					</ul>
					<p class="center">(<a href="<?php echo site_url('admin/quiz/question_management_guide_hide/'.$ID) ;?>">Klik disini untuk menutup panduan</a>)</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- End First Row -->

<!-- Start Second Row -->
<div class="row">

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content center">
				<h4><?=$quiz_name->title;?></h4>
				<p>Pilihan Ganda : <b><?php echo $this->quiz_model->count_mutiple_choice($quiz_name->ID);?> Soal</b> dan Essai: <b><?php echo $this->quiz_model->count_mutiple_essay($quiz_name->ID);?> Soal </b></p>
				<p>Pilihan Ganda Aktif : <b><?php echo $this->quiz_model->count_mutiple_choice_active($quiz_name->ID);?> Soal</b> dan Essai Aktif: <b><?php echo $this->quiz_model->count_mutiple_essay_active($quiz_name->ID);?> Soal </b></p>
			</div>
		</div>
	</div>

	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<?php if ($this->session->flashdata()) 
				{
					if ($this->session->flashdata('success')) 
					{
						echo "<div class='center white-text card-content green lighten-1'>".$this->session->flashdata('success')."</div>";
					}else{
						echo "<div class='center white-text card-content red lighten-1'>".$this->session->flashdata('failed')."</div>";
					}
				};?>
				<h5>Daftar Soal Ujian <a href="<?php echo site_url('admin/quiz/create_quiz/'.$ID);?>" class="btn-small green"><i class="material-icons" title="Tambah baru">add</i></a>

					<a href="#quiz_import" class="btn-small green modal-trigger" title="Upload Banyak"><i class="material-icons">add</i><i class="material-icons">add</i></a> 

					<?php if ($this->session->userdata('question_management_guide') == FALSE) { ?>
						<a href="<?php echo site_url('admin/quiz/question_management_guide_show/'.$ID);?>" class="right"><small style="font-size: 15px;">(Tampilkan panduan)</small></a>
					<?php }?>
				</h5>
				<hr/>
				<?php $no =1; foreach ($quiz as $row) { ?>
					<div class="row">
						<div class="col m8">
							<p>
								<?php 
								$question = set_host_server($row->question);
								;?>

								<?="(".$no.") ".(($row->quiz_type == 1) ? 'PG : ' : 'Essai : ');?>
								<?php if ($row->status == 1) {
									echo $question;
								}else{
									echo "<del>".$question."</del>";
								}?>	

								<?php 
								if (($row->audio != NULL) AND ($row->audio != '')) {
									if (file_exists('./aila_cbt/audio/'.decode($ID).'/'.$row->audio)) {
										echo "<audio controls controlsList='nodownload'>";
										echo "<source src='../../../aila_cbt/audio/".decode($ID)."/".$row->audio."' type='audio/mpeg'>";
										echo "</audio>";
									}
								}?>
							</p>
							<p>
								<ol type="a">
									<?php 
									if ($row->quiz_type == 1) { ?>
										<li <?=(trim($row->answer_key) == 'A') ? 'class="bold italic"' : '';?>><?=set_host_server($row->answer_1);?></li>
										<li <?=(trim($row->answer_key) == 'B') ? 'class="bold italic"' : '';?>><?=set_host_server($row->answer_2);?></li>
										<li <?=(trim($row->answer_key) == 'C') ? 'class="bold italic"' : '';?>><?=set_host_server($row->answer_3);?></li>
										<?php if ($row->answer_4 != '') { ?>
											<li <?=(trim($row->answer_key) == 'D') ? 'class="bold italic"' : '';?>><?=set_host_server($row->answer_4);?></li>
										<?php } ?>
										<?php if ($row->answer_5 != '') { ?>
											<li <?=(trim($row->answer_key) == 'E') ? 'class="bold italic"' : '';?>><?=set_host_server($row->answer_5);?></li>
										<?php } ?>
									<?php } ?>
								</ol>
							</p>

							<?php if ($row->explanation != NULL) {
								echo "<b>Pembahasan</b> : ";
								echo set_host_server($row->explanation);
							}?>

						</div>
						<div class="col m4 right">
							<?php if ($row->status == 1) {?>
								<a onclick="return confirm('Apakah anda yakin akan menonaktifkan soal ini?')" title="Klik untuk menonaktifkan" href="<?php echo site_url('admin/quiz/disable_quiz/'.encode($row->ID));?>" class="btn-small green"><i class="material-icons">visibility</i></a>
							<?php }else{ ?>
								<a onclick="return confirm('Apakah anda yakin akan mengaktifkan soal ini?')" title="Klik untuk mengaktifkan" href="<?php echo site_url('admin/quiz/enable_quiz/'.encode($row->ID));?>" class="btn-small grey"><i class="material-icons">visibility_off</i></a>
							<?php }?>	
							<a title="Ubah" href="<?php echo site_url('admin/quiz/update_quiz/'.encode($row->ID));?>" class="btn-small blue"><i class="material-icons">edit</i></a>

							<a title="Hapus" onclick="return confirm('Apakah yakin akun soal ini mau dihapus ?');" href="<?php echo site_url('admin/quiz/delete_quiz/'.encode($row->ID));?>" class="btn-small red"><i class="material-icons" >delete</i></a>
						</div>

					</div>
					
					<hr/>
					<?php $no++; } ?>	

				</div>
			</div>

		</div>

	</div>
	<!-- Start Second Row -->


	<!-- Start Modal Import Soal Ujian -->
	<div id="quiz_import" class="modal">
		<div class="modal-content">
			<h4>Import Soal Ujian</h4>
			<p>Untuk mengimport data soal ujian, silahkan gunakan  <a href="<?php echo base_url('aila_cbt/xls_template/template_soal.xls');?>"> template ini</a></p>
			<hr/>
			<?php echo form_open_multipart(site_url('admin/quiz/import/'.$ID)) ;?>
			<div class="row">
				<div class="input-field col s10">
					<div class="file-field input-field">
						<div class="btn">
							<span>File</span>
							<input type="file" name="file" class="green" required="">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Pilih photo profil anda">
						</div>
					</div>
				</div>
				<div class="col s2">
					<button type="submit" class="waves-effect waves-green btn green" style="margin-top: 25px;">Import</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- End Modal Import Soal Ujian -->