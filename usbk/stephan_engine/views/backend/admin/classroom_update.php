<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Ubah Kelas Ujian</h5>
				<p>Untuk merubah kelas ujian baru, silahkan isi nama kelas, deskripsi dan pilih paket soal ujian yang sebelumnya telah disbuat.</p>
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
				<?php 
				echo form_open();
				echo form_hidden('ID', $classroom->ID);
				?>
				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" autofocus="" name="name" id="name"  autocomplete="off" required="" value="<?=$classroom->name;?>">
						<label for="#name">Nama Kelas</label>
						<span class="red-text"><?=form_error('name');?></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m12 s12">
						<input type="text" name="description" id="description" autocomplete="off" required="" value="<?=$classroom->description;?>">
						<label for="#description">Deskripsi Pendek</label>
						<span class="red-text"><?=form_error('description');?></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m6 s12">
						<select required="" name="quiz_name_ID" class="select2">
							<option value="" disabled selected>Pilih Paket Ujian</option>
							<?php foreach ($quiz_name as $row) {?>
								<option value="<?=$row->ID;?>" <?=(($classroom->quiz_name_ID == $row->ID) ? 'selected' : '');?> ><?=$row->title;?></option>
							<?php }?>
							
						</select>
					</div>
					<div class="input-field col m6 s12">
						<input type="text" name="limit" id="limit"  autocomplete="off" value="<?=($classroom->multiple_choice_limit != 0) ? $classroom->multiple_choice_limit : '';?>">
						<label for="#limit">Jumlah Soal Pilihan ganda yang Akan Ditampilkan</label>
						<span class="green-text"><i>*Biarkan kosong jika ingin semua soal pilihan ganda ditampilkan</i></span>
					</div>
				</div>

				<div class="row">
					<div class="input-field col m6 s12">
						<p>Tampilkan hasil di <?=$this->config->item('student');?> : &nbsp; &nbsp; &nbsp;   
							<label>
								<input name="show_result" class="with-gap" name="group3" type="radio" value="1" <?=(($classroom->show_result == 1) ? 'checked' : '');?> />
								<span>Ya</span>
							</label>
							&nbsp; &nbsp; &nbsp; &nbsp; 
							<label>
								<input name="show_result" class="with-gap" name="group3" type="radio" value="0"   <?=(($classroom->show_result == 0) ? 'checked' : '');?> />
								<span>Tidak</span>
							</label>
						</p>
					</div>
					
					<div class="input-field col m6 s12">
						<p>Acak Urutan Soal ?  &nbsp; &nbsp; &nbsp;   
							<label>
								<input name="random_number" class="with-gap" name="group3" type="radio" value="1" <?=($classroom->random_number == 1) ? 'checked' : '';?> />
								<span>Ya</span>
							</label>
							&nbsp; &nbsp; &nbsp; &nbsp; 
							<label>
								<input name="random_number" class="with-gap" name="group3" type="radio" value="0" <?=($classroom->random_number == 0) ? 'checked' : '';?> />
								<span>Tidak</span>
							</label>
						</p>
					</div>

				</div>

				<div class="row">
					<div class="input-field col m4 s12">
						<p>Apakah Dijadwalkan? : &nbsp; &nbsp; &nbsp;   
							<label>
								<input <?=($classroom->scheduled == '1') ? 'checked' : '';?>  onclick="showTime();" class="with-gap" name="scheduled" type="radio" value="1" />
								<span>Ya</span>
							</label>
							&nbsp; &nbsp; &nbsp; &nbsp; 
							<label>
								<input <?=($classroom->scheduled == '0') ? 'checked' : '';?>  onclick="hideTime();" class="with-gap" name="scheduled" type="radio" value="0" />
								<span>Tidak</span>
							</label>
						</p>
					</div>

					<script type="text/javascript">
						function showTime() {
							document.getElementById('timeForm').style.display = 'block';
						}

						function hideTime() {
							document.getElementById('timeForm').style.display = 'none';
						}
					</script>

					<div class="col m8 s12" id="timeForm" style="display: <?=($classroom->scheduled == '1') ? 'block' : 'none';?>;">
						<div class="row">
							<div class="input-field col m3 s12">
								<input type="text" class="datepicker" name="date_start" id="datepicker"  autocomplete="off" value="<?=$classroom->date_start;?>">
								<label for="#date_start">Tanggal Mulai </label>
							</div>
							<div class="input-field col m3 s12">
								<input type="text" class="timepicker" name="time_start" id="datepicker"  autocomplete="off" step="1" value="<?=$classroom->time_start;?>">
								<label for="#time_start">Jam Mulai</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col m12 s12">
						<button type="submit" class="btn blue">Simpan</button>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>

</div>
<!-- Start Second Row -->

