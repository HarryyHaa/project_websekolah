<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Start First Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<h5 class="center">Ubah Paket Soal</h5>
				<p>Disini Anda bisa membuat, merubah dan mengarsipkan paket soal ujian, lengkap dengan daftar pertanyaan berserta pilihan jawaban.</p>
			</div>
		</div>
	</div>
</div>
<!-- End First Row -->


<!-- Start Second Row -->
<div class="row">
	<div class="col m12 s12">
		<div class="card">
			<div class="card-content">
				<div class="modal-content">
					<?php echo form_open(site_url('admin/quiz/update_quiz_name'));?>
					<input type="hidden" name="ID" value="<?=$quiz_name->ID;?>">
					<div class="row">
						<div class="input-field col s12">
							<select name="teacher" class="select2">
								<option value="" disabled selected>Pilih <?=$this->config->item('teacher');?></option>
								<?php foreach ($teacher as $teac2) {?>
									<option value="<?=$teac2->ID;?>" <?=($teac2->ID == $quiz_name->teacher_ID)? 'selected': '';?>><?=$teac2->name;?></option>
								<?php } ?>
							</select>
						</div>
						<div class="input-field col s12">
							<input type="text" name="title" id="title" autocomplete="off" required="" value="<?=$quiz_name->title;?>">
							<label for="#title">Judul</label>
						</div>
						<div class="input-field col s12">
							<input type="text" name="description" id="description" autocomplete="off" required=""  value="<?=$quiz_name->description;?>">
							<label for="#description">Deskripsi</label>
						</div>
						<div class="input-field col s4">
							<input type="number" name="time" id="time" autocomplete="off" required=""  value="<?=$quiz_name->time;?>">
							<label for="#time">Waktu Mengerjakan (menit)</label>
						</div>
						<div class="input-field col s4">
							<input type="number" name="multiple_choice_percentage" id="multiple_choice_percentage" autocomplete="off" required="" value="<?=$quiz_name->multiple_choice_percentage;?>">
							<label for="#multiple_choice_percentage">Bobot Pilihan ganda (%)</label>
						</div>
						<div class="input-field col s4">
							<input type="number" name="essay_percentage" id="essay_percentage" autocomplete="off" required=""  value="<?=$quiz_name->essay_percentage;?>">
							<label for="#essay_percentage">Bobot Essai (%)</label>
						</div>
						<div class="col s12">
							<button type="submit" class="waves-effect waves-green btn green">Simpan</button>
							<a href="javascript:history.back()" class=" btn red">Batal</a>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Start Second Row -->

